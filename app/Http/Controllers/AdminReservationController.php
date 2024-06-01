<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;

class AdminReservationController extends Controller
{
    public function index()
    {
        $users = User::all();
        $reservations = Reservation::with('user')->get();
        return view('admin.reservationCRUD', compact('reservations', 'users'));
    }

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

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('admin.reservations')->with('success', 'Reservation deleted successfully.');
    }
}
