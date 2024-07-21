<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Country;

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
            'countries' => $countries, // Passa la lista dei paesi alla vista
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
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

        return redirect()->route('profile.index')->with('success', 'Profilo aggiornato con successo!');
    }
}
