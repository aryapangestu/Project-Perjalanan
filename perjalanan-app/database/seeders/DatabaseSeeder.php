<?php

namespace Database\Seeders;

use App\Models\Driver;
use App\Models\Passenger;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Vehicle;
use Database\Seeders\TrainBuilder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder // memanggil fungsi Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Vehicle::factory(10)->create();
        // membuat data dummy sebanyak 10
        // for ($x = 0; $x < 10; $x++) {
        //     $temp = User::factory()->create();
        //     if ($temp->role == 1) {
        //         Passenger::create(['user_id' => $temp->id]);
        //     } else if ($temp->role == 2) {
        //         Driver::create(['user_id' => $temp->id, 'vehicle_id' => Vehicle::all(['id'])->random()['id']]);
        //     }
        // }

        // Builder pattern
        $train = new TrainBuilder(10);
        $train->addPassengers()->addDrivers();

        User::create([ //membuat detail isi table
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 0
        ]);
    }
}
