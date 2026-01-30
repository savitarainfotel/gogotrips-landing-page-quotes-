<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAirportCodeRequest extends FormRequest
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
        $airportCode = $this->route('airport_code');

        return [
            'airport' => ['nullable', 'string', 'max:255'],
            'iata_code' => [
                'nullable',
                'string',
                'max:10',
                Rule::unique('airport_codes', 'iata_code')->ignore($airportCode),
            ],
            'city' => ['nullable', 'string', 'max:255'],
            'iso_country' => ['nullable', 'string', 'max:255'],
            'iso_region' => ['nullable', 'string', 'max:255'],
            'icao_code' => ['nullable', 'string', 'max:10'],
            'coordinates' => ['nullable', 'string', 'max:255'],
        ];
    }
}
