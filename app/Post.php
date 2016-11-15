<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
//ovdje pravimo relaciju na točno na jedan stupac , moramo pikat relaciju php fileu da mozemo pristupiti relaciji , ako kreiramo usera želimo mu post dodati , treba definirati destinaciju

    public function user()
    {
        return $this-> belongsTo('App\User');// vraća query , ovraca ovo i opisuje relaciju , pripada useru, string je arugemt
        // relacija izmedju postova post pripada useru

    }

    public function likes()
    {
        // post moze imati vise likeova
        return $this->hasMany('App\Like');
    }
}
