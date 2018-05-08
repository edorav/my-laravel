<?php

use Illuminate\Database\Seeder;

class TripDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Models\TripDay::class, 50)->create();
    }
}
