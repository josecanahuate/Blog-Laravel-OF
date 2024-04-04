<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if($this->user_id == auth()->user()->id) {
            return true;
        } else {
            abort(403, 'Unauthorized action');
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        //si status esta marcado como default = borrador
        $rules = [
            'name' => 'required',
            'slug' => 'required|unique:posts',
            'status' => 'required|in:1,2',
        ];
    
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