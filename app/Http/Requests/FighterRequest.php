<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FighterRequest extends FormRequest
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
            'height' => 'required|numeric',
            'weight' => 'required|numeric|min:49|max:120',
            'martial_art_style_id' => 'required|exists:martial_art_styles,id',
            'country_id' => 'required|exists:countries,id',
        ];
    }
}
