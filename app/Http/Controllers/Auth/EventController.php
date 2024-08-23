<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\EventRequest;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function allEvents()
    {
        $user = Auth::user();
        $isadmin = $user->is_admin;
        $events = Event::orderBy('data_inizio', 'asc')->get();

        return view('events.index', compact('events', 'isadmin'));
    }

    public function myEvents($user_id)
    {
        $events = Event::where('user_id', $user_id)
            ->orderBy('data_inizio', 'asc')
            ->get();

        return view('events.index', compact('events', 'user_id'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(EventRequest $request)
    {
        $inputs = $request->validated();
        $inputs['gratuito'] = $request->has('gratuito') ? 1 : 0;
        $inputs['user_id'] = Auth::id();

        Event::create($inputs);

        return redirect()->route('event.index')->with('message', 'Event created successfully.');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);

        return view('events.update', compact('event'));
    }

    public function update(EventRequest $request, $id)
    {
        $event = Event::findOrFail($id);
        $inputs = $request->validated();
        $inputs['gratuito'] = $request->has('gratuito') ? 1 : 0;
        $inputs['user_id'] = Auth::id();

        $event->update($inputs);

        if ($event->update($inputs)) {
            return redirect()->route('event.index')->with('message', 'Successfully updated');
        } else {
            return back()->with('error', 'Failed to update');
        }
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        if ($event->delete()) {
            return redirect()->route('event.index')->with('message', 'Successfully deleted');
        } else {
            return back()->with('error', 'Failed to delete');
        }
    }
}
