<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function postSignUp(Request $request)
    {
        $email = $request['email'];
        $first_name = $request['first_name'];
        $password = bcrypt($request['password']);

        $user = new User();
        $user ->email = $email;
        $user -> first_name = $first_name;
        $user->password = $password;
        $user -> save();

        return redirect()->back();
    }

    public function postSignIn(Request $request)
    {

    }
}
/*
namespace app\Http\Controllers;

use App\User; // importan app user
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


// importa request

class UserController extends Controller
{
    public function getDashboard()
    {
        return view('dashboard');
    }

    public function postSignUp(Request $request) // funkcija za signUp , koristiti cemo laraveld independec injekciju request\http\request
        // varijabla request
    {
        $email = $request['email']; // je array za pritup email
        $first_name = $request['first_name'];
        $password = bcrypt($request['password']); // pohraniti pasword kao enkripciju pa cu koristiti helper bcrypt da kriptira i dekriptira

        $user = new User(); // nova instanca user objekta
        $user->email = $email; // pristupid poljima baze kao property modela , pristup emai kao properti i setati kao email
        $user->first_name = $first_name;
        $user->password = $password;

        $user->save(); // to će pohraniti u bazu podataka

        Auth::login($user);

        return redirect() -> route('dashboard'); // redirekta nazad na view
        // ZA KREIRATI TABLICU php artisan migrate
    }


    public function postSignIn(Request $request)// funkcija za sing in , veže se na welcome blade email
    {
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) { // importa s iluminate suport facades auth , imput je na emailu , drugi parametar passord kojem pristupam kroz passwprd key
            return redirect() -> route('dashboard'); // atempt pokusava log in usera s kridencijalima ako faila vraca false ako uspije dobije true
        }  // ako uspuje vraca redirekt u route
        return redirect() -> back(); // ako ne vraca u starting stream ako se ne uspije logirati
    }
}
*/