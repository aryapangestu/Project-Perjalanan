<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Passenger>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        if ($this->faker->boolean() == 0) {
            $temp = 'Mobil';
        } else {
            $temp = 'Motor';
        }
        return [
            'model' => $this->faker->name,
            'plat' => $this->faker->unique()->bothify('?? #### ??'),
            'vehicle_type' => $temp
        ];
    }
}
