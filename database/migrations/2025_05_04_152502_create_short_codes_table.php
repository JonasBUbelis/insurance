<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('short_codes', function (Blueprint $table) {
            $table->id();
            $table->string('shortcode');
            $table->text('replace');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('short_codes');
    }
};
