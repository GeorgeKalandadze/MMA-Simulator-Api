<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainFighterRequest extends FormRequest
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
            'training_type' => 'required|string|in:strength,agility,stamina',
            'intensity' => 'required|integer|min:1|max:10',
        ];
    }
}