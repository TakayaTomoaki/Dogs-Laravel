<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostShareRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'body' => ['bail', 'required', 'min:1', 'max:200'],
          'image' => ['bail', 'nullable', 'image']
        ];
    }
}
