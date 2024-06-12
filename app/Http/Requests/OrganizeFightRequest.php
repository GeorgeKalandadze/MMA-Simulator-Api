<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Fighter;

class OrganizeFightRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // You can modify this based on your authorization logic
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'fight_date' => 'required|date',
            'status' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'fighters' => 'required|array|size:2',
            'fighters.*' => 'required|integer|exists:fighters,id',
        ];
    }

    /**
     * Configure the validator instance.
     */
    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $fighterIds = $this->input('fighters');
            if ($fighterIds) {
                $fighters = Fighter::whereIn('id', $fighterIds)->get();
                if ($fighters->count() != 2) {
                    $validator->errors()->add('fighters', 'There must be exactly two fighters.');
                } else {
                    $weightDivisions = $fighters->pluck('weight_division_id')->unique();
                    if ($weightDivisions->count() > 1) {
                        $validator->errors()->add('fighters', 'The fighters must belong to the same weight division.');
                    }
                }
            }
        });
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'fight_date.required' => 'The fight date is required.',
            'fight_date.date' => 'The fight date must be a valid date.',
            'status.required' => 'The status is required.',
            'status.string' => 'The status must be a string.',
            'status.max' => 'The status may not be greater than 255 characters.',
            'location.required' => 'The location is required.',
            'location.string' => 'The location must be a string.',
            'location.max' => 'The location may not be greater than 255 characters.',
            'fighters.required' => 'There must be exactly two fighters.',
            'fighters.array' => 'The fighters field must be an array.',
            'fighters.size' => 'There must be exactly two fighters.',
            'fighters.*.required' => 'Each fighter ID is required.',
            'fighters.*.integer' => 'Each fighter ID must be an integer.',
            'fighters.*.exists' => 'Each fighter ID must exist in the fighters table.',
        ];
    }
}
