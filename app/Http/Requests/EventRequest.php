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
            'luogo' => [
                'required',
                'string',
                'max:255',
                'regex:/^[^\s][A-Za-zÀ-ÿ\s]*[^\s]$/',
                'regex:/^(?!.*[0-9!@#\$%\^&\*\(\)_\+={}\[\]\|\\:;\"\'<>,\.\?\/~`]).*$/'
            ],
            'indirizzo' => [
                'required',
                'string',
                'max:10',
                'min:10',
                'regex:/^[0-9]{10}$/',
                'unique:user_meta'
            ],
            'indirizzo' => 'nullable|string|max:255',
            'cap' => 'nullable|string|max:20',
            'citta' => 'nullable|string|max:255',
            'provincia' => 'nullable|string|max:255',
            'nazione_id' => 'required|exists:countries,id',
            'email' => 'required|string|email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', 
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
            'nome.regex_start' => 'Il nome non può iniziare con spazio',
            'nome.regex' => 'Nel nome sono presenti numeri o caratteri speciali',
            'nome.regex_space' => 'Nel nome, dopo lo spazio, serve un carattere',
            'nome.required' => 'Il nome non può essere vuoto',

            'cognome.regex_start' => 'Il cognome non può iniziare con spazio',
            'cognome.regex' => 'Nel cognome sono presenti numeri o caratteri speciali',
            'cognome.regex_space' => 'Nel cognome, dopo lo spazio, serve un carattere',
            'cognome.required' => 'Il cognome non può essere vuoto',

            'password.min' => 'La password deve contenere almeno 8 caratteri',
            'password.required' => 'La password non può essere vuota',

            'email.email' => 'Immettere una email valida',
            'email.regex' => 'Immettere una email valida',
            'email.unique' => 'L\'email è già stata utilizzata',
            'email.required' => 'L\'email non può essere vuota',

            'cellulare.unique' => 'Il numero di cellulare è già stato utilizzato',
            'cellulare.required' => 'Il cellulare non può essere vuoto',
            'cellulare.max' => 'Il numero di cellulare deve essere di 10 cifre',
            'cellulare.min' => 'Il numero di cellulare deve essere di 10 cifre',
            'cellulare.regex' => 'Il numero di cellulare deve contenere solo cifre',

            'nazione_id.required' => 'La nazione deve essere selezionata'
        ];
    }
}


$table->string('luogo');
$table->string('indirizzo');
$table->string('comune');
$table->string('provincia');
$table->date('data_inizio');
$table->date('data_fine');
$table->integer('posti');
$table->integer('ospiti');
$table->boolean('gratuito')->default(true);