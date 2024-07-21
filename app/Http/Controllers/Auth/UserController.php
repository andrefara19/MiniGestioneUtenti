<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $user = User::findOrFail($id);
        $userMeta = $user->userMeta;

        $request->validate([
            'nome' => 'nullable|string|max:255',
            'cognome' => 'nullable|string|max:255',
            'indirizzo' => 'nullable|string|max:255',
            'cap' => 'nullable|string|max:20',
            'citta' => 'nullable|string|max:255',
            'provincia' => 'nullable|string|max:255',
            'nazione_id' => 'nullable|exists:countries,id',
        ]);

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
