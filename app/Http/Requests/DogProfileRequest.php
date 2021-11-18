<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DogProfileRequest extends FormRequest
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
          'dog_name' => ['bail', 'required', 'min:1', 'max:20'],
          'dog_birthday' => ['bail', 'required', 'date', 'before_or_equal:now'],
          'dog_gender' => ['bail', 'required', 'boolean'],
          'dog_weight' => ['bail', 'required', 'integer', 'max:100'],
          'dog_father' => ['bail', 'required', 'max:5'],
          'dog_mother' => ['bail', 'required', 'max:5'],
          'dog_introduction' => ['bail', 'required', 'max:200'],
          'dog_image' => ['bail', 'nullable', 'image']

        ];
    }
}
