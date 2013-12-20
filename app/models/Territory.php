<?php

class Territory extends Eloquent {

    protected $table = 'territories';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('User','id_owner','id');
    }


}