<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJugadoraRequest extends FormRequest
{
    /**
     * Determina si l'usuari està autoritzat a fer aquesta petició.
     */
    public function authorize(): bool
    {
        // Canviem a true per a que ens deixe enviar el formulari
        return true;
    }

    /**
     * Regles de validació que s'aplicaran a la petició.
     */
    public function rules(): array
    {
        return [
            'nom'      => 'required|string|min:3|max:100',
            'dorsal'   => 'required|integer|between:1,99',
            'posicio'  => 'required|string|in:Portera,Defensa,Migcampista,Davantera',
            'equip_id' => 'required|exists:equips,id',
        ];
    }

    /**
     * Missatges d'error personalitzats (Opcional).
     */
    public function messages(): array
    {
        return [
            'nom.required'      => 'El nom de la jugadora és obligatori.',
            'dorsal.between'    => 'El dorsal ha de ser un número entre 1 i 99.',
            'posicio.required'  => 'Has de triar una posició vàlida.',
            'equip_id.exists'   => "L'equip seleccionat no existeix.",
        ];
    }
}    