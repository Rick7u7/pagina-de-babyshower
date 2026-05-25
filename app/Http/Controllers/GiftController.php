<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use Illuminate\Http\Request;

class GiftController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'name' => 'required|string|max:255',
        ]);

        Gift::create([
            'event_id' => $request->event_id,
            'name' => $request->name,
            'reserved' => false,
        ]);

        return back()->with('success', 'Regalo agregado correctamente.');
    }
}
