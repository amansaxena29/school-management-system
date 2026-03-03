<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop if somehow still exists, then recreate clean
        Schema::dropIfExists('fees');

        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->string('class');

            $table->decimal('inst1_amount', 10, 2)->nullable();
            $table->date('inst1_date')->nullable();
            $table->enum('inst1_status', ['paid', 'pending'])->default('pending');

            $table->decimal('inst2_amount', 10, 2)->nullable();
            $table->date('inst2_date')->nullable();
            $table->enum('inst2_status', ['paid', 'pending'])->default('pending');

            $table->decimal('inst3_amount', 10, 2)->nullable();
            $table->date('inst3_date')->nullable();
            $table->enum('inst3_status', ['paid', 'pending'])->default('pending');

            $table->decimal('inst4_amount', 10, 2)->nullable();
            $table->date('inst4_date')->nullable();
            $table->enum('inst4_status', ['paid', 'pending'])->default('pending');

            $table->decimal('inst5_amount', 10, 2)->nullable();
            $table->date('inst5_date')->nullable();
            $table->enum('inst5_status', ['paid', 'pending'])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
