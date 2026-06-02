<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\GiftController;

Route::get('/', function () {
    return redirect()->route('events.index');
});

Route::middleware(['auth'])->group(function () {
    // Eventos
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

    // Invitados
    Route::post('/guests', [GuestController::class, 'store'])->name('guests.store');
    Route::patch('/guests/{guest}/status', [GuestController::class, 'updateStatus'])->name('guests.updateStatus');
    Route::patch('/guests/{guest}/gift', [GuestController::class, 'chooseGift'])->name('guests.chooseGift');

    // Regalos
    Route::post('/gifts', [GiftController::class, 'store'])->name('gifts.store');
});

require __DIR__.'/auth.php';