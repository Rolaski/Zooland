<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserReservationController extends Controller
{
    public function index()
    {
        // Pobieramy bilety z bazy danych
        $tickets = Ticket::all();

        // Zwracamy widok rezerwacji użytkownika wraz z przekazanymi danymi
        return view('reservation.user', compact('tickets'));
    }

    public function userReservations()
    {
               // Pobierz zalogowanego użytkownika
               $user = Auth::user();

               // Sprawdź, czy użytkownik jest zalogowany
               if ($user) {
                   // Pobierz rezerwacje dla użytkownika
                   $userReservations = $user->reservations;

                   // Zwróć widok z przekazanymi danymi
                   return view('reservation.user_show', compact('userReservations'));
               } else {
                   // Przekieruj użytkownika na stronę logowania lub inny widok
                   return redirect()->route('login');
               }

    // Zwróć widok z przekazanymi danymi
    return view('reservation.user_show', compact('userReservations'));
    }

    public function reserve(Request $request)
    {
        // Walidacja danych formularza
        $request->validate([
            'visit-date' => 'required|date',
            'quantity' => 'required|array',
            'quantity.*' => 'integer|min:0',
        ]);

        // Tworzenie nowej rezerwacji
        $reservation = new Reservation();
        $reservation->user_id = Auth::id(); // ID zalogowanego użytkownika
        $reservation->reservation_date = $request->input('visit-date');
        $reservation->save();

        // Dodawanie biletów do rezerwacji
        foreach ($request->input('quantity') as $ticketId => $quantity) {
            if ($quantity > 0) {
                // Zapisuje do tabeli łączącej 'ticket_user'
                DB::table('ticket_user')->insert([
                    'reservation_id' => $reservation->id,
                    'ticket_id' => $ticketId,
                    'quantity' => $quantity,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

        // Przekierowanie po udanej rezerwacji
        return redirect()->route('user-reservation')->with('status', 'Reservation successful!');
    }

}
