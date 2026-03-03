<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gallery', function (Blueprint $table) {
            // 'image' or 'video'
            $table->string('type')->default('image')->after('is_url');
            // for uploaded video file path
            $table->string('video_path')->nullable()->after('type');
        });
    }

    public function down(): void
    {
        Schema::table('gallery', function (Blueprint $table) {
            $table->dropColumn(['type', 'video_path']);
        });
    }
};
