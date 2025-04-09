<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'currency_id' => 'required|integer|exists:currencies,id',
            'tax_cost' => 'required|numeric|min:0',
            'manufacturing_cost' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'description.required' => 'La descripción es obligatoria.',
            'price.required' => 'El precio es obligatorio.',
            'currency_id.required' => 'La moneda es obligatoria.',
            'tax_cost.required' => 'El costo de impuestos es obligatorio.',
            'manufacturing_cost.required' => 'El costo de fabricación es obligatorio.',
        ];
    }

    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(
            response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422)
        );
    }
}
