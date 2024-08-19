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
        $countries = Country::all();

        return view('auth.user_profile', [
            'user' => $user,
            'nome' => $user->userMeta->nome,
            'cognome' => $user->userMeta->cognome,
            'indirizzo' => $user->userMeta->indirizzo,
            'cap' => $user->userMeta->cap,
            'citta' => $user->userMeta->citta,
            'provincia' => $user->userMeta->provincia,
            'nazione_id' => $user->userMeta->nazione_id,
            'cellulare' => $user->userMeta->cellulare,
            'email' => $user->email,
            'isAdmin' => Auth::user()->is_admin,
            'isMyProfile' => Auth::id() == $user->id,
            'countries' => $countries
        ]);
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $userMeta = $user->userMeta;
        $messages = [
            'nome.regex_start' => 'Il nome non può iniziare con spazio',
            'nome.regex' => 'Nel nome sono presenti numeri o caratteri speciali',
            'nome.regex_space' => 'Nel nome, dopo lo spazio, serve un carattere',

            'cognome.regex_start' => 'Il cognome non può iniziare con spazio',
            'cognome.regex' => 'Nel cognome sono presenti numeri o caratteri speciali',
            'cognome.regex_space' => 'Nel cognome, dopo lo spazio, serve un carattere',

            'email.unique' => 'L\'email è già stata utilizzata!',

            'cellulare.unique' => 'Il numero di cellulare è già stato utilizzato!',
            'cellulare.max' => 'Il numero di cellulare deve contenere esattamente 10 cifre',
            'cellulare.min' => 'Il numero di cellulare deve contenere esattamente 10 cifre',
            'cellulare.regex' => 'Il numero di cellulare deve contenere solo cifre senza spazi o lettere',
        ];

        $validator = Validator::make($request->all(), [
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
                'nullable',
                'string',
                'max:10',
                'min:10',
                'regex:/^[0-9]{10}$/',
                'unique:user_meta,cellulare,' . $userMeta->id,
            ],
            'indirizzo' => 'nullable|string|max:255',
            'cap' => 'nullable|string|max:20',
            'citta' => 'nullable|string|max:255',
            'provincia' => 'nullable|string|max:255',
            'nazione_id' => 'nullable|exists:countries,id',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $user->id,
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $user->update(['email' => $request->email]);
        $userMeta->update($request->only([
            'nome',
            'cognome',
            'indirizzo',
            'cap',
            'citta',
            'provincia',
            'nazione_id',
            'cellulare'
        ]));

        return response()->json(['message' => 'Profilo modificato con successo!']);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'Utente eliminato con successo!']);
    }
}
