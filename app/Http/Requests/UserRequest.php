<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserRequest extends FormRequest
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
        $userId = $this->route('id');  // Ottiene l'ID dell'utente dalla route.
        $user = User::findOrFail($userId);
        $userMetaId = $user->userMeta->id;

        return [
            'nome' => [
                'required',
                'string',
                'max:255',
                'regex:/^[^\s][A-Za-zÀ-ÿ\s]*[^\s]$/',
                'regex:/^(?!.*[0-9!@#\$%\^&\*\(\)_\+={}\[\]\|\\:;\"\'<>,\.\?\/~]).*$/'
            ],
            'cognome' => [
                'required',
                'string',
                'max:255',
                'regex:/^[^\s][A-Za-zÀ-ÿ\s]*[^\s]$/',
                'regex:/^(?!.*[0-9!@#\$%\^&\*\(\)_\+={}\[\]\|\\:;\"\'<>,\.\?\/~]).*$/'
            ],
            'cellulare' => [
                'required',
                'string',
                'max:10',
                'min:10',
                'regex:/^[0-9]{10}$/',
                Rule::unique('user_meta', 'cellulare')->ignore($userMetaId)
            ],
            'indirizzo' => 'nullable|string|max:255',
            'cap' => 'nullable|string|max:20',
            'citta' => 'nullable|string|max:255',
            'provincia' => 'nullable|string|max:255',
            'nazione_id' => 'nullable|exists:countries,id',
            'email' => [
                'required',
                'string',
                'email',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
                'max:255',
                Rule::unique('users', 'email')->ignore($userId)
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
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

            'email.email' => 'Immettere una email valida',
            'email.regex' => 'Immettere una email valida',
            'email.unique' => 'L\'email è già stata utilizzata!',
            'email.required' => 'L\'email non può essere vuota',

            'cellulare.unique' => 'Il numero di cellulare è già stato utilizzato',
            'cellulare.required' => 'Il cellulare non può essere vuoto',
            'cellulare.max' => 'Il numero di cellulare deve essere di 10 cifre',
            'cellulare.min' => 'Il numero di cellulare deve essere di 10 cifre',
            'cellulare.regex' => 'Il numero di cellulare deve contenere solo cifre',
        ];
    }
}
