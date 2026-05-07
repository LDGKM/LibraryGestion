<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Author;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model=Author::class;
    public function definition(): array
    {
        return [
            'first_name'=>fake()->firstName() ,
            'last_name'=>fake()->firstName() ,
            'bio'=>fake()->paragraph(3) ,
            'birth_date'=>fake()->date() ,
            'death_date'=>fake()->date(),
            'nationalite'=>fake()->country(),
            'photo_path'=>fake()->url() 
        ];
    }
}
