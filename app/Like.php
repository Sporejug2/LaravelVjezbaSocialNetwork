<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //like i dislake pripadaju useru on je dao
    public function user()
    {
        return $this->belongsTo('App\User'); // vracam ovo što pripada like pripada jednom useru
    }

    public function post()
    {
        return $this->belongsTo('App\Post'); // slicna relacija samo je post pripada app post
    }
}
