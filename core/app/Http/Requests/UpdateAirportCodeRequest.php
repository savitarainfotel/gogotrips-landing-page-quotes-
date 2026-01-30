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
            'airport' => ['required', 'string', 'max:255'],
            'airport_type' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'iata' => [
                'required',
                'string',
                'max:10',
                Rule::unique('airport_codes', 'iata')->ignore($airportCode),
            ],
            'icao' => ['required', 'string', 'max:10'],
            'faa' => ['required', 'string', 'max:10'],
        ];
    }
}