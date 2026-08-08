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
        Schema::create('solutions', function (Blueprint $table) {
    $table->id();

    $table->foreignId('problem_id')
        ->constrained('problems')
        ->cascadeOnDelete();

    $table->foreignId('student_tutor_id')
        ->constrained('users')
        ->cascadeOnDelete();

    $table->text('description')->nullable();

    $table->string('attachment')->nullable();

    $table->decimal('reward', 10, 2)->nullable();

    $table->enum('status', [
        'draft',
        'submitted',
        'accepted',
        'rejected'
    ])->default('draft');

    $table->timestamp('submitted_at')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solutions');
    }
};
