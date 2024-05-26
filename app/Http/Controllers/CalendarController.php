<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Ticket;



class CalendarController extends Controller
{
    public function reserve(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'visit-date' => [
                'required',
                function ($attribute, $value, $fail) {
                    $invalidDates = ['01-01', '11-01', '12-24', '12-25'];

                    // Sprawdź, czy wybrana data znajduje się wśród niedozwolonych
                    $selectedDate = date('m-d', strtotime($value));
                    if (in_array($selectedDate, $invalidDates)) {
                        $fail('The selected date is invalid!');
                    }
                },
            ],
            'quantity' => 'required|array',
            'quantity.*' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->route('home', '#section3')->withErrors($validator)->withInput();
        }

        // Pobierz datę wizyty i ilości biletów
        $visitDate = $request->input('visit-date');
        $quantities = $request->input('quantity');
        $tickets = Ticket::all();

        // Przekaż dane do widoku reservation.submit
        return view('reservation.submit', [
            'visitDate' => $visitDate,
            'quantities' => $quantities,
            'tickets' => $tickets
        ]);
    }
}
