<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) { // funkcija koja će biti pokrenuta kad uključimo migracije , kreira tablicu u bazi , u funkciji specificiramo kakva treba biti tablica
            $table->increments('id');
            $table->timestamps();
            $table->string('email'); // string je varchar
            $table->string('first_name');
            $table->string('password');
            $table->rememberToken(); // polje gdje laravel moze staviti token , cokie , databasu , ako log in da se ne izbaci , laravel baca gresku ako nema
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() // funkcija ako želimo back ili početi opet treba dropati kako bi rekreirali ,
    {
        Schema::dropIfExists('users');
    }
}
