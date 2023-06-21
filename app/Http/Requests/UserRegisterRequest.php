<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => ["required", "string"],
            "email" => ['required', 'unique:users,email'],
            "password" => ['required', 'min:8', 'confirmed'],
            // 'image' => ['nullable', 'base64image'],
        ];
    }
    public function messages()
    {
        return [
            "name.required" => "Name is required.",
            "email.required" => "Email is required.",
            "email.unique" => "This email already exists in our database!",
            "password.required" => "<PASSWORD> is required.",
            "password.min" => "The password must be at least 8",
            "password.confirmed" => "must confirmed the password",
            // 'image.base64image' => "the image must store Base64",
        ];
    }
}
