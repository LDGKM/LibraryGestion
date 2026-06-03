<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Book;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model=Book::class;
    public function definition(): array
    {
        $nb_exemp=fake()->numberBetween(1, 100);
        return [
            'titre'=>fake()->sentence(),
            'description'=>fake()->paragraph(3) ,
            'annee_de_publication'=>fake()->year(),
            'isbn'=>fake()->isbn13(),
            'nb_exemp_dispo'=>$nb_exemp,
            'nb_exemp_total'=>$nb_exemp,
            'price' => fake()->randomFloat(2, 1, 200000),
            'image'=>fake()->url()
        ];
    }
}
