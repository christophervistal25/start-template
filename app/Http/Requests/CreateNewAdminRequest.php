<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class CreateNewAdminRequest extends FormRequest
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
            'name'             => 'required',
            'username'         => 'required|unique:users',
            'email'            => 'required|unique:users',
            'password'         => 'required|confirmed|min:6',
            'profile_image'    => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
