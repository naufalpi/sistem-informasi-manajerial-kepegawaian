<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'jabatan_id' => mt_rand(1,11),
            'pendidikan_id' => mt_rand(1,11),
            'name' => fake()->name(),
            'username' => fake()->unique()->userName(),
            'nrp' => fake()->unique()->randomNumber(9, true),
            'tpt_lahir' => fake()->city(),
            'tgl_lahir' => fake()->date(),
            'alamat' => fake()->streetAddress(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('12345'), // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
