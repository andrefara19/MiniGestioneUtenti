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

    public function store(SubscriptionRequest $request)
    {
        $inputs = $request->all();

        $subscription_inputs = [
            'nome' => $inputs['nome'],
            'cognome' => $inputs['cognome'],
            'codice_fiscale' => $inputs['codice_fiscale'],
            'email' => $inputs['email'],
            'cellulare' => $inputs['cellulare'],
            'accompagnatori' => $inputs['num_accompagnatori'] ?? 0,
            'user_id' => Auth::id(),
            'evento_id' => $inputs['id_event'],
        ];

        $subscription = Subscription::create($subscription_inputs);

        $accompagnatori = $request->input('accompagnatori');
        $guest_inputs = [];

        if (count($accompagnatori) > 0) {
            foreach ($accompagnatori as $val) {
                $guest_inputs[] = [
                    'nome' => $val["nome_accompagnatore"],
                    'cognome' => $val["cognome_accompagnatore"],
                    'codice_fiscale' => $val["cf_accompagnatore"],
                    'email' => $val["email_accompagnatore"],
                    'subscription_id' => $subscription->id,
                ];
            }
            Guest::insert($guest_inputs);
        }

        return response()->json(['success' => true, 'message' => "Iscrizione all'evento creata con successo"]);
    }
}
