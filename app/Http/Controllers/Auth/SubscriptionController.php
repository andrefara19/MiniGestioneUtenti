<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\SubscriptionRequest;
use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\Event;
use App\Models\Guest;
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
        $inputs = $request->all();
        $event = Event::findOrFail($id); 

        $subscription_inputs = [
            'nome' => $inputs['nome'],
            'cognome' => $inputs['cognome'],
            'codice_fiscale' => $inputs['codice_fiscale'],
            'email' => $inputs['email'],
            'cellulare' => $inputs['cellulare'],
            'accompagnatori' => $inputs['accompagnatori'] ?? 0, 
            'user_id' => Auth::id(),
            'evento_id' => $event->id, 
        ];
           
        $subscription = Subscription::create($subscription_inputs);
        
        $num_accompagnatori = intval($request->input('accompagnatori'));
        $guest_inputs= [];

        if ($num_accompagnatori > 0) {
            for ($i = 1; $i <= $num_accompagnatori; $i++) {
                $guest_inputs[] = [
                    'nome' => $inputs["nome_accompagnatore_$i"],
                    'cognome' => $inputs["cognome_accompagnatore_$i"],
                    'codice_fiscale' => $inputs["cf_accompagnatore_$i"],
                    'email' => $inputs["email_accompagnatore_$i"],
                    'subscription_id' => $subscription->id, 
                ];
            }
            Guest::insert($guest_inputs);         
        }

         return back()->with('success', 'Iscrizione all\'evento creata con successo');
    }
}
