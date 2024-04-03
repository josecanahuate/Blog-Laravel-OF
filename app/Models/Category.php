<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

        //asignacion masiva admin.categories.create
        protected $fillable = ['name', 'slug']; 

        //relacion uno a muchos entre usuario y post
        public function posts(){    
            return $this->hasMany(Post::class);  
        }   
}
