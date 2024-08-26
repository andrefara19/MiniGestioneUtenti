<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\SubscriptionRequest;
use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\Guest;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function create($id)
    {
        $user = Auth::user();
        $event = Event::findOrFail($id); 
        
        return view('subscriptions.create', [
            'nome' => $user->userMeta->nome,
            'cognome' => $user->userMeta->cognome,
            'cellulare' => $user->userMeta->cellulare,
            'email' => $user->email,
            'event' => $event
        ]);
    }

    public function store(SubscriptionRequest $request, $id)
    {
        $inputs = $request->validated();
        $event = Event::findOrFail($id); 

        $subscription_inputs = [
            'nome' => $inputs['nome'],
            'cognome' => $inputs['cognome'],
            'codice_fiscale' => $inputs['codice_fiscale'],
            'email' => $inputs['email'],
            'cellulare' => $inputs['cellulare'],
            'accompagnatori' => $request->input('accompagnatori', 0), 
            'user_id' => Auth::id(),
            'evento_id' => $event->id, 
        ];

        $subscription = Subscription::create($subscription_inputs);

        $num_accompagnatori = $request->input('accompagnatori', 0);

        if ($num_accompagnatori >= 1) {
            $guest_inputs_1 = [
                'nome' => $inputs['nome_accompagnatore_1'],
                'cognome' => $inputs['cognome_accompagnatore_1'],
                'codice_fiscale' => $inputs['cf_accompagnatore_1'],
                'email' => $inputs['email_accompagnatore_1'],
                'subscription_id' => $subscription->id, 
            ];
            Guest::create($guest_inputs_1);
        }

        if ($num_accompagnatori == 2) {
            $guest_inputs_2 = [
                'nome' => $inputs['nome_accompagnatore_2'],
                'cognome' => $inputs['cognome_accompagnatore_2'],
                'codice_fiscale' => $inputs['cf_accompagnatore_2'],
                'email' => $inputs['email_accompagnatore_2'],
                'subscription_id' => $subscription->id, 
            ];
            Guest::create($guest_inputs_2);
        }

        return back()->with('success', 'Iscrizione all\'evento creata con successo');
    }
}
