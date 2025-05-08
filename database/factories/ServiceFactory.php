<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => $this->faker->randomElement([
                'Repair',
                'Painting',
                'Shifting',
                'Plumbing',
                'Electric',
                'Cleaning',
            ]),
            'description' => $this->faker->text(),

        ];
    }
}
