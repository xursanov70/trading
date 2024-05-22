<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "username" => "required|max:30|regex:/^[A-Za-z0-9\-_]+$/|unique:users,username,except,id",
            "password" => "required|max:30",
            "phone" => "required|string|size:17|starts_with:+998|unique:users,phone,except,id",
        ];
    }

    public function messages()
    {
        return [
            "username.required" => "username kiritng",
            "username.unique" => "username oldin kiritilgan",
            "username.max" => "username 30 ta belgidan kam bo'lishi kerak",
            "username.min" => "username 2 ta belgidan kam bo'lmasligi kerak",
            "username.regex" => "yaroqsiz username kiritildi",

            
            "password.required" => "parol kiriting",
            "password.min" => "parol 5 ta belgidan kam bo'lmasligi kerak",
            "password.max" => "parol 30 ta belgidan kam bo'lishi kerak",

            "phone.required" => "telefon raqam kiriting",
            "phone.unique" => "bu raqam oldin kiritilgan",
            "phone.size" => "telefon raqamni to'liq kiriting",
            "phone.starts_with" => "o'zbekistanga tegishli telefon raqami kiriting",

        ];
    }
}
