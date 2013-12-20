<?php

class AnswerHistory extends Eloquent {

    protected $table = 'answers_history';
    public $timestamps = false;

    public function questions()
    {
        return $this->hasMany('Question','id_question','id');
    }
    public function quizzes()
    {
        return $this->hasMany('Quiz','id_quiz','id');
    }


}