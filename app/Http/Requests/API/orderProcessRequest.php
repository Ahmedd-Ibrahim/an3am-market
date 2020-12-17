<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class orderProcessRequest extends FormRequest
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
            'address_id' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'address_id.required' => 'Address id is required',
            'address_id.integer' => 'Address id must be an integer'
        ];
    }
}
