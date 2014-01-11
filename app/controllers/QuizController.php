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

    public function getAttack($attackedUserID = null, $attackedTerritoryID = null, $x = null, $y = null)
    {
        $attackerID = Auth::user() -> id;
        $defenderID = $attackedUserID;

        $attacksOnTerritory = Quiz::where('id_attacked_territory', '=', $attackedTerritoryID) -> where('submit_time_defender','=', NULL) -> count();

        if ($attacksOnTerritory > 0){
            $f = Config::get('error.errorInfo', "napaka");
            return $f("Izbrano ozemljo je ze napadeno");
        }

        if (checkUnsolved() > 0){
            $f = Config::get('error.errorInfo', "napaka");
            return $f("Dokler imas neresene/nepregledane kvize ne mores napasti.");
        }

        if ((!User::find($defenderID) || $defenderID == $attackerID) && $defenderID != 0) {
            $f = Config::get('error.errorInfo', "napaka");
            return $f("Napaden igralec ni veljaven.");
        }
        $attackedTerritory = Territory::where('id', '=', $attackedTerritoryID) -> where('id_owner', '=', $defenderID) -> first();
        if ((!$attackedTerritory || $attackedTerritory -> is_main_village) && 
                $attackedTerritoryID != 0) {
            $f = Config::get('error.errorInfo', "napaka");
            return $f("Izbranega ozemlja ni mogoce napasti.");
        }

        $data = array('x' => $x, 'y' => $y);
        $rules = array(
            'x' => 'integer',
            'y'    => 'integer'
        );
        $validator = Validator::make($data, $rules);
        if (!$validator->passes()) {
            $f = Config::get('error.errorInfo', "napaka");
            return $f("Navedene koordinate niso veljavne.");
        }
   
        /* generiranje kviza */
        $quiz = new Quiz;
        $quiz -> id_attacker = $attackerID;
        $quiz -> id_defender = $defenderID;
        $quiz -> id_attacked_territory = $attackedTerritoryID;
        $quiz -> attacked_territory_pos_x = $x;
        $quiz -> attacked_territory_pos_y = $y;
        if ($defenderID == 0 && $attackedTerritoryID == 0) {
            // napadeno prazno ozemlje: shrani cas zakljucitve kviza + 5 pravilnih odgovorov
            $quiz -> submit_time_defender = date("Y-m-d H:i:s");
            $quiz -> defender_num_correct_ans = 5;
        } else {
            $defenderVillage = Territory::find($attackedTerritoryID);
            //return $defenderVillage;
            if ($defenderVillage['is_npc_village']){
                // napadeno npc ozemlje: shrani cas zakljucitve kviza + 7 pravilnih odgovorov
                $quiz -> submit_time_defender = date("Y-m-d H:i:s");
                $quiz -> defender_num_correct_ans = 7;
            }
        }
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

        $correctNumAnswers = Quiz::where('id', $quizID) -> get(array('attacker_num_correct_ans', 'defender_num_correct_ans', 'quiz_opened_attacker', 'quiz_opened_defender')); 

        $quizOpened = Quiz::where('id', $quizID) -> get(array('id_attacker', 'id_defender', 'quiz_opened_attacker', 'quiz_opened_defender', 'submit_time_defender'))[0]; 
        
        $attackerName = User::find($quizOpened['id_attacker'])['username'];
        $defenderName = User::find($quizOpened['id_defender'])['username'];

        $quizOpenedAttacker = $quizOpened['quiz_opened_attacker'];
        $quizOpenedDefender = $quizOpened['quiz_opened_defender'];
        if($isAttacker && $quizOpened['quiz_opened_attacker'] == NULL){
            $quizOpenedAttacker = time()+Config::get('quiz.quizTimeLimit', 60);
            $quiz -> quiz_opened_attacker = $quizOpenedAttacker;
        }
        elseif($isDefender && $quizOpened['quiz_opened_defender'] == NULL){
            $quizOpenedDefender = time()+Config::get('quiz.quizTimeLimit', 60);
            $quiz -> quiz_opened_defender = $quizOpenedDefender;
        }
        $quiz -> save();


        /* pripravi podatke, ki se jih poslje v View za prikaz neoddanega kviza */
        $data = array(
            'questionsData' => $questionsData, 
            'questions' => $questions, 
            'shuffles' => $shuffles, 
            'quizID' => $quizID, 
            'attackerAnswers' => $attackerAnswers, 
            'defenderAnswers' => $defenderAnswers, 
            'correctAnswers' => $correctAnswers, 
            'correctNumAnswers' => $correctNumAnswers,
            'quizOpenedAttacker' => $quizOpenedAttacker,
            'quizOpenedDefender' => $quizOpenedDefender,
            'isAttacker' => $isAttacker,
            'isDefender' => $isDefender,
            'attackerName' => $attackerName,
            'defenderName' => $defenderName,
            'submit_time_defender' => $quizOpened['submit_time_defender']
            );

        /* igralcu, ki kviza se ni oddal prikazi kviz, na katerega lahko odgovarja */
        if($isAttacker && $quiz -> submit_time_attacker == null && $quizOpenedAttacker - time() > 0) {
            return View::make('quiz', $data);
        }
        elseif($isDefender && $quiz -> submit_time_defender == null && $quizOpenedDefender - time() > 0) {
            return View::make('quiz', $data);
        }

        if($isAttacker && $quiz -> submit_time_attacker == null && $quizOpenedAttacker - time() < 1) {
            $quiz -> submit_time_attacker = date("Y-m-d H:i:s");
            $quiz -> save();
            return View::make('report', $data);
        }
        elseif($isDefender && $quiz -> submit_time_defender == null && $quizOpenedDefender - time() < 1) {
            $quiz -> submit_time_defender = date("Y-m-d H:i:s");
            $quiz -> save();
            return View::make('report', $data);
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
        if ($isAttacker) {
            $quiz -> submit_time_attacker = date("Y-m-d H:i:s");
            $quiz -> attacker_num_correct_ans = $correctAttacker;
        } else if ($isDefender) {
            $quiz -> submit_time_defender = date("Y-m-d H:i:s");
            $quiz -> defender_num_correct_ans = $correctDefender;
        }
        $quiz -> save();

        /* Pregled ce sta ze oba koncala kviz - dodelitev ozemlja ... */
        if ($quiz -> submit_time_attacker != null && $quiz -> submit_time_defender != null) {
            $attacker = User::where('id', '=', $quiz -> id_attacker) -> first();
            $defender = null;
            if ($quiz -> id_defender) {
                $defender = User::where('id', '=', $quiz -> id_defender) -> first();
            }
            // Napadalec zmaga
            if ($quiz -> attacker_num_correct_ans > $quiz -> defender_num_correct_ans) {
                // Osvojitev npc ali igralcevega naselja
                if ($quiz -> id_defender != 0 && $quiz -> id_attacked_territory != 0) {
                    $conqueredTerritory = Territory::where('id', '=', $quiz -> id_attacked_territory)->first();
                    if ($conqueredTerritory -> is_npc_village) {
                        $attacker -> score = $attacker -> score + 10;
                        $defender -> delete();
                    } else {
                        $attacker -> score = $attacker -> score + 15;
                    }
                    $attacker -> save();
                    $conqueredTerritory -> id_owner = $quiz -> id_attacker;
                    $conqueredTerritory -> is_npc_village = 0;
                    $conqueredTerritory -> is_main_village = 0;
                    $conqueredTerritory -> save();
                }
                // Osvojitev praznega ozemlja
                else if ($quiz -> id_defender == 0 && $quiz -> id_attacked_territory == 0) {
                    $conqueredTerritory = new Territory;
                    $conqueredTerritory -> pos_x = $quiz -> attacked_territory_pos_x;
                    $conqueredTerritory -> pos_y = $quiz -> attacked_territory_pos_y;
                    $conqueredTerritory -> id_owner = $quiz -> id_attacker;
                    $conqueredTerritory -> is_npc_village = 0;
                    $conqueredTerritory -> is_main_village = 0;
                    $conqueredTerritory -> name = "Naselje: ". Auth::user() -> username . rand(111,999);
                    $conqueredTerritory -> save();
                    $attacker -> score = $attacker -> score + 5;
                    $attacker -> save();
                }
            } 
            // Branilec zmaga
            else {
                if ($defender) {
                    $defender -> score = $defender -> score + 10;
                    $defender -> save();
                }
            }
        }

        return Redirect::to("quiz/show/$quizID");
    }

}