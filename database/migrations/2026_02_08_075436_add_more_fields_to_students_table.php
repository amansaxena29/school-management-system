<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('father_name')->nullable()->after('name');
            $table->string('mother_name')->nullable()->after('father_name');
            $table->text('address')->nullable()->after('phone');
            $table->string('religion')->nullable()->after('address');
            $table->string('citizenship')->nullable()->after('religion');
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn([
                'father_name',
                'mother_name',
                'address',
                'religion',
                'citizenship',
            ]);
        });
    }
};
