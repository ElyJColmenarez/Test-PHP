<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductUpdateRequest extends FormRequest
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
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'price' => 'sometimes|numeric|min:0',
            'currency_id' => 'sometimes|integer|exists:currencies,id',
            'tax_cost' => 'sometimes|numeric|min:0',
            'manufacturing_cost' => 'sometimes|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'name.sometimes' => 'El nombre es obligatorio.',
            'description.sometimes' => 'La descripción es obligatoria.',
            'price.sometimes' => 'El precio es obligatorio.',
            'currency_id.sometimes' => 'La moneda es obligatoria.',
            'tax_cost.sometimes' => 'El costo de impuestos es obligatorio.',
            'manufacturing_cost.sometimes' => 'El costo de fabricación es obligatorio.',
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
