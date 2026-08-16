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
            $table->string('reported_content_type')->nullable();
            $table->string('reported_content_title')->nullable();
            $table->text('reported_content_description')->nullable();
            $table->string('reported_content_attachment')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn([
                'reported_content_type',
                'reported_content_title',
                'reported_content_description',
                'reported_content_attachment',
            ]);
        });
    }
};
