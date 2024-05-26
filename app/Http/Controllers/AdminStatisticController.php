<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketUser;

class AdminStatisticController extends Controller
{
    public function index()
    {
        // Pobierz wszystkie typy biletów wraz z sumą ilości zarezerwowanych biletów dla każdego typu
        $popularTickets = Ticket::select('type')
                                 ->selectRaw('SUM(ticket_user.quantity) as total_quantity')
                                 ->leftJoin('ticket_user', 'tickets.id', '=', 'ticket_user.ticket_id')
                                 ->groupBy('type')
                                 ->orderBy('type')
                                 ->get();

        return view('admin.statistic', compact('popularTickets'));
    }
}
