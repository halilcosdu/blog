<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('series', function (Blueprint $table) {
            $table->dropColumn('rating');
        });

        Schema::table('episodes', function (Blueprint $table) {
            $table->dropColumn('rating');
        });

        Schema::table('pathways', function (Blueprint $table) {
            $table->dropColumn('rating');
        });
    }

    public function down(): void
    {
        Schema::table('series', function (Blueprint $table) {
            $table->decimal('rating', 3, 2)->nullable()->after('views_count');
        });

        Schema::table('episodes', function (Blueprint $table) {
            $table->decimal('rating', 3, 2)->nullable()->after('views_count');
        });

        Schema::table('pathways', function (Blueprint $table) {
            $table->decimal('rating', 3, 2)->nullable()->after('students_count');
        });
    }
};