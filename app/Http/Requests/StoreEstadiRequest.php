<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEstadiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:255',
            'capacitat' => 'required|integer|min:0',
        ];
    }


    public function messages(): array
    {
        return [
            'nom.required' => 'El nombre del estadio es obligatorio.',
            'capacitat.required' => 'La capacidad es obligatoria.',
            'capacitat.integer' => 'La capacidad debe ser un número entero.',
        ];
    }
}
