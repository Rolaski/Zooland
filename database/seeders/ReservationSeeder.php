<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reservation;


class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reservation::create([
            'user_id' => 1,
            'reservation_date' => now(),
        ]);

        Reservation::create([
            'guest_name' => 'Mateusz',
            'guest_surname' => 'Kowalski',
            'guest_email' => 'Mateusz@gmail.com',
            'reservation_date' => now(),
        ]);
    }
}
