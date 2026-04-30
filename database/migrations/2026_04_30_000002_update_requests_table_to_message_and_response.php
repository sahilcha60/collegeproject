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
        Schema::table('requests', function (Blueprint $table) {
            $table->text('message')->nullable()->after('type');
            $table->text('response')->nullable()->after('status');
        });

        DB::table('requests')->update(['message' => DB::raw('content')]);

        Schema::table('requests', function (Blueprint $table) {
            $table->dropColumn('content');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('requests', function (Blueprint $table) {
            $table->text('content')->nullable()->after('type');
        });

        DB::table('requests')->update(['content' => DB::raw('message')]);

        Schema::table('requests', function (Blueprint $table) {
            $table->dropColumn(['message', 'response']);
        });
    }
};
