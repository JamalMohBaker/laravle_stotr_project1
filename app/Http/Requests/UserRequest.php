<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $user = $this->route('user',0);
        $id = $user ? $user->id : 0;
        return [
            'name' => 'required|string|max:255|min:3',
            'email' => "required|unique:users,email,{$id}",
            'password'=> 'required|string|min:8|confirmed',
            'status' => 'in:active,inactive,blocked',
            'type' => 'in:user,admin,super-admin',

            // 'password_confirmation'=> ' required|string|min:8|confirmed',
        ];
    }
}

