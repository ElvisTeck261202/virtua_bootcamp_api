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
        Schema::table('comments', function(Blueprint $table) {
            $table->uuid('commented_by_uuid')->nullable();

            $table->foreign('commented_by_uuid')->references('uuid')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function(Blueprint $table) {
            $table->dropForeign(['commented_by_uuid']);
            $table->dropColumn('commented_by_uuid');
        });
    }
};
