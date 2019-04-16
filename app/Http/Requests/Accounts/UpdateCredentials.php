<?php

namespace App\Http\Requests\Accounts;

use App\Helpers\ActionTypeManager;
use App\Rules\AuthPassword;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCredentials extends FormRequest
{
    use ActionTypeManager;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    private function changeUsername()
    {
        return [
            'current_username' => 'required',
            'new_username'     => 'required|unique:users,username',
            'current_password' => ['required' , new AuthPassword()],
        ];
    }

    private function changePassword()
    {
        return [
           'user_current_password' => ['required' , new AuthPassword()],
           'new_password'          => 'required|min:6|required_with:confirm_new_password|same:confirm_new_password',
           'confirm_new_password'  => 'required',
        ];
    }

    private function changeProfile()
    {
        return ['profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1000'];
    }

    private function getValidationFields(string $action_type)
    {
        return $this->$action_type();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->getValidationFields(
                        $this->getActionType($this->request->all())
                );
    }

    public function messages()
    {
        return [
            'user_current_password.required' => 'The current password field is required.',
            'new_password.required'          => 'The new password field is required.',
            'confirm_new_password.required'  => 'The confirm password field is required.',
            'new_password.same'              => 'The new password and confirm new password must match.',
            'new_password.min'               => 'The new password must be minimum of 6 characters.',
        ];
    }
}
