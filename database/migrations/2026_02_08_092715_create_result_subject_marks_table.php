<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('result_subject_marks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('result_id')->constrained('results')->cascadeOnDelete();

            $table->string('subject');
            $table->integer('marks')->default(0);
            $table->integer('max_marks')->default(100);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('result_subject_marks');
    }
};
