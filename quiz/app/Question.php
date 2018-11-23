<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    protected $primaryKey = 'question_id';

    public function form(){
        return $this->belongsTo('App\Form','form_id');
    }

    public function answers(){
    	return $this->hasMany('App\Answer','answer_id');
    }
}
