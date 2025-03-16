<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('reg_number')->unique();
            $table->string('brand');
            $table->string('model');
            $table->foreignId('owner_id')->constrained('owners')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('cars');
    }
};
