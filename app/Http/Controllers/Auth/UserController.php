<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
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
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $userMeta = $user->userMeta;

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
