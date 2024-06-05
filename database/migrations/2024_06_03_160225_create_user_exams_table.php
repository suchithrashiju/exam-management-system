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
        Schema::create('user_exams', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('exam_id');
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->string('exam_duration')->nullable();
            $table->json('content')->nullable();
            $table->integer('score');
            $table->enum('status', ['pass', 'fail']);
            $table->timestamps();
            $table->softDeletes();

            $table->primary(['user_id', 'exam_id']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('exam_id')->references('id')->on('exams');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_exams');
    }
};
