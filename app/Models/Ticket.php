<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'price',
        'available_quantity',
    ];

    //uwazaj na to bo moze powodować bledy
    public function ticketUsers()
    {
        return $this->hasMany(TicketUser::class);
    }

}
