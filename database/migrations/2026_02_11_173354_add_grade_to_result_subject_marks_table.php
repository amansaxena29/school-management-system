<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('result_subject_marks', function (Blueprint $table) {
            if (!Schema::hasColumn('result_subject_marks', 'grade')) {
                $table->string('grade', 10)->nullable()->after('max_marks');
            }
        });
    }

    public function down(): void
    {
        Schema::table('result_subject_marks', function (Blueprint $table) {
            if (Schema::hasColumn('result_subject_marks', 'grade')) {
                $table->dropColumn('grade');
            }
        });
    }
};
