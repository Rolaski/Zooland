<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Reservation;
use App\Models\TicketUser;

class GuestReservationController extends Controller
{
    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reservation_date' => 'required|date',
            'quantity' => 'required|array',
            'quantity.*' => 'required|integer|min:0',
            'guest_name' => 'required|string|max:255',
            'guest_surname' => 'required|string|max:255',
            'guest_email' => 'required|email|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('home', '#section3')->withErrors($validator)->withInput();
        }

        $visitDate = $request->input('reservation_date');
        $quantities = $request->input('quantity');
        $firstName = $request->input('guest_name');
        $lastName = $request->input('guest_surname');
        $email = $request->input('guest_email');

        $reservation = new Reservation();
        $reservation->guest_name = $firstName;
        $reservation->guest_surname = $lastName;
        $reservation->guest_email = $email;
        $reservation->reservation_date = $visitDate;
        $reservation->save();

        foreach ($quantities as $ticketId => $quantity) {
            if ($quantity > 0) {
                TicketUser::create([
                    'reservation_id' => $reservation->id,
                    'ticket_id' => $ticketId,
                    'quantity' => $quantity,
                ]);
            }
        }

        return redirect()->route('home', '#section3')->with('status', 'Reservation successfully made!');
    }
}
