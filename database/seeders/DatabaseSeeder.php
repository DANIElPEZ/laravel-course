<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Question;
use App\Models\Answer;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(19)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'i@test.com',
        ]);

        $categories=Category::factory(4)->create();

        $questions=Question::factory(30)->create([ //factory is used to create false data
            'category_id'=> fn() => $categories->random()->id, //fn is used to set random seeding
            'user_id'=>fn()=> User::inRandomOrder()->first()->id //fill user_id with random user id from users table
        ]);

        $answers=Answer::factory(50)->create([
            'question_id'=> fn() => $questions->random()->id, //fn is used to set random seeding
            'user_id'=>fn()=> User::inRandomOrder()->first()->id
        ]);

        Comment::factory(100)->create([
            'user_id'=>fn()=> User::inRandomOrder()->first()->id,
            'commentable_id'=> fn()=> $answers->random()->id,
            'commentable_type'=>fn()=> Answer::class
        ]);

        Comment::factory(100)->create([
            'user_id'=>fn()=> User::inRandomOrder()->first()->id,
            'commentable_id'=> fn()=> $questions->random()->id,
            'commentable_type'=>fn()=> Question::class
        ]);
    }
}
