<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserMeta;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userMeta = $user->userMeta;
        $users = User::with(['userMeta' => function($query) {
            $query->orderBy('cognome')->orderBy('nome');
        }])->get()->sortBy(function($user) {
            return $user->userMeta->cognome . ' ' . $user->userMeta->nome;
        });

        return view('auth.home', [
            'nome' => $userMeta->nome,
            'cognome' => $userMeta->cognome,
            'users' => $users,
        ]);
    }
}
