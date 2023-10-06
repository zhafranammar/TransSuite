<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\Vehicle;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    public function definition()
    {
        $vehicleIds = Vehicle::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();

        return [
            'vehicle_id' => $this->faker->randomElement($vehicleIds),
            'user_approval1_id' => 2,
            'user_approval2_id' => 3,
            'driver_id' => $this->faker->randomElement($userIds),
            'start_date' => $this->faker->dateTimeBetween('-10 month', '+5 month'),
            'end_date' => $this->faker->dateTimeBetween('+5 month', '+10 months'),
            'status' => $this->faker->randomElement([
                'pending',
                'approved_by_supervisor',
                'approved',
                'rejected',
                'completed'
            ]),
            'message' => $this->faker->sentence,
        ];
    }
}
