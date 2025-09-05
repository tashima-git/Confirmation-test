<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        return [
            'last_name'   => $this->faker->lastName(),
            'first_name'  => $this->faker->firstName(),
            'gender'      => $this->faker->numberBetween(1, 3),
            'email'       => $this->faker->unique()->safeEmail(),
            'tel1'        => $this->faker->numberBetween(70, 90),
            'tel2'        => $this->faker->numberBetween(1000, 9999),
            'tel3'        => $this->faker->numberBetween(1000, 9999),
            'address'     => $this->faker->address(),
            'building'    => $this->faker->optional()->streetName(),
            'category_id' => $this->faker->numberBetween(1, 5),
            'detail'      => $this->faker->text(50),
            'created_at'  => now(),
            'updated_at'  => now(),
        ];
    }
}
