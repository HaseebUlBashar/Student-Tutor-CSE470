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
        Schema::table('reports', function (Blueprint $table) {

            $table->foreignId('reporter_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('problem_id')
                ->nullable()
                ->constrained('problems')
                ->cascadeOnDelete();

            $table->foreignId('solution_id')
                ->nullable()
                ->constrained('solutions')
                ->cascadeOnDelete();

            $table->string('reason');

            $table->text('description');

            $table->string('status')
                ->default('pending');

            $table->text('admin_note')
                ->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {

            $table->dropForeign(['reporter_id']);
            $table->dropForeign(['problem_id']);
            $table->dropForeign(['solution_id']);

            $table->dropColumn([
                'reporter_id',
                'problem_id',
                'solution_id',
                'reason',
                'description',
                'status',
                'admin_note',
            ]);

        });
    }
};