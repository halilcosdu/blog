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
        Schema::create('user_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->morphs('progressable'); // progressable_type, progressable_id (Episode, Series, or Pathway)
            $table->integer('watched_seconds')->default(0);
            $table->integer('total_seconds')->default(0);
            $table->decimal('progress_percentage', 5, 2)->default(0);
            $table->boolean('is_completed')->default(false);
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('last_watched_at')->nullable();
            $table->timestamps();
            
            $table->unique(['user_id', 'progressable_type', 'progressable_id']);
            $table->index(['user_id', 'is_completed']);
            $table->index(['user_id', 'last_watched_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_progress');
    }
};
