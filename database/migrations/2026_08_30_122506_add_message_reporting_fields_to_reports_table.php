<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reports', function (Blueprint $table) {

            $table->foreignId('conversation_id')
                ->nullable()
                ->constrained('conversations')
                ->nullOnDelete()
                ->after('reported_user_id');

            $table->foreignId('message_id')
                ->nullable()
                ->constrained('messages')
                ->nullOnDelete()
                ->after('conversation_id');

        });
    }

    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {

            $table->dropForeign(['conversation_id']);
            $table->dropForeign(['message_id']);

            $table->dropColumn([
                'conversation_id',
                'message_id',
            ]);

        });
    }
};