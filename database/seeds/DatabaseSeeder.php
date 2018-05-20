<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            CitySeeder::class,
            RolesAndPermissionsSeeder::class,
            TripSeeder::class,
            TripDaySeeder::class,
            UserTripsSeeder::class,
            HotelSeeder::class,
            CommentSeeder::class
        ]);
    }
}
