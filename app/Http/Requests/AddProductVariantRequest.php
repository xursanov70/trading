<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductVariantRequest extends FormRequest
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
            "price" => "required|integer",
            "sale_price" => "required|integer",
            "count" => "required|max:100|integer",
            "color" => "required|max:100|string",
            "product_id" => "required|integer",
        ];
    }

    public function messages(){

        return [
            "price.required" => "Mahsulot sotib olingan narxini kiriting",
            "price.max" => "Mahsulot sotib olingan narxi 80 belgidan ko'p bo'lmasligi kerak",
            "price.integer" => "Mahsulot sotib olingan narxini integer holatida kiriting",

            "sale_price.required" => "Mahsulot sotuv narxini kiriting",
            "sale_price.max" => "Mahsulot sotuv narxi 80 belgidan ko'p bo'lmasligi kerak",
            "sale_price.integer" => "Mahsulot sotuv narxini integer holatida kiriting",

            "count.required" => "Mahsulot sonini kiriting",
            "count.max" => "Mahsulot soni 100 belgidan ko'p bo'lmasligi kerak",
            "count.integer" => "Mahsulot sonini integer holatida kiriting",

            "color.required" => "Mahsulot ranginini kiriting",
            "color.max" => "Mahsulot rangini 100 belgidan ko'p bo'lmasligi kerak",
            "color.string" => "Mahsulot ranginini string holatida kiriting",

            "product_id.required" => "Mahsulot id raqamini kiriting",
            "product_id.integer" => "Mahsulot id raqam holatida kiriting",
        ];
    }
}
