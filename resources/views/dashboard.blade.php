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
            <header><h3>Što ljudi kažu</h3></header>
            @foreach($posts as $post) <!-- ovdje lupam kroz postove, posts mora biti isti postu iz arraya  -->
           <article class="post" data-postid="{{ $post->id }}">
                <p> {{ $post->body }} </p> <!-- pristup postu body , kao property , sve ostalo napravi laravel -->
                <div class="info">
                    Posted by {{ $post->user->first_name }} on {{ $post->created_at }} <!-- ako zelimo da pise ime , mogu pristupati imenu kao property , pristupam useru u post.php i imenu first name -->
                </div>
                <div class="ineraction">
                    <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}</a> |
                    <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You don\'t like this post' : 'Dislike' : 'Dislike'  }}</a> |



                @if(Auth::user() == $post->user)

                        <a href="#" class="edit">Edit</a> | <!-- zelimo da radi tako da spojimo na event lisener-->
                        <a href="{{ route('post.delete' , ['post_id' => $post->id]) }}">Delete</a> <!-- zovem rout imena post.delete , dajem mu array post_id varijable argumenti -->
                        <!--  mapam mi value post i ime id post , kao propety pristupamo-->
                        @endif

                </div>
           </article> <!-- artikl za svaki post -->
                @endforeach
        </div>
    </section>
    <!-- modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal"> <!-- id edit model -->
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Post</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="post-body">Edit the post</label><!-- for body -->
                            <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="modal-save">Save changes</button> <!-- kad se save klikne poslati request -->
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
        var token= '{{ Session::token() }}'; <!-- sprema token u varijablu token kad treba -->
        var urlEdit = '{{ route('edit') }}'; <!--  varijabla url proslijedjuje korektnu rutu -->
        var urlLike = '{{ route('like') }}';
    </script>
 @endsection