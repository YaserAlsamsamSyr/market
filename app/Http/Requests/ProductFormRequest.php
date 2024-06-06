<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
            'img'=>'required|image|mimes:png,jpg,jpeg|dimensions:min_width=100,min_height=100,max_width=1500,max_height=1500',
            'rate'=>'integer',
            'category'=>'string|max:10|min:3',
            'name'=>'string|max:50|min:2',
            'price'=>'numeric',
            'amount'=>'integer'
        ];
    }
}
