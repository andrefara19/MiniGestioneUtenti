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
                'string',
                // 'after:now',
                // function ($attribute, $value, $fail) {
                //     if (strtotime($value) - time() < 1800) {
                //         $fail('La data di inizio deve essere almeno 30 minuti nel futuro.');
                //     }
                // },
            ],
            'data_fine' => [
                'required',
                'string',
                // 'after:start_date',
                // function ($attribute, $value, $fail) {
                //     $start_date = $this->input('data_inizio');
                //     $end_date = $value;


                //     if (strtotime($end_date) - strtotime($start_date) < 1800) {
                //         $fail('La data di fine deve essere almeno 30 minuti successiva alla data di inizio.');
                //     }
                // },
            ],
            'posti' => 'required|integer|max:250',
            'ospiti' => 'required|integer|max:250',
            // 'gratuito' => 'required|boolean',
        ];
    }

    // /**
    //  * Get the custom messages for validation errors.
    //  *
    //  * @return array
    //  */
    // public function messages(): array
    // {
    //     return [
    //         'titolo.regex_start' => 'Il titolo non può iniziare con spazio',
    //         'titolo.required' => 'Il titolo non può essere vuoto',

    //         'comune.regex_start' => 'Il comune non può iniziare con spazio',
    //         'comune.regex' => 'Nel comune sono presenti numeri o caratteri speciali',
    //         'comune.required' => 'Il comune non può essere vuoto',

    //         'provincia.regex_start' => 'La provincia non può iniziare con spazio',
    //         'provincia.regex' => 'Nella provincia sono presenti numeri o caratteri speciali',

    //         'indirizzo.regex_start' => 'L\'indirizzo non può iniziare con spazio',

    //         'data_inizio.required' => 'La data di inizio è obbligatoria.',
    //         'data_inizio.date' => 'La data di inizio deve essere una data valida.',
    //         'data_inizio.after' => 'La data di inizio deve essere nel futuro.',
    //         'data_inizio.after_or_equal' => 'La data di inizio deve essere almeno 30 minuti nel futuro.',

    //         'data_fine.required' => 'La data di fine è obbligatoria.',
    //         'data_fine.date' => 'La data di fine deve essere una data valida.',
    //         'data_fine.after' => 'La data di fine deve essere successiva alla data di inizio.',
    //         'data_fine.after_or_equal' => 'La data di fine deve essere almeno 30 minuti successiva alla data di inizio.',

    //         'posti.required' => 'Il numero di posti è obbligatorio.',
    //         'posti.integer' => 'Il numero di posti deve essere un numero intero.',
    //         'posti.max' => 'Il numero di posti non può superare 250.',

    //         'ospiti.required' => 'Il numero di ospiti è obbligatorio.',
    //         'ospiti.integer' => 'Il numero di ospiti deve essere un numero intero.',
    //         'ospiti.max' => 'Il numero di ospiti non può superare 250.',

    //         'gratuito.required' => 'Il campo gratuito è obbligatorio.',
    //     ];
    // }
}
