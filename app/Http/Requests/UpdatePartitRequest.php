<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePartitRequest extends FormRequest
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
            'local_id' => 'required|exists:equips,id',
            'visitant_id' => 'required|exists:equips,id|different:local_id',
            'data_partit' => 'required|date',
            'gols_local' => 'required|integer|min:0',
            'gols_visitant' => 'required|integer|min:0',
        ];
    }

    /**
     * Mensajes de error en español.
     */
    public function messages(): array
    {
        return [
            'gols_local.required' => 'Los goles locales son obligatorios al actualizar.',
            'gols_visitant.required' => 'Los goles visitantes son obligatorios al actualizar.',
        ];
    }
}
