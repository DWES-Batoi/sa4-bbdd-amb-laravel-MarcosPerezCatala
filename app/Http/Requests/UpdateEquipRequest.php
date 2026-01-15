<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEquipRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom'       => ['required', 'string', 'min:3', Rule::unique('equips', 'nom')->ignore($this->equip)],
            'estadi_id' => 'required|integer|exists:estadis,id',
            'titols'    => 'required|integer|min:0',
            'escut'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }
}