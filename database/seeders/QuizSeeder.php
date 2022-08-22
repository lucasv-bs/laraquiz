<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a Quiz
        \App\Models\Quiz::factory(5)
            ->create()
            ->each(function ($quiz) {
                // Each quiz has 5 questions
                for ($i = 1; $i <= 5; $i++) {
                    $question = \App\Models\Question::factory()->make();
                    $question->quiz_id = $quiz->id;
                    $question->question_number = $i;
                    $question->save();

                    // Each question has 5 possible answers
                    for ($j = 1; $j <= 5; $j++) {
                        $answer = \App\Models\Answer::factory()->make();
                        $answer->question_id = $question->id;
                        $answer->answer_number = $j;
                        $answer->save();
                    }
                }
            });
    }
}
