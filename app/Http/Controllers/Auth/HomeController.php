<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userMeta = $user->userMeta;

        return view('home', [
            'nome' => $userMeta->nome,
            'cognome' => $userMeta->cognome,
        ]);
    }
}
