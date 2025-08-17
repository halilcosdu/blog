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
        Schema::table('posts', function (Blueprint $table) {
            // Performance critical indexes
            $table->index('is_published', 'posts_is_published_index');
            $table->index('published_at', 'posts_published_at_index');
            $table->index('views_count', 'posts_views_count_index');
            $table->index('is_featured', 'posts_is_featured_index');

            // Composite indexes for common query patterns
            $table->index(['is_published', 'published_at'], 'posts_published_composite_index');
            $table->index(['is_published', 'views_count'], 'posts_popular_composite_index');
            $table->index(['is_published', 'is_featured'], 'posts_featured_composite_index');

            // Category and user relationships
            $table->index('category_id', 'posts_category_id_index');
            $table->index('user_id', 'posts_user_id_index');

            // Search optimization
            $table->index('slug', 'posts_slug_index');

            // Add fulltext only for MySQL/PostgreSQL
            if (Schema::getConnection()->getDriverName() !== 'sqlite') {
                $table->fullText(['title', 'excerpt', 'content'], 'posts_fulltext_search_index');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Drop performance indexes
            $table->dropIndex('posts_is_published_index');
            $table->dropIndex('posts_published_at_index');
            $table->dropIndex('posts_views_count_index');
            $table->dropIndex('posts_is_featured_index');

            // Drop composite indexes
            $table->dropIndex('posts_published_composite_index');
            $table->dropIndex('posts_popular_composite_index');
            $table->dropIndex('posts_featured_composite_index');

            // Drop relationship indexes
            $table->dropIndex('posts_category_id_index');
            $table->dropIndex('posts_user_id_index');

            // Drop search indexes
            $table->dropIndex('posts_slug_index');

            // Drop fulltext only if not SQLite
            if (Schema::getConnection()->getDriverName() !== 'sqlite') {
                $table->dropIndex('posts_fulltext_search_index');
            }
        });
    }
};
