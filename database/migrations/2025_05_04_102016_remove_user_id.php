<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('owners', function (Blueprint $table) {
            // First drop the foreign key constraint
            $table->dropForeign(['user_id']);

            // Then drop the column
            $table->dropColumn('user_id');
        });
    }

    public function down(): void
    {
        Schema::table('owners', function (Blueprint $table) {
            // Recreate the column and foreign key if you roll back
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
