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
        Schema::create('pathway_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pathway_id')->constrained()->onDelete('cascade');
            $table->morphs('item'); // item_type, item_id (Series or Episode)
            $table->integer('sort_order')->default(0);
            $table->boolean('is_required')->default(true);
            $table->timestamps();
            
            $table->unique(['pathway_id', 'item_type', 'item_id']);
            $table->index(['pathway_id', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pathway_items');
    }
};
