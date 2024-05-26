<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Reservation;
use App\Models\TicketUser;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class UserTicketController extends Controller
{
    public function index()
    {
        $user_tickets = TicketUser::with('ticket')->get();
        $tickets = Ticket::all();
        return view('admin.tickets_userCRUD', compact('user_tickets', 'tickets'));
    }

    public function store(Request $request)
    {
        // Walidacja danych
        $request->validate([
            'reservation_id' => 'required|numeric',
            'ticket_id' => 'required|numeric',
            'quantity' => 'required|numeric|min:1',
        ]);

        // Sprawdzenie, czy istnieje rezerwacja o podanym ID
        $reservationExists = Reservation::where('id', $request->reservation_id)->exists();

        if (!$reservationExists) {
            throw ValidationException::withMessages([
                'reservation_id' => 'Reservation ID not found.',
            ]);
        }

        // Utwórz nowy bilet użytkownika
        TicketUser::create([
            'reservation_id' => $request->reservation_id,
            'ticket_id' => $request->ticket_id,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('admin.user_tickets.index')->with('success', 'User ticket added successfully!');
    }

    public function update(Request $request, $id)
    {
        // Walidacja danych
        $request->validate([
            'ticket_id' => 'required|numeric',
            'quantity' => 'required|numeric|min:1',
        ]);


        // Znajdź i zaktualizuj bilet użytkownika
        $user_ticket = TicketUser::findOrFail($id);
        $user_ticket->update([
            'ticket_id' => $request->ticket_id,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('admin.user_tickets.index')->with('success', 'User ticket updated successfully!');
    }

    public function destroy($id)
{
    // Znajdź i usuń bilet użytkownika
    $user_ticket = TicketUser::findOrFail($id);
    $user_ticket->delete();

    // Sprawdź, czy dla rezerwacji nie ma już żadnych biletów
    $reservation_id = $user_ticket->reservation_id;
    $tickets_count = TicketUser::where('reservation_id', $reservation_id)->count();

    if ($tickets_count === 0) {
        // Usuń rezerwację, jeśli nie ma już przypisanych do niej biletów
        // (zakładając, że masz model dla rezerwacji o nazwie Reservation)
        Reservation::where('id', $reservation_id)->delete();
    }

    return redirect()->route('admin.user_tickets.index')->with('success', 'User ticket deleted successfully!');
}

}
