<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selected_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('completed_quiz_id');
            $table->foreign('completed_quiz_id')->references('id')->on('completed_quizzes');
            $table->foreignId('question_id');
            $table->foreign('question_id')->references('id')->on('questions');
            $table->foreignId('answer_id');
            $table->foreign('answer_id')->references('id')->on('answers');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('selected_answers');
    }
};
