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

                    // Dates prohibited check
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

        $visitDate = $request->input('visit-date');
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
            return redirect()->route('home', '#section3')->withErrors(['quantity' => 'You need to choose a ticket']);
        }
        $tickets = Ticket::all();

        return view('reservation.submit', [
            'visitDate' => $visitDate,
            'quantities' => $quantities,
            'tickets' => $tickets
        ]);
    }
}
