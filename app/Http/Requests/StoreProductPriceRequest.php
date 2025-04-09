<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class StoreProductPriceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => [
                'integer',
                'exists:products,id', // Verifica que product_id exista en la tabla products
            ],
            'currency_id' => [
                'required',
                'integer',
                'exists:currencies,id'
            ],
            'price' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'El campo producto es obligatorio.',
            'product_id.integer' => 'El campo producto debe ser un número entero.',
            'product_id.exists' => 'El producto especificado no existe.',
            'currency_id.required' => 'El campo divisa es obligatorio.',
            'currency_id.integer' => 'El campo divisa debe ser un número entero.',
            'currency_id.exists' => 'La divisa especificada no existe.',
            'currency_id.unique' => 'Ya existe un precio para este producto y divisa.',
            'price.required' => 'El campo precio es obligatorio.',
            'price.numeric' => 'El campo precio debe ser un número.',
            'price.min' => 'El campo precio debe ser mayor o igual a 0.',
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(
            response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422)
        );
    }
}
