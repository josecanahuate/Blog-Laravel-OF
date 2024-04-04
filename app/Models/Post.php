<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

        protected $guarded = ['id', 'created_at', 'updated_at'];

        //relacion uno a muchos inversa entre post y usuario
        public function user(){    
            return $this->belongsTo(User::class);  
        }   

        //relacion uno a muchos inversa entre post y categories
        public function category(){    
            return $this->belongsTo(Category::class);  
        }   

        //relacion muchos a muchos entre post y tags
        public function tags(){    
            return $this->belongsToMany(Tag::class);  
        }   

        //relacion uno a uno polimorfica entre images y post
        public function image() {
            return  $this->morphOne(Image::class, 'imageable');
        }
}
