<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        \Log::debug("Hello from clients.index");
        return View("clients.index",[
            'bookings'=>Booking::all()
                        ->whereNull('client_id')
                        ->where('booking_time','>=',now())
                        ->sortBy('booking_time'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $booking->client()->associate($request->user());
        $booking->update();

        return redirect(route('clients.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
