<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function  index() {
        /* $posts = Post::where('status', 2)->get(); */
        $posts = Post::where('status', 2)->latest('id')->paginate(8); //Paginación de posts
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post) {
        //muestra los post similares en show.blade.php
        $similares = Post::where('category_id', $post->category_id)
        ->where('status', 2) //post con status 'publicado' = 2
        ->where('id', '!=', $post->id) //post con status 'id' != post
        ->latest('id') //orden descendente
        ->take(4) // cantidad de post que se mostraran (4)
        ->get(); //relacion

        return view('posts.show', compact('post', 'similares'));
    }

    public function category(Category $category){
        $posts = Post::where('category_id',$category->id)
            ->where('status','=',2)
            ->latest('id')
            ->paginate(8);
        
        return view("posts.category", compact('category','posts'));
    }

    public function tag(Tag $tag){
        $posts = $tag->posts()
        ->where( "status","=",2 )
        ->latest('id')
        ->paginate(4);

        return view("posts.tag", compact('tag','posts'));

    }
}


//->latest('id') -> los ultimos post creado, aparecen de primero en la lista