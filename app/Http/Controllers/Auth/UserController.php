<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Country;


class UserController extends Controller
{
    public function show($id)
    {
        $user = User::with('userMeta', 'userMeta.country')->findOrFail($id);
        $userMeta = $user->userMeta;
        $isAdmin = Auth::user()->is_admin;
        $countries = Country::all();

        return view('auth.user_profile', [
            'user' => $user,
            'nome' => $userMeta->nome,
            'cognome' => $userMeta->cognome,
            'indirizzo' => $userMeta->indirizzo,
            'cap' => $userMeta->cap,
            'citta' => $userMeta->citta,
            'provincia' => $userMeta->provincia,
            'nazione' => $userMeta->country->name ?? 'N/A',
            'nazione_id' => $userMeta->nazione_id,
            'isAdmin' => $isAdmin,
            'countries' => $countries,
        ]);
    }
    public function update(Request $request, $id)
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

        $user = User::findOrFail($id);
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

        return redirect()->route('user.profile', $user->id)->with('success', 'Profilo modificato con successo!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('home')->with('success', 'Utente eliminato con successo!');
    }


}
