<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ticket;


class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ticket::create([
            'type' => 'Standard',
            'price' => 45.00,
            'available_quantity' => 200,
        ]);

        Ticket::create([
            'type' => 'Discount',
            'price' => 29.99,
            'available_quantity' => 100,
        ]);

        Ticket::create([
            'type' => 'Senior',
            'price' => 35,
            'available_quantity' => 100,
        ]);

        Ticket::create([
            'type' => 'VIP',
            'price' => 99.99,
            'available_quantity' => 10,
        ]);

    }
}
