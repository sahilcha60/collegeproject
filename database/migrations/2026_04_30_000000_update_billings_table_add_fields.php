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
        Schema::table('billings', function (Blueprint $table) {
            if (!Schema::hasColumn('billings', 'title')) {
                $table->string('title')->default('Tuition Fee')->after('student_id');
            }
            if (!Schema::hasColumn('billings', 'type')) {
                $table->enum('type', ['fee', 'fine'])->default('fee')->after('title');
            }
            if (!Schema::hasColumn('billings', 'paid_at')) {
                $table->timestamp('paid_at')->nullable()->after('due_date');
            }
            if (!Schema::hasColumn('billings', 'created_by')) {
                $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete()->after('paid_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('billings', function (Blueprint $table) {
            if (Schema::hasColumn('billings', 'created_by')) {
                $table->dropForeign(['created_by']);
                $table->dropColumn('created_by');
            }
            if (Schema::hasColumn('billings', 'paid_at')) {
                $table->dropColumn('paid_at');
            }
            if (Schema::hasColumn('billings', 'type')) {
                $table->dropColumn('type');
            }
            if (Schema::hasColumn('billings', 'title')) {
                $table->dropColumn('title');
            }
        });
    }
};
