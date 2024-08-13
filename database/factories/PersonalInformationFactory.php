<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PersonalInformation>
 */
class PersonalInformationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'phone_number' => fake()->phoneNumber(),
            'date_of_birth' => $this->faker->date(),
            'contact_address' => $this->faker->address(),
            'country_of_residence' => $this->faker->country(),
            'citizenship_country' => $this->faker->country(),
            'identity_document_path' => $this->faker->filePath(),
            'phone_verified_at' => now(),
        ];
    }
}
