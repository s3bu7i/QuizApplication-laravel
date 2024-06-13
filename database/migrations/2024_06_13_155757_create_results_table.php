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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        // database/migrations/xxxx_xx_xx_create_users_table.php
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        // database/migrations/xxxx_xx_xx_create_quizzes_table.php
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('duration'); // duration in minutes
            $table->timestamps();
        });

        // database/migrations/xxxx_xx_xx_create_questions_table.php
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained();
            $table->text('question_text');
            $table->enum('type', ['multiple_choice', 'true_false', 'short_answer']);
            $table->timestamps();
        });

        // database/migrations/xxxx_xx_xx_create_answers_table.php
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained();
            $table->text('answer_text');
            $table->boolean('is_correct')->default(false);
            $table->timestamps();
        });
        // database/migrations/xxxx_xx_xx_create_results_table.php
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('quiz_id')->constrained();
            $table->integer('score');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};