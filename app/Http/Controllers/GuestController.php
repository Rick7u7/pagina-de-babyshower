<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Gift;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function updateStatus(Request $request, Guest $guest)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,declined',
        ]);

        $guest->update(['status' => $request->status]);

        return back()->with('success', 'Estado del invitado actualizado.');
    }

    public function chooseGift(Request $request, Guest $guest)
    {
        $request->validate([
            'gift_id' => 'nullable|exists:gifts,id',
        ]);

        if ($guest->gift_id) {
            Gift::where('id', $guest->gift_id)->update(['reserved' => false]);
        }

        if ($request->gift_id) {
            $gift = Gift::find($request->gift_id);
            if ($gift->reserved && $gift->id != $guest->gift_id) {
                return back()->with('error', 'Ese regalo ya fue elegido.');
            }
            $gift->update(['reserved' => true]);
            $guest->update(['gift_id' => $gift->id]);
        } else {
            $guest->update(['gift_id' => null]);
        }

        return back()->with('success', 'Regalo asignado correctamente.');
    }
}
