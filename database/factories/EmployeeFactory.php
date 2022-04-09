<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Reference;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $statusIds = Reference::where('code', 'employee_status')->pluck('id')->toArray();

        return [
            'status_id' => $this->faker->randomElement($statusIds),
            'name' => $this->faker->unique()->name,
            'salary' => $this->faker->numberBetween(2000000, 10000000),
        ];
    }
}
