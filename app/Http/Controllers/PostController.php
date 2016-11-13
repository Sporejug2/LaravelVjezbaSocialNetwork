<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function postCreatePost(Request $request){

        // validacija
        $post = new Post();
        $post -> body = $request['body']; // dohvaca varijablu , sprema ju u body koji sprema u bazu podataka text body field
        $request ->user()->posts()->save($post);// kako bi spremili post treba nam konekcija , pristupamo useru kroz request , poziva post kao funkciju, vraca kao diskonekciju , prsljedjuje post kao argument i sprema post
        return redirect()->route('dashboard');
    }
}