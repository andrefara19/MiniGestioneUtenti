<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userMeta = $user->userMeta;

        return view('auth.home', [
            'nome' => $userMeta->nome,
            'cognome' => $userMeta->cognome,
        ]);
    }
}
