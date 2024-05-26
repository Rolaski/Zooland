<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TicketUser;


class TicketUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TicketUser::create([
            'reservation_id' => 1,
            'ticket_id' => 1,
            'quantity' => 2,
        ]);

        TicketUser::create([
            'reservation_id' => 1,
            'ticket_id' => 2,
            'quantity' => 3
        ]);

        TicketUser::create([
            'reservation_id' => 2,
            'ticket_id' => 2,
            'quantity' => 3,
        ]);
    }
}
