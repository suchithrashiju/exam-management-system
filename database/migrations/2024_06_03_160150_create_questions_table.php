<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_id');
            $table->text('question_text');
            $table->string('choice1');
            $table->string('choice2');
            $table->string('choice3');
            $table->string('choice4');
            $table->enum('correct_choice', ['choice1', 'choice2', 'choice3', 'choice4']);
            $table->integer('mark')->default(1);
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('exam_id')->references('id')->on('exams');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
