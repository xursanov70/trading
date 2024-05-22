<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
            "product_name" => "required|max:120",
            "category_id" => "required|integer",
            "product_image" => "nullable|file"
        ];
    }

    public function messages(){

        return [
            "product_name.required" => "Mahsulot nomini kiriting",
            "product_name.min" => "Mahsulot nomi 2 belgidan kam bo'lmasligi kerak",
            "product_name.max" => "Mahsulot nomi 120 belgidan ko'p bo'lmasligi kerak",
            
            "product_image.file" => "Mahsulot rasmi fayl holatida kiriting",

            "category_id.required" => "Category id raqamini kiriting",
            "category_id.integer" => "Category id raqam holatida kiriting",
        ];
    }
}
