@extends('layouts.master') <!--// extenda mastera-->

@section('content')
    @include('includes.message-block')
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
            <header><h3>Šsto ljudi kažu</h3></header>
            @foreach($posts as $post) <!-- ovdje lupam kroz postove, posts mora biti isti postu iz arraya  -->
           <article class="post" data-postid="{{ $post->id }}">
                <p> {{ $post->body }} </p> <!-- pristup postu body , kao property , sve ostalo napravi laravel -->
                <div class="info">
                    Posted by {{ $post->user->first_name }} on {{ $post->created_at }} <!-- ako zelimo da pise ime , mogu pristupati imenu kao property , pristupam useru u post.php i imenu first name -->
                </div>
                <div class="ineraction">
                    <a href="#">Like</a> |
                    <a href="#">Dislike</a> |
                    @if(Auth::user() == $post->user)
                        |
                        <a href="#" class="edit podt-rdit">Edit</a> | <!-- zelimo da radi tako da spojimo na event lisener-->
                        <a href="{{ route('post.delete' , ['post_id' => $post->id]) }}">Delete</a> <!-- zovem rout imena post.delete , dajem mu array post_id varijable argumenti -->
                        <!--  mapam mi value post i ime id post , kao propety pristupamo-->
                        @endif

                </div>
           </article> <!-- artikl za svaki post -->
                @endforeach
        </div>
    </section>
    <!-- modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Post</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="post-body">Edit the post</label>
                            <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="model-save">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
        var token= '{{ Session::token() }}';
        var url = '{{ route('edit') }}'; <!--  varijabla url proslijedjuje routh -->
    </script>
 @endsection