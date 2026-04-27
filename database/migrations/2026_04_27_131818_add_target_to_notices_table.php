<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('notices', function (Blueprint $table) {
            $table->enum('target', ['student', 'teacher', 'all'])->default('all')->after('content');
        });
    }

    public function down(): void
    {
        Schema::table('notices', function (Blueprint $table) {
            $table->dropColumn('target');
        });
    }
};
