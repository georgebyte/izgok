<?php
/*
*   primer klicanja izpisa napake
*   $f = Config::get('error.errorInfo', "napaka");
*        return $f("sporocilo napake", array("uri" => [boolean][optional] , "code" => "[value][optional]"));
*/

class QuizController extends BaseController {

    public function __construct()
    {
        $this->beforeFilter('auth');
    }

    public function getAttack($attackedUserID = null, $attackedTerritoryID = null)
    {
        /* Iz profila naselja po kliku na gumb "Napad" preusmerimo napadalca
        na url http://pp-project.dev/quiz/attack/[$attackedUserID]/[$villageID].
        V getAttackUser zgeneriramo kviz, mu dodamo 8 vprasanj in shranimo
        katera uporabnika resujeta ta kviz. Nato uporabnika preusmerimo na zgenerirani kviz.*/

        /* preveri ce je ID napadenega igralca veljaven (obstaja v bazi 
        in ni enak IDju napadalca) */
        $attackerID = Auth::user() -> id;

        if (!User::find($attackedUserID) || $attackedUserID == $attackerID) {
            $f = Config::get('error.errorInfo', "napaka");
            return $f("Napaden igralec ni veljaven.");
        }

        $defenderID = $attackedUserID;
        /*  */ 
        if (!Territory::where('id', '=', $attackedTerritoryID) -> where('id_owner', '=', $defenderID) -> get() || $attackedTerritoryID == "TODO") {
            $f = Config::get('error.errorInfo', "napaka");
            return $f("Izbranega ozemlja ni mogoce napasti.");
        }

        
        /* generiranje kviza */
        $quiz = new Quiz;
        $quiz -> id_attacker = $attackerID;
        $quiz -> id_defender = $defenderID;
        $quiz -> id_attacked_territory = $attackedTerritoryID;
        $quiz -> save();
        $quizID = $quiz -> id;

        /* izbira 8 unikatnih in nakljucnih vprasanj */
        $allQuestionsCount = Question::all() -> count();
        $selectedQuestionsIDs = array();
        for($i = 0; $i < Config::get('quiz.quizQuestionsCount', 8); $i++) {
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
            $answerHistory -> shuffle = $shuffleIndex;
            $answerHistory -> correct_answer = $correctAnswer;
            $answerHistory -> save();
        }
        
        /* preusmeritev napadalca na pravkar ustvarjeni kviz */
        return Redirect::to("quiz/show/$quizID");
    }

    public function getShow($quizID = null)
    {
        /* preveri ce je ID kviza veljaven */
        $quiz = Quiz::find($quizID);
        if (!$quiz) {
            $f = Config::get('error.errorInfo', "napaka");
            return $f("Zahtevani kviz ne obstaja.");
        }

        /* ugotovi ali je prijavljeni uporabnik napadalec ali branilec v trenutnem kvizu */
        $isAttacker = ($quiz -> id_attacker == Auth::user() -> id) ? true : false;
        $isDefender = ($quiz -> id_defender == Auth::user() -> id) ? true : false;
        /* ce uporabnik ni ne napadalec ne branilec v trenutnem kvizu vrni error */
        if (!($isAttacker || $isDefender)) {
            $f = Config::get('error.errorInfo', "napaka");
            return $f("Zahtevani kviz ni na voljo za prikaz.");
        }
        
        /* iz baze preberi katera vprasanja so del kviza in njihove informacije */
        $questionsData = AnswerHistory::where('id_quiz', '=', $quizID) -> get(array('id_question', 'attacker_answer', 'defender_answer', 'shuffle', 'correct_answer')); 
        $questionsIDs = array();
        $attackerAnswers = array();
        $defenderAnswers = array();
        $correctAnswers = array();
        $shuffles = array();
        foreach($questionsData as $questionData) {
            array_push($questionsIDs, $questionData['id_question']);
            array_push($attackerAnswers, $questionData['attacker_answer']);
            array_push($defenderAnswers, $questionData['defender_answer']);
            array_push($shuffles, $questionData['shuffle']);
            array_push($correctAnswers, $questionData['correct_answer']);
        }
        
        /* iz baze preberi vprasanje in odgovore za vsa vprasanja, ki so del trenutnega kviza */
        $questions = Question::whereIn('id', $questionsIDs) -> get(array('question', 'answer_1', 'answer_2', 'answer_3', 'answer_correct')); 

        $correctNumAnswers = Quiz::where('id', $quizID) -> get(array('attacker_num_correct_ans', 'defender_num_correct_ans')); 
        /* pripravi podatke, ki se jih poslje v View za prikaz neoddanega kviza */
        $data = array('questionsData' => $questionsData, 'questions' => $questions, 'shuffles' => $shuffles, 'quizID' => $quizID, 'attackerAnswers' => $attackerAnswers, 'defenderAnswers' => $defenderAnswers, 'correctAnswers' => $correctAnswers, 'correctNumAnswers' => $correctNumAnswers);

        /* igralcu, ki kviza se ni oddal prikazi kviz, na katerega lahko odgovarja */
        if(($isAttacker && $quiz -> submit_time_attacker == null) || ($isDefender && $quiz -> submit_time_defender == null)) {
            return View::make('quiz', $data);
        }

        /* igralcu, ki je kviz ze oddal prikazi porocilo o napadu */
        if(($isAttacker && $quiz -> submit_time_attacker != null) || ($isDefender && $quiz -> submit_time_defender != null)) {
            return View::make('report', $data);
        }
    }

