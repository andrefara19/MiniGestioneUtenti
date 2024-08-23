<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'titolo' => [
                'required',
                'string',
                'max:255',
                'regex:/^[^\s].*/',
            ],
            'comune' => [
                'required',
                'string',
                'max:255',
                'regex:/^[^\s][A-Za-zÀ-ÿ\s]*[^\s\W]$/',
            ],
            'provincia' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[^\s][A-Za-zÀ-ÿ\s]*[^\s\W]$/',
            ],
            'indirizzo' => [
                'required',
                'string',
                'max:255',
                'regex:/^[^\s].*/',
            ],
            'data_inizio' => [
                'required',
                'date',
            ],
            'data_fine' => [
                'required',
                'date',
                'after_or_equal:data_inizio'
            ],
            'posti' => 'required|integer|max:250',
            'ospiti' => 'required|integer|lte:posti',
        ];
    }

    /**
     * Get the custom messages for validation errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'titolo.required' => 'Il titolo è obbligatorio',
            'titolo.regex' => 'Il titolo non può iniziare con uno spazio',
            'titolo.max' => 'Il titolo non può superare i 255 caratteri',

            'comune.required' => 'Il comune è obbligatorio',
            'comune.regex' => 'Il comune non può iniziare o terminare con uno spazio e non può contenere numeri o caratteri speciali',
            'comune.max' => 'Il comune non può superare i 255 caratteri',

            'provincia.regex' => 'La provincia non può iniziare o terminare con uno spazio e non può contenere numeri o caratteri speciali',
            'provincia.max' => 'La provincia non può superare i 255 caratteri',

            'indirizzo.required' => 'L\'indirizzo è obbligatorio',
            'indirizzo.regex' => 'L\'indirizzo non può iniziare con uno spazio',
            'indirizzo.max' => 'L\'indirizzo non può superare i 255 caratteri',

            'data_inizio.required' => 'La data di inizio è obbligatoria',

            'data_fine.required' => 'La data di fine è obbligatoria',
            'data_fine.after_or_equal' => 'La data non può essere precedente a quella di inizio',

            'posti.required' => 'Il numero di posti è obbligatorio',
            'posti.integer' => 'Il numero di posti deve essere un numero intero',
            'posti.max' => 'Il numero di posti non può superare 250',

            'ospiti.required' => 'Il numero di ospiti è obbligatorio',
            'ospiti.integer' => 'Il numero di ospiti deve essere un numero intero',
            'ospiti.lte' => 'Il numero di ospiti non deve superare il numero di posti disponibili',
        ];
    }
}
