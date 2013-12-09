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

        public function getAttackUser($attackedUserID = null)
        {

            /* Iz profila naselja po kliku na gumb "Napad" preusmerimo napadalca
            na url http://pp-project.dev/quiz/attack-user/[$attackedUserID].
            V getAttackUser zgeneriramo kviz, mu dodamo 8 vprasanj in shranimo
            katera uporabnika resujeta ta kviz. */
            
            /* TODO: preveri ce je ID napadenega igralca veljaven (obstaja v bazi 
            in ni enak IDju napadalca) */

            /* TODO: BUG - ustvari se prevec kvizov */

            /* generiranje kviza */
            $quiz = new Quiz();
            $quiz -> save();
            $quizId = $quiz -> id;

            /* izbira 8 unikatnih in nakljucnih vprasanj */
            $allQuestionsCount = Question::all()->count();
            $usedQuestionsCount = 8;
            $selectedQuestionsIDs = array();
            for($i=0; $i < $usedQuestionsCount; $i++) {
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

                $attackerAnswerHistory = new AnswerHistory();
                $attackerAnswerHistory -> id_question = $questionID;
                $attackerAnswerHistory -> id_user = Auth::user() -> id;
                $attackerAnswerHistory -> id_quiz = $quizId;
                $attackerAnswerHistory -> shuffle = $shuffleIndex;
                $attackerAnswerHistory -> correct_answer = $correctAnswer;
                $attackerAnswerHistory -> save();

                $defenderAnswerHistory = new AnswerHistory();
                $defenderAnswerHistory -> id_question = $questionID;
                $defenderAnswerHistory -> id_user = $attackedUserID;
                $defenderAnswerHistory -> id_quiz = $quizId;
                $defenderAnswerHistory -> shuffle = $shuffleIndex;
                $defenderAnswerHistory -> correct_answer = $correctAnswer;
                $defenderAnswerHistory -> save();
            }
            
            /* preusmeritev napadalca na pravkar ustvarjeni kviz */
            return Redirect::to("quiz/id/$quizId");
        }

        public function getId($id=null)
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


        public function postId($id)
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
                $answerHistory -> user_answer = $answered;
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