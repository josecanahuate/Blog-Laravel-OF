<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id'); //pluck->relacion
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $post = Post::create($request->all());
        

        if ($request->file('file')) {
            $url = Storage::put('public/posts', $request->file('file')); //guarda la imagen en el disco public
            /* return Storage::put('public/posts', $request->file('file'));  */
            
            //creamos un registro de image con url
            $post->image()->create([
                "url" => $url
            ]); 

        //almacenando los campos tags en tabla pivot 'post_tag'
        if($request->tags) {
            $post->tags()->attach($request->tags);
        }
        
        return redirect()->route('admin.posts.index', $post);
    }
}

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('author', $post); //referencia al policy

        $categories = Category::pluck('name', 'id'); //pluck->relacion
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories','tags'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('author', $post); //referencia al policy
        $post->update( $request->all() );

        if($request->file('file') ) {
          $url = Storage::put('public/posts', $request->file('file'));

          if($post->image) {
            Storage::delete($post->image->url);  //eliminar la imagen anterior
            $post->image->update([ 'url' => $url ]);   //actualizar url de la img anterior con la nueva
          } else{
            $post->image()->create(['url'=>$url]); //creando una relacion a Image y guardandola en el post
          }

        //almacenando los campos tags en tabla pivot 'post_tag' metodo sync
        if($request->tags) {
            $post->tags()->sync($request->tags);
        }
          return redirect()->route('admin.posts.edit', $post)->with('info', 'El post se ha actualizado correctamente');
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('author', $post); //referencia al policy
        
        /* ELIMINAR IMAGEN DEL POST CON OBSERVERS */
        $post->delete();
        return redirect()->route('admin.posts.index')
        ->with('info', 'El Post fue eliminado con éxito');
    }
}
