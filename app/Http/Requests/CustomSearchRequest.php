<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomSearchRequest extends FormRequest
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
            'type' => 'required|integer',
            'category' => 'required|integer',
            'age' => 'required|integer|integer',
        ];
    }
    public function messages()
    {
        return [
            'type.required'      => 'this field is required',
            'type.integer'       => 'this field must be an integer',
            'category.required'  => 'this field  required',
            'category.integer'   => 'this field must be an integer',
            'age.required'       => 'this field is required',
            'age.integer'       => 'this field must be an integer',
        ];
    }
}
