<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DonationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $email = $this->faker->email();

        return [
            'name'      => $this->faker->name(),
            'email'     => $email,
            'donation'  => $this->faker->randomFloat(2, 1, 10000),
            'message'   => $this->faker->optional()->text(),
            'image_url' => 'https://www.gravatar.com/avatar/' . $this->faker->md5(strtolower($email)) . '.jpg?s=200&d=mm'
        ];
    }
}
