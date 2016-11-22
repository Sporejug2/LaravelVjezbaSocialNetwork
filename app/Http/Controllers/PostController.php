<?php

namespace App\Http\Controllers;

use App\Post;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class PostController extends Controller
{
    public function getDashboard()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();// dohvacanje posta poredati po najnoviji postovi decending , get kako bi dohvatili sve elemente , kreirati post , pristup post modelu koji koristim gore , all metoda dohvaca sve postove tako pravimo querije kroz modele
        return view('dashboard', ['posts' => $posts]); // dohvacam ga drugim drugim argumentom array , u nizu specificiram sve varijable koje zelim proslijediti u wiew , post kako bi pristupio i proslijedim post
        // sve postove koje dohvacam , dostupini su u view ,
    }

    public function postCreatePost(Request $request)
    {

        $this->validate($request, [ // array sa pravilima
            'body' => 'required|max:1000' // field body potreban i ne dulji od 1000 karaktera
        ]);  // validacija
        $post = new Post();
        $post->body = $request['body']; // dohvaca varijablu , sprema ju u body koji sprema u bazu podataka text body field
        $message = 'There was an error';
        if ($request->user()->posts()->save($post)) {// , ako je insertano dati će poruku /kako bi spremili post treba nam konekcija , pristupamo useru kroz request , poziva post kao funkciju, vraca kao diskonekciju , prsljedjuje post kao argument i sprema post
            $message = 'Post uspješno kreiran!';
        }
        return redirect()->route('dashboard')->with(['message' => $message]); // povežemo još jednu metodu ,with dopušta da proslijedimo poruku , aray s keyom / array message proslijedi
    }

    public function getDeletePost($post_id)
    {
        $post = Post::where('id', $post_id)->first(); // where metoda samo za jedan post , post za sve postove , jedan post na where ( specificiramo polje id gdje trazi , kriterij post id , first lement
        // generečki način traženja id ili moze ::find($post_id) -> first(); // metoda za dohvacanje posta
        if (Auth::user() != $post->user) { // auth user koji je trenutno logiran , pristupam user metodi kako bih dohvatio koji je logiran i razlicito usera posta sto mozemo dohvatiti iz user propertija
            return redirect()->back();
        }
        $post->delete();
        return redirect()->route('dashboard')->with(['message' => 'Successfully deleted!']);
    }
    public function postEditPost(Request $request) // dohvaca request
    {
       $this->validate($request, [  // validira request da ne bude prazan
          'body' => 'required' // pravila , ako faila vraca jsona s errorm
        ]);
        $post = Post::find($request['postId']);
        if (Auth::user() != $post->user) { // auth user koji je trenutno logiran , pristupam user metodi kako bih dohvatio koji je logiran i razlicito usera posta sto mozemo dohvatiti iz user propertija
            return redirect()->back();
        }
        $post->body = $request['body'];
        $post->update();// updateovamo post ne spremamo
        return response()->json(['new_body' => $post->body], 200);
    }

    public function postLikePost(Request $request)
    {
        $post_id = $request['postId'];
        $is_like = $request['isLike'] === 'true';
        $update = false;
        $post = Post::find($post_id);
        if (!$post) {
            return null;
        }
        $user = Auth::user();
        $like = $user->likes()->where('post_id', $post_id)->first();
        if ($like) {
            $already_like = $like->like;
            $update = true;
            if ($already_like == $is_like) {
                $like->delete();
                return null;
            }
        } else {
            $like = new Like();
        }
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        if ($update) {
            $like->update();
        } else {
            $like->save();
        }
        return null;
    }
}