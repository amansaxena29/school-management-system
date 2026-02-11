<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('marksheet_extras', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student_id');
            $table->string('session')->default('2025-2026');   // change as needed
            $table->string('class')->nullable();               // "12", "11", etc

            $table->string('attendance')->nullable();          // e.g. "210/240" or "-"
            $table->string('promoted_to_class')->nullable();   // e.g. "13" or "-"
            $table->text('class_teacher_remarks')->nullable(); // remarks

            $table->string('discipline_term1')->nullable();
            $table->string('discipline_term2')->nullable();

            $table->timestamps();

            $table->unique(['student_id', 'session', 'class'], 'uniq_student_session_class');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('marksheet_extras');
    }
};
