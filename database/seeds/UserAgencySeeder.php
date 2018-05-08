<?php

use Illuminate\Database\Seeder;

class UserAgencySeeder extends Seeder
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
        $agencies = App\Models\Agency::all();

        // Populate the pivot table
        App\Models\User::all()->each(function ($user) use ($agencies) { 
            $user->agencies()->attach(
                $agencies->random(rand(1, 3))->pluck('id')->toArray()
            ); 
        });
    }
}
