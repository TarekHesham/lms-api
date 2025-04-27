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
        Schema::create('quiz_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('quiz_id')->constrained('quizes')->cascadeOnDelete();

            $table->unsignedSmallInteger('score')->nullable();
            $table->unsignedSmallInteger('total_points')->nullable();
            $table->decimal('percentage',5,2)->nullable();
            $table->unsignedInteger('rank')->nullable();

            $table->unsignedTinyInteger('attempt_number');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();

            $table->unique(['student_id','quiz_id','attempt_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizze_submissions');
    }
};
