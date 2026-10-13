<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->foreignId('feature_id')
                ->nullable()
                ->after('id')
                ->constrained('features')
                ->restrictOnDelete();

            $table->string('display_name')
                ->after('name');
        });
    }

    public function down(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropForeign(['feature_id']);
            $table->dropColumn(['feature_id', 'display_name']);
        });
    }
};