    public function postShow($quizID = null)
    {
        /* preveri ce je ID kviza veljaven */
        $quiz = Quiz::find($quizID);
        if (!$quiz) {

            $f = Config::get('error.errorInfo', "napaka");
            return $f("Zahtevani kviz ne obstaja.");          
        }

        /* ugotovi ali je prijavljeni uporabnik napadalec ali branilec v trenutnem kvizu */
        $isAttacker = ($quiz -> id_attacker == Auth::user() -> id) ? true : false;
        $isDefender = ($quiz -> id_defender == Auth::user() -> id) ? true : false;
        /* ce uporabnik ni ne napadalec ne branilec v trenutnem kvizu vrni error */
        if (!($isAttacker || $isDefender)) {
            $f = Config::get('error.errorInfo', "napaka");
            return $f("Zahtevani kviz ni na voljo za prikaz.");          
        }
        /* igralcu, ki je kviz ze oddal ne dovoli ponovne oddaje */
        if(($isAttacker && $quiz -> submit_time_attacker != null) || ($isDefender && $quiz -> submit_time_defender != null)) {
            return Redirect::to("quiz/show/$quizID");
        }

        /* preberi uporabnikove odgovore */
        $userAnswers = Input::all();

        /* iz baze pridobi pravilne odgovore na vprasanja iz trenutnega kviza */
        $quizAnswers = AnswerHistory::where('id_quiz', '=', $quizID) -> get(array('correct_answer', 'id_question')); 
        
        /* loop skozi vsa vprasanja v trenutnem kvizu */
        $i=1;
        /* spremenjlivke namenjene stetju pravilnih odgovorv */
        $correctAttacker = 0;
        $correctDefender = 0;
        foreach($quizAnswers as $quizAnswer) {
            $questionIndex = "question".$i;
            $i++;

            /* ce uporabnik na vprasanje ni odgovoril oz. je oddal neveljaven odgovor nastavi kot uporabnikov odgovor vrednost 5 */
            $userAnswer = 5;
            if(isset($userAnswers[$questionIndex]) && (int)$userAnswers[$questionIndex] >= 1 && (int)$userAnswers[$questionIndex] <= 4) {
                $userAnswer = $userAnswers[$questionIndex];
            }              

            /* iz baze pridobi vprasanje iz trenutnega kviza, ki se ga obravnana in posodobi njegov zapis v bazi */ 
            $answerHistory = AnswerHistory::where('id_quiz', '=', $quizID) -> where('id_question', '=', $quizAnswer['id_question']) -> first();

            if ($isAttacker) {
                $answerHistory -> attacker_answer = $userAnswer;

                if($userAnswer == $quizAnswer['correct_answer']){
                    $correctAttacker += 1; /* stetje pravilnih  odgovorov za napadalca */
                }
            } else if ($isDefender) {
                $answerHistory -> defender_answer = $userAnswer;

                if($userAnswer == $quizAnswer['correct_answer']){
                    $correctDefender += 1; /* stetje pravilnih  odgovorov za branilca */
                }
            }
            $answerHistory -> save();            
        }

        /* nastavi cas oddaje kviza za uporabnika */
        /* TODO :: pravilno vnesti noter ce je branilec offline */
        if ($isAttacker) {
            $quiz -> submit_time_attacker = date("Y-m-d H:i:s");
            $quiz -> attacker_num_correct_ans = $correctAttacker;
        } else if ($isDefender) {
            $quiz -> submit_time_defender = date("Y-m-d H:i:s");
            $quiz -> attacker_num_correct_ans = $correctDefender;
        }
        $quiz -> save();

        /* TODO :: pregled ce sta ze oba koncala kviz - dodelitev ozemlja ... */

        return Redirect::to("quiz/show/$quizID");
    }

}