<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_warnings', function (Blueprint $table) {
            $table->id();

            // The user receiving the warning
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // The admin who issued the warning
            $table->foreignId('admin_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // The report that led to this warning
            $table->foreignId('report_id')
                ->constrained('reports')
                ->cascadeOnDelete();

            // Admin's explanation/reason for the warning
            $table->text('reason');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_warnings');
    }
};