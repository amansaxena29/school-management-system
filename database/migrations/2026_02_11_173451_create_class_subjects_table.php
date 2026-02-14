<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('class_subjects', function (Blueprint $table) {
            $table->id();
            $table->string('class'); // "1".."12"
            $table->string('exam_type'); // "Half Yearly" or "Annual"
            $table->string('subject');
            $table->integer('max_marks')->default(100);
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['class', 'exam_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('class_subjects');
    }
};
