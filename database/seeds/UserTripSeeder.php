<?php

use Illuminate\Database\Seeder;

class UserTripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         // Get all the roles attaching up to 3 random roles to each user
        $trips = App\Models\Trip::all();
        
        // Populate the pivot table
        App\Models\User::all()->each(function ($user) use ($trips) { 
            $user->trips()->attach(
                $trips->random(rand(1, 3))->pluck('id')->toArray()
            ); 
        });
    }
}
