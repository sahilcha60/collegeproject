<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->string('type')->default('college')->after('name'); // college | university
            $table->foreignId('semester_id')->nullable()->constrained()->nullOnDelete()->after('type');
        });
    }

    public function down(): void
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->dropConstrainedForeignId('semester_id');
            $table->dropColumn('type');
        });
    }
};
