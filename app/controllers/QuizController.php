<?php

class QuizController extends BaseController {


        public function __construct()
        {
            $this->beforeFilter('auth');
        }
 
        public function getIndex()
        {
                
            /* ustvari kviz v bazi */
            $quiz = new Quiz();
            $quiz -> save();
            $quizId = $quiz -> id;

            /* generiranje kviza */
            $allQuestionsCount = Question::all()->count();
            /* echo " all: {$allQuestionsCount} "; */

            $selected = array();

            /* generating Question IDs */
            for($i=0; $i < 8; $i++)
            {
                do{
                    $rand=rand(1,$allQuestionsCount);
                }while(in_array($rand, $selected));
                $selected[$i] = $rand;

            }

            foreach($selected as $value)
            {
                $rndToken=rand(1,8);
                switch($rndToken)
                {
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
                $answerHistory = new AnswerHistory();
                $answerHistory -> id_question = $value;
                $answerHistory -> id_user = Auth::user() -> id;
                $answerHistory -> id_quiz = $quizId;
                $answerHistory -> shuffle = $rndToken;
                $answerHistory -> correct_answer = $correctAnswer;
                $answerHistory -> save();
            }
            


            /* generiranje url-ja*/

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