<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/*
 *
 *Aplication Routse
 */

Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::post('/signup', [
        'uses' => 'UserController@postSignUp',// signup ce pisati u url , dajemo mu array funkcija koja se pokrece kada kliknemo request sign up
        'as' => 'signup'
    ]);
});

        // signup ce pisati u url , dajemo mu array funkcija koja se pokrece kada kliknemo request sign up



     // ruta dohvacanje get dashboard
         // user kontrola funkcija
        // ime as dashboard
