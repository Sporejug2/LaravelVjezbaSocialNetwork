<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function getDashboard()
    {
        return view('dashboard');
    }

    public function postSignUp(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users',// helper validacija metoda, od base kontrolera , request od postsing up request \iduce array pravila
            'first_name' => 'required|max:120',// imail rule i zelimo biti unick u databazi , mora biti isti kao email u tablici
            'password' => 'required|min:4'// funkcija za signUp , koristiti cemo laraveld independec injekciju request\http\request , da irst name nije emty i password da nije emty i da je od 4 znaka
            // varijabla request
            ]);

        $email = $request['email'];// je array za pritup email
        $first_name = $request['first_name'];// pohraniti pasword kao enkripciju pa cu koristiti helper bcrypt da kriptira i dekriptira
        $password = bcrypt($request['password']);

        $user = new User(); // nova instanca user objekta
        $user ->email = $email;
        $user -> first_name = $first_name;
        $user->password = $password;
        $user -> save();

        Auth::login($user);

        return redirect()->route('dashboard');

       // return redirect()->route('dashboard');
    }

    public function postSignIn(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',// helper validacija metoda, od base kontrolera , request od postsing up request \iduce array pravila
            // imail rule i zelimo biti unick u databazi , mora biti isti kao email u tablici
            'password' => 'required'// funkcija za signUp , koristiti cemo laraveld independec injekciju request\http\request , da irst name nije emty i password da nije emty i da je od 4 znaka
            // varijabla request
        ]);

        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) { // importa s iluminate suport facades auth , imput je na emailu , drugi parametar passord kojem pristupam kroz passwprd key
            return redirect()->route('dashboard'); // atempt pokusava log in usera s kridencijalima ako faila vraca false ako uspije dobije true
        }  // ako uspuje vraca redirekt u route
        return redirect()->back(); // ako ne vraca u starting stream ako se ne uspije logirati
    }

}
/*
namespace app\Http\Controllers;

use App\User; // importan app user
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


// importa request



        $user = new User();
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