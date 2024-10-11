<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{

    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'is_admin' => false,
            'phone_number' => ($this->faker->unique()->phoneNumber),
            'email' => ($this->faker->unique()->safeEmail),
            'avatar' => null,
            'password' => bcrypt('password')
        ];
    }
}
