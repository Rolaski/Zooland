<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the tickets.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::all();
        return view('admin.ticketCRUD', compact('tickets'));
    }

    /**
     * Show the form for creating a new ticket.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created ticket in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for editing the specified ticket.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        return view('admin.edit', compact('ticket'));
    }

    /**
     * Update the specified ticket in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified ticket from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
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
