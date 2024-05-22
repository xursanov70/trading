<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            "category_name" => "required|max:80",
            "category_image" => "nullable|file"
        ];
    }

    public function messages(){

        return [
            "category_name.required" => "Category nomini kiriting",
            "category_name.min" => "Category nomi 3 belgidan kam bo'lmasligi kerak",
            "category_name.max" => "Category nomi 80 belgidan ko'p bo'lmasligi kerak",
            
            "category_image.file" => "Category rasmi fayl holatida kiriting",
        ];
    }
}
