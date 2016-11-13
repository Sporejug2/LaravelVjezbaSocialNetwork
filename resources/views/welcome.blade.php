@extends('layouts.master') <!-- ekstenda  putanju filea koji ekstendamo layouts.master samo pišem master bez.blade.php -->

@section('title') ateljeOs!
    @endsection

@section('content') <!-- insertam ovo u sekciju content-->
   <div class="row">
       <div class="col-md-6"> <!-- jer imamo 12 boja grid u bootstrap  -->
           <h3>Sign Up</h3>
            <form action="{{ route('signup') }}" method="post">
                <div class="form-group">
                    <label for="email"> Tvoj E-mail </label>   <!-- form gup brine se za aligment -->
                     <input class="form-control" type="text" name="email" id="email"> <!-- kontrola od bootstrapa -->
                 </div>
                <div class="form-group">
                    <label for="first_name"> Tvoje ime </label>   <!-- form gup brine se za aligment -->
                    <input class="form-control" type="text" name="first_name" id="first_name"> <!-- kontrola od bootstrapa -->
                </div>
                <div class="form-group">
                    <label for="password"> Tvoj Password </label>   <!-- form gup brine se za aligment -->
                    <input class="form-control" type="password" name="password" id="password"> <!-- kontrola od bootstrapa -->
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                 <input type="hidden" name="_token" value="{{ Session::token() }}"> <!-- Session pristup helper funkciji , dohvaća token i stora ga u field i šalje kao request , automatski radi laravel zaštita xss -->
            </form>
       </div>
       <div class="col-md-6"> <!-- jer imamo 12 boja grid u bootstrap , md medium size svi uređaji će prepoznati kao 2 sign in -->
           <h3>Sign In</h3>
           <form action="{{ route('signin') }}" method="post">
               <div class="form-group">
                   <label for="email"> Tvoj E-mail </label>   <!-- form gup brine se za aligment -->
                   <input class="form-control" type="text" name="email" id="email"> <!-- kontrola od bootstrapa -->
               </div>
               <div class="form-group">
                   <label for="password"> Tvoj Password </label>   <!-- form gup brine se za aligment -->
                   <input class="form-control" type="password" name="password" id="password"> <!-- kontrola od bootstrapa -->
               </div>
               <button type="submit" class="btn btn-primary">Submit</button>
               <input type="hidden" name="_token" value="{{ Session::token() }}">  <!--// token u log in formu , slucaj za svaku formu ako ne uspijemo tokken mismatch -->
           </form>
       </div>
   </div>
@endsection

<!-- Model u laravelu php artisan make:model User  -m kako bi kreirao imigracije , što su modelu - to je mjesto gdje je tvoja logika
gdje pristupaš podatcima kako bi manipulirao podacima , Migracije su cool tool gdje možemo generirati tablice u bazi podataka
u migracijama definiramo skin koji će koristiti tablice , funkcija koja će se pozvati kad stisnemo migraciju , tu u funkciji specificiramo kako
tablica se traba konstruirati i funkcija down ako želimo povratne migracije , dropaš ako opet imigriraš , možeš imigrirati bez korištenja
sqla ovdje kreiraš tablicu kao model i pišeš u bazu -->