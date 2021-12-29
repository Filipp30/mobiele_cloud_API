<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthCreateNewAccountRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:25'],
            'email' => ['required', 'string', 'email', 'max:35', 'unique:users'],
            'phone_number'=>['nullable','numeric','min:10','unique:users'],
            'password' => ['required', 'string','confirmed','min:6'],
        ];
    }
}
