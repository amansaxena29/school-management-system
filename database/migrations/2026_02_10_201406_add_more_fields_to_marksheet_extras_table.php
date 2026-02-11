<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('marksheet_extras', function (Blueprint $table) {

            // Co-scholastic (Term-I / Term-II)
            $table->string('art_education_term1')->nullable()->after('discipline_term2');
            $table->string('art_education_term2')->nullable()->after('art_education_term1');

            $table->string('general_awareness_term1')->nullable()->after('art_education_term2');
            $table->string('general_awareness_term2')->nullable()->after('general_awareness_term1');

            $table->string('health_physical_term1')->nullable()->after('general_awareness_term2');
            $table->string('health_physical_term2')->nullable()->after('health_physical_term1');
        });
    }

    public function down(): void
    {
        Schema::table('marksheet_extras', function (Blueprint $table) {
            $table->dropColumn([
                'art_education_term1','art_education_term2',
                'general_awareness_term1','general_awareness_term2',
                'health_physical_term1','health_physical_term2',
            ]);
        });
    }
};
