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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->enum('status', ['Planning', 'In Development', 'Coming Soon', 'Beta', 'Released'])->default('Planning');
            $table->string('icon')->nullable();
            $table->string('url')->nullable();
            $table->string('github_url')->nullable();
            $table->string('packagist_url')->nullable();
            $table->string('documentation_url')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->string('version')->nullable();
            $table->integer('downloads_count')->default(0);
            $table->integer('stars_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
