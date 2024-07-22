<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Country;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userMeta = $user->userMeta;
        $countries = Country::all(); 
        $country = $userMeta->country; 

        return view('auth.profile', [
            'nome' => $userMeta->nome,
            'cognome' => $userMeta->cognome,
            'indirizzo' => $userMeta->indirizzo,
            'cap' => $userMeta->cap,
            'citta' => $userMeta->citta,
            'provincia' => $userMeta->provincia,
            'nazione_id' => $userMeta->nazione_id,
            'nazione' => $country ? $country->name : 'N/A',
            'countries' => $countries,
        ]);
    }

    public function update(Request $request)
    {
        $messages = [
            'email.unique' => 'L\'email è già stata utilizzata!',
            'nome.required' => 'Il nome non può essere vuoto',
            'cognome.required' => 'Il cognome non può essere vuoto',
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
            'nazione_id' => 'nullable|exists:countries,id',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();
        $userMeta = $user->userMeta;

        $userMeta->update([
            'nome' => $request->nome,
            'cognome' => $request->cognome,
            'indirizzo' => $request->indirizzo,
            'cap' => $request->cap,
            'citta' => $request->citta,
            'provincia' => $request->provincia,
            'nazione_id' => $request->nazione_id,
        ]);

        return redirect()->route('profile.index')->with('success', 'Profilo aggiornato con successo!');
    }
}
