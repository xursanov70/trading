<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountRequest extends FormRequest
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
            "discount" => "required|integer",
            'discount_date' => 'required|date|after_or_equal:' . date('Y-m-d'),
        ];
    }

    public function messages(){

        return [
            "discount.required" => "Chegirma uchun foiz kiriting",
            "discount.integer" => "Chegirma uchun foizni integer holatida kiriting",

            "discount_date.required" => "Chegirma tugash muddati kiriting",
            "discount_date.date" => "Chegirma tugash muddati  dateTime holatida kiriting",
            "discount_date.after_or_equal" => "Chegirma tugash muddati  bugungi kundan oldin bo'lmasligi kerak",
        ];
    }
}
