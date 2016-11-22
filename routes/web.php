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
    })->name('home');

    Route::post('/signup', [
        'uses' => 'UserController@postSignUp',// signup ce pisati u url , dajemo mu array funkcija koja se pokrece kada kliknemo request sign up
        'as' => 'signup'
    ]);

    Route::post('/signin', [
            'uses' => 'UserController@postSignIn',
            'as' => 'signin'
        ]);
    Route::get('/logout' , [ // koristi kontroler za koji smo kreirali metodu
        'uses' => 'UserController@getLogout',
        'as' => 'logout'
     ]);

    Route::get('/account', [
       'uses' => 'UserController@getAccount',
        'as' => 'account'
    ]);



    Route::post('/upateaccount', [
        'uses' => 'UserController@postSaveAccount',
        'as' => 'account.save'
    ]);

    Route::get('/userimage/{filename}' ,[
        'uses' => 'UserController@getUserImage',
        'as' => 'account.image'
    ]);

    Route::get('/dashboard', [// ruta dohvacanje get dashboard
            'uses' => 'PostController@getDashboard',// user kontrola funkcija
            'as' => 'dashboard', // ime as dashboard
            'middleware' => 'auth' // autentifikacija
    ]);
 // routa post koji ce se zvati kad stisnemo submit

    Route::post('/createpost', [ // zove se create post
            'uses' => 'PostController@postCreatePost', // koristi post kontroler na post create post metodi
            'as' => 'post.create', // ime post crete
        'middleware' => 'auth' // protektamo routh jer ne zelimo da nam netko iz terminala kreira post
    ]);
    Route::get('/delete-post/{post_id}', [ // specificira post za brisanje , da nije normalno ime nego da je broj value , i dajemo ime parametra post_id
        'uses' => 'PostController@getDeletePost',
        'as' => 'post.delete',
        'middleware' => 'auth'
    ]);

    Route::post('/edit' , [
      'uses' => 'PostController@postEditPost',
        'as' => 'edit'
        ]);

    Route::post('/like', [
        'uses' => 'PostController@postLikePost',
        'as' => 'like'
    ]);
        /////////////////////////////////

    });




