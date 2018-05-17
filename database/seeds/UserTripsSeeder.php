<?php

use Illuminate\Database\Seeder;

class UserTripsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\TripUser::class, 250)->create();
    }
}
