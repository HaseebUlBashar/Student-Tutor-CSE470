<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reports', function (Blueprint $table) {

            $table->dropForeign(['problem_id']);
            $table->dropForeign(['solution_id']);

            $table->foreign('problem_id')
                ->references('id')
                ->on('problems')
                ->nullOnDelete();

            $table->foreign('solution_id')
                ->references('id')
                ->on('solutions')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {

            $table->dropForeign(['problem_id']);
            $table->dropForeign(['solution_id']);

            $table->foreign('problem_id')
                ->references('id')
                ->on('problems')
                ->cascadeOnDelete();

            $table->foreign('solution_id')
                ->references('id')
                ->on('solutions')
                ->cascadeOnDelete();
        });
    }
};