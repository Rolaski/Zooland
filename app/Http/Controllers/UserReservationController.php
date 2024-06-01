<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserReservationController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();
        return view('reservation.user', compact('tickets'));
    }

    public function userReservations()
    {
        $user = Auth::user();
        if ($user) {
            $userReservations = $user->reservations;
            return view('reservation.user_show', compact('userReservations'));
        } else {
            return redirect()->route('login');
        }
    }

    public function reserve(Request $request)
    {
        $quantities = $request->input('quantity');
        $allZero = true;
        foreach ($quantities as $quantity)
        {
            if ($quantity > 0)
            {
                $allZero = false;
                break;
            }
        }
        if ($allZero) {
            return redirect()->back()->withErrors(['quantity' => 'You need to choose a ticket']);
        }

        $request->validate([
            'visit-date' => 'required|date',
            'quantity' => 'required|array',
            'quantity.*' => 'integer|min:0',
        ]);

        $reservation = new Reservation();
        $reservation->user_id = Auth::id();
        $reservation->reservation_date = $request->input('visit-date');
        $reservation->save();

        foreach ($request->input('quantity') as $ticketId => $quantity) {
            if ($quantity > 0) {
                DB::table('ticket_user')->insert([
                    'reservation_id' => $reservation->id,
                    'ticket_id' => $ticketId,
                    'quantity' => $quantity,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

        return redirect()->route('user-reservation')->with('status', 'Reservation successful!');
    }

    public function destroy($id)
    {
        $reservation = Reservation::find($id);
        if (!$reservation || $reservation->user_id != Auth::id()) {
            return redirect()->route('user.reservations')->withErrors('Reservation not found or you do not have permission to delete it.');
        }

        $today = Carbon::now();
        $reservationDate = Carbon::parse($reservation->reservation_date);
        $daysUntilReservation = $today->diffInDays($reservationDate, false);

        if ($daysUntilReservation < 0) {
            return redirect()->route('user.reservations')->withErrors('You cannot delete past reservations.');
        }

        if ($daysUntilReservation < 7) {
            return redirect()->route('user.reservations')->withErrors('You cannot delete reservations within 7 days of the reservation date.');
        }

        $reservation->delete();
        return redirect()->route('user.reservations')->with('status', 'Reservation deleted successfully.');
    }
}
