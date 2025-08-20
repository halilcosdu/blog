<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('color', 7)->nullable(); // Hex color code
            $table->text('description')->nullable();
            $table->integer('usage_count')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();

            // Indexes for performance
            $table->index(['name']);
            $table->index(['slug']);
            $table->index(['usage_count']);
            $table->index(['is_featured']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};
