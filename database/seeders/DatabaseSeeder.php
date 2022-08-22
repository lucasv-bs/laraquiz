<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create a admin user
        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@teste.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$dYUI.e/YIt8rH.U/BixD1OOW9bpvglJGEfmFbNNTmfifDID1XCJUm', // admin
            'remember_token' => Str::random(10),
        ]);

        // Create other users
        \App\Models\User::factory(5)->create();

        // Create a specific Quiz with five questions
        $quiz = \App\Models\Quiz::factory()->create([
            'title' => 'Marvel Fans',
            'slug' => 'marvel-fans'
        ]);
        for ($i = 1; $i <= 5; $i++) {
            $question = \App\Models\Question::factory()->make();
            $question->quiz_id = $quiz->id;
            $question->question_number = $i;
            $question->save();

            for ($j = 1; $j <= 5; $j++) {
                $answer = \App\Models\Answer::factory()->make();
                $answer->question_id = $question->id;
                $answer->answer_number = $j;
                $answer->save();
            }
        }

        // Runs additional seeders
        $this->call([
            QuizSeeder::class
        ]);
    }
}
