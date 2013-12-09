<?php

class QuizController extends BaseController {


        public function __construct()
        {
            $this->beforeFilter('auth');
        }
 
        public function getIndex()
        {   
            /* ustvari kviz v bazi */
            
        }

        public function getAttack($attackedUserID = null)
        {

            /* Iz profila naselja po kliku na gumb "Napad" preusmerimo napadalca
            na url http://pp-project.dev/quiz/attack/[$attackedUserID].
            V getAttackUser zgeneriramo kviz, mu dodamo 8 vprasanj in shranimo
            katera uporabnika resujeta ta kviz. */
            
            /* preveri ce je ID napadenega igralca veljaven (obstaja v bazi 
            in ni enak IDju napadalca) */
            $attackerID = Auth::user() -> id;

            if (!User::find($attackedUserID) || $attackedUserID == $attackerID) {
                App::abort(404, 'Page not found');
            }
            $defenderID = $attackedUserID;

            /* generiranje kviza */
            $quiz = new Quiz;
            $quiz -> save();
            $quizID = $quiz -> id;

            /* izbira 8 unikatnih in nakljucnih vprasanj */
            $allQuestionsCount = Question::all() -> count();
            $usedQuestionsCount = 8;
            $selectedQuestionsIDs = array();
            for($i = 0; $i < $usedQuestionsCount; $i++) {
                do {
                    $randQuestionID = rand(1,$allQuestionsCount);
                } while(in_array($randQuestionID, $selectedQuestionsIDs));
                $selectedQuestionsIDs[$i] = $randQuestionID;
            }

            foreach($selectedQuestionsIDs as $questionID) {
                /* izbira shuffla */
                $shuffleIndex=rand(1,8);
                switch($shuffleIndex) {
                    case 1:
                        $correctAnswer=4;
                    break;

                    case 2:
                        $correctAnswer=3;
                    break;

                    case 3:
                        $correctAnswer=2;
                    break;

                    case 4:
                        $correctAnswer=1;
                    break;

                    case 5:
                        $correctAnswer=2;
                    break;

                    case 6:
                        $correctAnswer=4;
                    break;

                    case 7:
                        $correctAnswer=3;
                    break;

                    case 8:
                        $correctAnswer=1;
                    break;
                }

                $answerHistory = new AnswerHistory;
                $answerHistory -> id_quiz = $quizID;
                $answerHistory -> id_question = $questionID;
                
                $answerHistory -> id_attacker = $attackerID;
                $answerHistory -> id_defender = $defenderID;
                
                $answerHistory -> shuffle = $shuffleIndex;
                $answerHistory -> correct_answer = $correctAnswer;

                $answerHistory -> save();
            }
            
            /* preusmeritev napadalca na pravkar ustvarjeni kviz */
            return Redirect::to("quiz/show/$quizID");
        }

        public function getShow($id=null)
        {
            $questionsData = AnswerHistory::where('id_quiz', '=', $id) -> get(array('id_question', 'shuffle')); 

            $questionIDs = array();
            $answerTokens = array();

            foreach($questionsData as $value)
            {
                array_push($questionIDs, $value['id_question']);
                array_push($answerTokens, $value['shuffle']);
            }
            
            $questions = Question::whereIn('id', $questionIDs) -> get(array('question', 'answer_1', 'answer_2', 'answer_3', 'answer_correct')); 

            $data = array("questionsData" => $questionsData, "questions" => $questions, "answerTokens" => $answerTokens, "quizID" => $id);
            return View::make('quiz', $data);
        }


        public function postShow($id)
        {
            $inputAll = Input::all();
            $answerArray = AnswerHistory::where('id_quiz', '=', $id) -> get(array('correct_answer', 'id_question')); 
            $i=1;
            foreach($answerArray as $value)
            {
                $tmp = "question".$i;
                $answered=5;
                if(isset($inputAll[$tmp]))
                    $answered=$inputAll[$tmp];              

                /*
                echo "<li>Correct answer: {$value['correct_answer']}";
                    if($value['correct_answer'] == $answered)
                        echo"Answered correctly";
                echo"</li>";
                */
                $answerHistory = AnswerHistory::where('id_quiz', '=', $id)->where('id_question', '=', $value['id_question'])->first();
                $answerHistory -> attacker_answer = $answered;
                $answerHistory -> save();
                $i++;
            }
            $questionsData = AnswerHistory::where('id_quiz', '=', $id) -> get(array('id_question', 'shuffle')); 

            $questionIDs = array();
            $answerTokens = array();

            foreach($questionsData as $value)
            {
                array_push($questionIDs, $value['id_question']);
                array_push($answerTokens, $value['shuffle']);
            }
            
            $questions = Question::whereIn('id', $questionIDs) -> get(array('question', 'answer_1', 'answer_2', 'answer_3', 'answer_correct')); 
            $data = array("questionsData" => $questionsData, "questions" => $questions, "answerTokens" => $answerTokens, "quizID" => $id);
            return View::make('completed_quiz', $data);
        }

        /* selection quiz from table */
            /* url: /quiz/idKviza */
            /* kviz=$_GET['quiz'] */
            /* verifikacija ID-ja kviza
            * ce je kviz ze zakljucen izpise porocilo
            * ce ID ne obstaja return error 404 
            * ce ID obstaja in kviz se ni zakljucen prikazemo vprasanje */

            

        /* randomize */


        /* create form */





}