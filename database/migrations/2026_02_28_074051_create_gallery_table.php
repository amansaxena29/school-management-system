<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('gallery', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');   // file path or URL
            $table->string('caption')->nullable();
            $table->boolean('is_url')->default(false); // true = URL, false = uploaded file
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('gallery');
    }
};
