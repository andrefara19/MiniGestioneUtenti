<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserMeta;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function getCountries()
    {
        $countries = Country::all();
        return response()->json($countries);
    }

    public function register(Request $request)
    {
        $messages = [
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

        $validator = Validator::make($request->all(), [
            'nome' => [
                'required',
                'string',
                'max:255',
                'regex:/^[^\s][A-Za-zÀ-ÿ\s]*[^\s]$/',
                'regex:/^(?!.*[0-9!@#\$%\^&\*\(\)_\+={}\[\]\|\\:;\"\'<>,\.\?\/~`]).*$/'
            ],
            'cognome' => [
                'required',
                'string',
                'max:255',
                'regex:/^[^\s][A-Za-zÀ-ÿ\s]*[^\s]$/',
                'regex:/^(?!.*[0-9!@#\$%\^&\*\(\)_\+={}\[\]\|\\:;\"\'<>,\.\?\/~`]).*$/'
            ],
            'cellulare' => [
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
            'email' => 'required|string|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        UserMeta::create([
            'user_id' => $user->id,
            'nome' => $request->nome,
            'cognome' => $request->cognome,
            'indirizzo' => $request->indirizzo,
            'cap' => $request->cap,
            'citta' => $request->citta,
            'provincia' => $request->provincia,
            'nazione_id' => $request->nazione_id,
            'cellulare' => $request->cellulare,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Registrazione avvenuta con successo!',
        ], 201);
    }
}
