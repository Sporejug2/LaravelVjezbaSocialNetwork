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
    })->name('home');;

    Route::post('/signup', [
        'uses' => 'UserController@postSignUp',// signup ce pisati u url , dajemo mu array funkcija koja se pokrece kada kliknemo request sign up
        'as' => 'signup'
    ]);

    Route::post('/signin', [
            'uses' => 'UserController@postSignIn',
            'as' => 'signin'
        ]);

        Route::get('/dashboard', [// ruta dohvacanje get dashboard
            'uses' => 'UserController@getDashboard',// user kontrola funkcija
            'as' => 'dashboard', // ime as dashboard
            'middleware' => 'auth' // autentifikacija
        ]);
 // routa post koji ce se zvati kad stisnemo submit
    Route::post('/createpost', [ // zove se create post
            'uses' => 'PostController@postCreatePost', // koristi post kontroler na post create post metodi
            'as' => 'post.create' // ime post crete
    ]);
    });




