<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userMeta = $user->userMeta;
        $country = $userMeta->country; 

        return view('auth.profile', [
            'nome' => $userMeta->nome,
            'cognome' => $userMeta->cognome,
            'indirizzo' => $userMeta->indirizzo,
            'cap' => $userMeta->cap,
            'citta' => $userMeta->citta,
            'provincia' => $userMeta->provincia,
            'nazione' => $country ? $country->name : 'N/A',
        ]);
    }
}
