<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $table = 'forms';
    protected $primaryKey = 'form_id';

    public function form_category(){
        return $this->belongsTo('App\FormCategory','form_category_id');
    }
}
