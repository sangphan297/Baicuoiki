<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
           'email' => 'required|min:2',
           'password' => 'required|min:6',
           'password_confirm' => 'required|same:password',
           'fullname' => 'required|min:2',
        ];
    }

    public function messages()
    {
        return [
           'email.required' => 'Email cannot be left blank. ',
           'username.min' => 'The minimum email is 2 characters.',

           'password.required' => 'Password cannot be left blank.',
           'password.min' => 'Password is at least 6 characters.',

           'password_confirm.required' => 'Password Confirm cannot be left blank.',
           'password_confirm.same' => 'Enter Password Confirm same as Password.',

           'fullname.required' => 'Fullname cannot be left blank.',
           'fullname.min' => 'Fullname is at least 2 characters.',
        ];
    }
}
