<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $categories = Category::factory(10)->create();
        $authors = Author::factory(10)->create();
        
        
        $books = Book::factory(100)->create();
        
        foreach ($books as $book) {
            $randomCategories = $categories->random(rand(1, 3));
            $book->categories()->attach($randomCategories);
            
            $randomAuthors = $authors->random(rand(1, 2));
            $book->authors()->attach($randomAuthors);
        }

    }
}
