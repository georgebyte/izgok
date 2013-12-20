<?php

class Quiz extends Eloquent {

    protected $table = 'quizzes';

    public function userAttack()
    {
        return $this->belongsTo('User','id_attacker','id');
    }
    public function userDefend()
    {
        return $this->belongsTo('User','id_defender','id');
    }
    public function historyQuiz()
    {
        return $this->belongsTo('AnswerHistory','id','id_quiz');
    }
    public function historyQuestion()
    {
        return $this->belongsTo('AnswerHistory','id','id_question');
    }



}