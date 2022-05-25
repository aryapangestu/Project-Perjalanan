<?php

namespace Database\Seeders;

use App\Models\Driver;
use App\Models\Passenger;
use App\Models\User;
use App\Models\Vehicle;

class TrainBuilder
{
    private $temp;
    private $jum;

    public function __construct(int $jumlah)
    {
        $this->temp = User::factory($jumlah)->create();
        $this->jum = $jumlah;
    }

    public function addPassengers()
    {
        for ($x = 0; $x < $this->jum; $x++) {
            if ($this->temp[$x]->role == 1) {
                Passenger::create(['user_id' => $this->temp[$x]->id]);
            }
        }
        return $this;
    }

    public function addDrivers()
    {
        for ($x = 0; $x < $this->jum; $x++) {
            if ($this->temp[$x]->role == 2) {
                Driver::create(['user_id' => $this->temp[$x]->id, 'vehicle_id' => Vehicle::all(['id'])->random()['id']]);
            }
        }
        return $this;
    }
}
