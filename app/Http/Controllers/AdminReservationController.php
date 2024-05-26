<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;

class AdminReservationController extends Controller
{
    /**
     * Display a listing of the reservations.
     */
    public function index()
    {
        $users = User::all(); // Pobierz wszystkich użytkowników
        $reservations = Reservation::with('user')->get();
        return view('admin.reservationCRUD', compact('reservations', 'users'));
    }

    /**
     * Show the form for creating a new reservation.
     */
    public function create()
    {
        $users = User::all();
        return view('admin.reservations.create', compact('users'));
    }

    /**
     * Store a newly created reservation in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'guest_name' => 'string|max:255',
            'guest_surname' => 'string|max:255',
            'guest_email' => 'email|max:255',
            'reservation_date' => 'required|date',
        ]);


        Reservation::create($request->all());

        return redirect()->route('admin.reservations')->with('success', 'Reservation added successfully.');
    }

    /**
     * Show the form for editing the specified reservation.
     */
    public function edit(Reservation $reservation)
    {
        $users = User::all();
        return view('admin.reservations.edit', compact('reservation', 'users'));
    }

    /**
     * Update the specified reservation in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'guest_name' => 'required|string|max:255',
            'guest_surname' => 'required|string|max:255',
            'guest_email' => 'required|email|max:255',
            'reservation_date' => 'required|date',
        ]);

        $reservation->update($request->all());

        return redirect()->route('admin.reservations')->with('success', 'Reservation updated successfully.');
    }

    /**
     * Remove the specified reservation from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('admin.reservations')->with('success', 'Reservation deleted successfully.');
    }
}
