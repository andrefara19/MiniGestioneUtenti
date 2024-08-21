<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\EventRequest;
use App\Http\Controllers\Controller;
use App\Models\Event;

class HomeController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('data_inizio', 'asc')->get();

        return view('events.index', compact('events'));
    }

    public function create(EventRequest $request)
    {
        Event::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Registrazione avvenuta con successo!',
        ], 201);
    }
}