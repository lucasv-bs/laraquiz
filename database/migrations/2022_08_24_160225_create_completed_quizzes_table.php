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
        Schema::create('completed_quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id');
            $table->foreign('quiz_id')->references('id')->on('quizzes');
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->smallInteger('total_questions')->unsigned();
            $table->smallInteger('result')->unsigned()->comment('Number of hits');
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
        Schema::dropIfExists('completed_quizzes');
    }
};
