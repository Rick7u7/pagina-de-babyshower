<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with(['guests.gift', 'gifts'])->get();
        return view('events.index', compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'guests' => 'required|array|min:1',
            'guests.*.name' => 'required|string|max:255',
            'gifts' => 'required|array|min:1',
            'gifts.*.name' => 'required|string|max:255',
        ]);

        $event = Event::create([
            'name' => $request->name,
            'date' => $request->date,
            'location' => $request->location,
            'description' => $request->description,
            'user_id' => auth()->id(),
        ]);

        foreach ($request->guests as $guestData) {
            $event->guests()->create([
                'name' => $guestData['name'],
                'email' => $guestData['email'] ?? null,
                'status' => 'declined',
            ]);
        }

        foreach ($request->gifts as $giftData) {
            $event->gifts()->create([
                'name' => $giftData['name'],
                'reserved' => false,
            ]);
        }

        return redirect()->route('events.index')->with('success', 'Evento creado correctamente.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Evento eliminado.');
    }
}
