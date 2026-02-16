<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePartitRequest extends FormRequest
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
            'gols_local' => 'nullable|integer|min:0',
            'gols_visitant' => 'nullable|integer|min:0',
        ];
    }

    /**
     * Mensajes de error en español.
     */
    public function messages(): array
    {
        return [
            'local_id.required' => 'El equipo local es obligatorio.',
            'visitant_id.required' => 'El equipo visitante es obligatorio.',
            'visitant_id.different' => 'El equipo visitante no puede ser el mismo que el local.',
            'data_partit.required' => 'La fecha del partido es obligatoria.',
        ];
    }
}
