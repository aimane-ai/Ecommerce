<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'description' => ['required', 'string', 'min:5'],
            'prix' => ['required', 'numeric', 'min:0'],
            'quantite' => ['required', 'integer', 'min:1'],
            'category' => ['required', 'string', 'max:50'],
            'image'=>['image','mimes:png,jpg,svg,webp','max:10240'],
        ];
    }

}
