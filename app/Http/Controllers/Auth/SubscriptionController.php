<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\SubscriptionRequest;
use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function create($id)
    {
        $user = User::findOrFail($id);

        return view('subscriptions.create', [
            'nome' => $user->userMeta->nome,
            'cognome' => $user->userMeta->cognome,
            'cellulare' => $user->userMeta->cellulare,
            'email' => $user->email,
        ]);
    }
    
    // public function store(SubscriptionRequest $request)
    // {
    //     $inputs = $request->validated();

    //     Subscription::create($inputs);

    //     return back()->with('success', 'Evento creato con successo');
    // }
}