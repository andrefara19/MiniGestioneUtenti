<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::with('userMeta', 'userMeta.country')->findOrFail($id);
        $userMeta = $user->userMeta;

        return view('auth.user_profile', [
            'nome' => $userMeta->nome,
            'cognome' => $userMeta->cognome,
            'indirizzo' => $userMeta->indirizzo,
            'cap' => $userMeta->cap,
            'citta' => $userMeta->citta,
            'provincia' => $userMeta->provincia,
            'nazione' => $userMeta->country->name ?? 'N/A',
        ]);
    }
}
