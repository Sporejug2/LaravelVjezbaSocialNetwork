<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class User extends Model // implementira autentifikaciju
{
    //konekcija na bazu u background , mozemo pristupati svakom polju u tablici , bez specificiranja ičeg kada koristimo alokvent , zanimljiv način za pristup bazi
    // user table se spaja na user da se spaja na user 2 morali bi staviti user 2 ili protected
    // implementirati autentifikaciju  , jednostavno autentifikaciju da ne moram rucno provjeriti autentifikaciju
    // funkcija za autentifikaciju , kontrakt gore i ovaj trade


}
