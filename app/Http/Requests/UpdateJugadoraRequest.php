<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJugadoraRequest extends FormRequest
{
    /**
     * Determina si el usuario puede hacer esta petición.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación.
     */
    public function rules(): array
    {
        return [
            'nom' => 'required|string|min:3|max:100',
            'dorsal' => 'required|integer|between:1,99',
            'posicio' => 'required|string|in:Portera,Defensa,Migcampista,Davantera',
            'equip_id' => 'required|exists:equips,id',
        ];
    }

    /**
     * Mensajes de error en español.
     */
    public function messages(): array
    {
        return [
            'nom.required' => 'El nombre es obligatorio.',
            'dorsal.required' => 'El dorsal es obligatorio.',
            'posicio.required' => 'La posición es obligatoria.',
            'equip_id.exists' => 'El equipo seleccionado no es válido.',
        ];
    }
}
