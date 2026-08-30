<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            // The completed/accepted solution this review belongs to
            $table->foreignId('solution_id')
                ->constrained('solutions')
                ->cascadeOnDelete();

            // The user who is writing the review
            $table->foreignId('reviewer_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // The user who is receiving the review
            $table->foreignId('reviewed_user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Rating from 1 to 5
            $table->unsignedTinyInteger('rating');

            // Optional written review
            $table->text('comment')->nullable();

            $table->timestamps();

            // A user can review the other person only once
            // for a particular accepted solution.
            $table->unique([
                'solution_id',
                'reviewer_id',
                'reviewed_user_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};