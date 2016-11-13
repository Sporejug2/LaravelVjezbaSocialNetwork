@extends('layouts.master') <!--// extenda mastera-->

@section('content')
    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header>
                <h3>Sto imaš za reći</h3>
            </header>
            <form action="{{ route('post.create') }}" method="post">
                <div class="form-group">
                    <textarea class="form-control" name="body" id="new-post" rows="5" placeholder="Tvoj poust"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kreiraj Post</button>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
            </form>
        </div>
    </section>
    <section class="row post"> <!-- bootstrap post i stajla-->
        <div class="col-md-6 col-md-offset-3">
            <header>
                <h3>Šsto ljudi kažu</h3>
            </header>
            <article class="post">
                <p> Post tekst </p>
                <div class="info">
                    Posted by Max on 12.Feb 2016
                </div>
                <div class="ineraction">
                    <a href="#">Like</a>
                    <a href="#">Dislike</a>
                    <a href="#">Edit</a>
                    <a href="#">Delete</a>
                </div>
            </article> <!-- artikl za svaki post -->
            <article class="post">
                <p> Post tekst blabla bla </p>
                <div class="info">
                    Posted by Max on 12.Feb 2016
                </div>
                <div class="ineraction">
                    <a href="#">Like</a>
                    <a href="#">Dislike</a>
                    <a href="#">Edit</a>
                    <a href="#">Delete</a>
                </div>
            </article> <!-- artikl za svaki post -->
        </div>
    </section>
 @endsection