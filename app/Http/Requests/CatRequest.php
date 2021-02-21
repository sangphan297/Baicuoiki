<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CatRequest extends FormRequest
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
           'cname' => 'required|min:2'
        ];
    }

    public function messages()
    {
        return [
           'cname.required' => 'The list cannot be empty.',
           'cname.min' => 'The minimum list is 2 characters.'
        ];
    }
}
