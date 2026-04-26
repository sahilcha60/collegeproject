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
        Schema::table('results', function (Blueprint $table) {
            $table->foreignId('exam_id')->after('id')->constrained()->cascadeOnDelete();
            $table->integer('internal_marks')->after('semester_id')->default(0);
            $table->integer('external_marks')->after('internal_marks')->default(0);
            $table->dropColumn('marks_obtained');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('results', function (Blueprint $table) {
            $table->dropForeign(['exam_id']);
            $table->dropColumn(['exam_id', 'internal_marks', 'external_marks']);
            $table->integer('marks_obtained')->nullable();
        });
    }
};
