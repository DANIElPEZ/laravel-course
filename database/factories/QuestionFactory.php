<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title'=>fake()->sentence(), //fake is used to generate fake data
            'description'=>fake()->paragraph(),
        ];
    }
}
