<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    public function index()
    {
        $tickets = Ticket::all();
        return view('admin.ticketCRUD', compact('tickets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'price' => 'required|numeric|min:0',
            'available_quantity' => 'required|integer|min:0',
        ]);

        Ticket::create($request->all());

        return redirect()->route('admin.tickets')->with('success', 'Ticket created successfully.');
    }

    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'type' => 'required',
            'price' => 'required|numeric|min:0',
            'available_quantity' => 'required|integer|min:0',
        ]);

        $ticket->update($request->all());

        return redirect()->route('admin.tickets')->with('success', 'Ticket updated successfully.');
    }

    public function destroy(Ticket $ticket)
    {
        try
        {
            $ticket ->delete();
            return redirect()->route('admin.tickets')->with('success', 'Ticket deleted successfully.');

        }
        catch(\Illuminate\Database\QueryException $e)
        {
            if($e->getCode() === '23000')
            {
                return redirect()->route('admin.tickets')->with('error', 'You cannot delete a ticket associated with an existing registration');
            }
            else
            {
                return redirect()->route('admin.tickets')->with('error', 'An unexpected error occurred.');

            }
        }
    }
}
