<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{



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
        $user ->first_name = $first_name;
        $user ->password = $password;
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

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function getAccount()
    {
        return view('account', ['user' => Auth::user()]); //vraca view account view i proslijedjujemo mu usera , trenutno log in usera
    }

    public function postSaveAccount(Request $request)
    {
        $this->validate($request , [
            'first_name' => 'required|max:120'
        ]);// validacija metode koju primamo s forme , definiram pravila

        $user = Auth::user(); // vracam trenutnog usere
        $user -> first_name = $request['first_name']; // setam frist name i proslijedjujem mu funkciju kroz request
        $user->update(); // spremam ondosnu updateam usera
        $file = $request->file('image'); // dohvacam file kroz request zovem file metodu i specificiram ime filea
        $filename = $request['first_name'] . '-' . $user->id . '.jpg';  //setam file name , ime usera , razmak , id usera , ekstenzija samo jpeg
        if($file){
            Storage::disk('local')->put($filename, File::get($file)); // helper koji dopusta laravel storage enguine , sprema file na file sistem tj na server , moze pristupiti setingu i storati lako file
        //file u koji file da stavi koristi file , facades , dohvati file , sprema trenutni file
        }
        return redirect()->route('account');
    }

    public function getUserImage($filename)
    {
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }
    /////////////////////////////////////////////////



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
        // ZA KREIRATI TABLICU

php artisan migrate
 php artisan make:model Like
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