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
        $countries = Country::all();
        return view('auth.register', compact('countries'));
    }

    public function register(Request $request)
    {   
        $messages = [
            'email.unique' => 'L\'email è già stata utilizzata!',
            'nome.required' => 'Il nome non può essere vuoto',
            'cognome.required' => 'Il cognome non può essere vuoto',
            'password.required' => 'La password non è valida',
            'nome.regex' => 'Nel nome sono presenti numeri o caratteri speciali',
            'cognome.regex' => 'Nel cognome sono presenti numeri o caratteri speciali',
            'nome.regex_start' => 'Il nome non può iniziare con spazio',
            'cognome.regex_start' => 'Il cognome non può iniziare con spazio',
            'nome.regex_space' => 'Nel nome, dopo lo spazio, serve un carattere',
            'cognome.regex_space' => 'Nel cognome, dopo lo spazio, serve un carattere',
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
            'indirizzo' => 'nullable|string|max:255',
            'cap' => 'nullable|string|max:20',
            'citta' => 'nullable|string|max:255',
            'provincia' => 'nullable|string|max:255',
            'nazione_id' => 'required|exists:countries,id',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
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
        ]);

        return redirect()->route('register')->with('success', 'Registrazione avvenuta con successo!');
    }
}
