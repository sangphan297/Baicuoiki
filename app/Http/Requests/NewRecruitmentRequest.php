<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewRecruitmentRequest extends FormRequest
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
           'rname' => 'required|min:2',
           'id_cat' => 'required',
           //'photo' => 'required',
           'rate' => 'required|numeric',
           'hours' => 'required|numeric',
           'address' => 'required',
           'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
           'rname.required' => 'Name cannot be left blank.',
           'rname.min' => 'The minimum name is 2 characters.',
           'id_cat.required' => 'The list cannot be empty.',
           //'photo.required' => 'The picture has not been Up.',
           'rate.required' => 'Rate cannot be left blank.',
           'rate.numeric'  => 'Rate is number.',
           'hours.required' => 'Hours cannot be left blank.',
           'hours.numeric' => 'Hours is number.',
           'address.required' => 'Address cannot be left blank.',
           'description.required' => 'Description cannot be left blank.',
        ];
    }
}
