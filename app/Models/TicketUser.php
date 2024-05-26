<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketUser extends Model
{
    use HasFactory;

    protected $table = 'ticket_user';

    protected $fillable = [
        'reservation_id',
        'ticket_id',
        'quantity',
    ];

    //UGA BUGA
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
