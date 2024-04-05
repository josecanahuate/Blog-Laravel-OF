<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function creating(Post $post): void
    {
        if (! App::runningInConsole()) {
            $post->user_id = auth()->user()->id;
        }
    }

    /**
     * Handle the Post "deleted" event. reemplazamos deleted por deleting
     */
    public function deleting(Post $post): void
    {
        //tiene alguna img asociada al post?
        if ($post->image) {
            //si tiene imagen, eliminarla del storage
            Storage::delete($post->image->url);

            //eliminar el registro de la imagen en la BD
            $post->image->delete();
        }
    }


}
