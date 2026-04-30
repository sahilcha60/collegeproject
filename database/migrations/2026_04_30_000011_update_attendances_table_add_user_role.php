<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id')->constrained()->nullOnDelete();
            $table->enum('role', ['student', 'teacher'])->default('student')->after('user_id');
            $table->foreignId('subject_id')->nullable()->change();
        });

        DB::statement('UPDATE attendances INNER JOIN students ON attendances.student_id = students.id SET attendances.user_id = students.user_id');
        DB::table('attendances')->whereNull('role')->update(['role' => 'student']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'role']);
            $table->foreignId('subject_id')->nullable(false)->change();
        });
    }
};
