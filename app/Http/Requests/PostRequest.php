<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        //recupera la info del post, esto para el slug no repetido
        $post = $this->route()->parameter('post'); //null

        //si status esta marcado como default = borrador
        $rules = [
            'name' => 'required',
            'slug' => 'required|unique:posts',
            'status' => 'required|in:1,2',
            'file' => 'image',
        ];
    
        if($post){
            $rules['slug'] =  'required|unique:posts,slug,' .$post->id ;//agregamos la excepcion al slug
        }


        //si status esta marcado como publicado
        if ($this->status == 2) {
            $rules = array_merge($rules, [
                'category_id' => 'required',
                'tags' => 'required',
                'extract' => 'required',
                'body' => 'required',
            ]);
        }
    
        return $rules;
    }
    
}
