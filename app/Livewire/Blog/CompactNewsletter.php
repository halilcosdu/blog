<?php

namespace App\Livewire\Blog;

use App\Livewire\BaseComponent;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\View\View;

class CompactNewsletter extends BaseComponent
{
    public $search = '';

    public $selectedCategory = '';

    public $showFilters = false;

    public $email = '';

    public $isSubscribed = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedCategory' => ['except' => ''],
    ];

    public function mount(): void
    {
        // Check if user is already subscribed (you can implement this logic)
        $this->isSubscribed = false;
    }

    public function toggleFilters(): void
    {
        $this->showFilters = ! $this->showFilters;
    }

    public function clearFilters(): void
    {
        $this->search = '';
        $this->selectedCategory = '';
    }

    public function subscribe(): void
    {
        $this->validate([
            'email' => 'required|email|max:255',
        ]);

        // Here you would implement the actual newsletter subscription logic
        // For now, we'll just show a success message
        $this->isSubscribed = true;
        $this->email = '';

        // You can dispatch an event to show a notification
        $this->dispatch('newsletter-subscribed');
    }

    public function getNewsletterPosts()
    {
        return $this->cacheShort($this->getCacheKey('newsletter_posts'), function () {
            try {
                $query = Post::query()
                    ->published()
                    ->with(['user:id,name', 'category:id,name,color'])
                    ->latest('published_at')
                    ->limit(6);

                if ($this->search) {
                    $query->where(function ($q) {
                        $q->where('title', 'like', '%'.$this->search.'%')
                            ->orWhere('excerpt', 'like', '%'.$this->search.'%');
                    });
                }

                if ($this->selectedCategory) {
                    $query->whereHas('category', function ($q) {
                        $q->where('slug', $this->selectedCategory);
                    });
                }

                return $query->get();
            } catch (\Exception $e) {
                // Return empty collection if database is not available
                return collect();
            }
        });
    }

    public function getCategories()
    {
        return $this->cacheMedium($this->getCacheKey('newsletter_categories'), function () {
            try {
                return Category::query()
                    ->where('is_active', true)
                    ->withCount(['posts as posts_count' => function ($query) {
                        $query->published();
                    }])
                    ->having('posts_count', '>', 0)
                    ->orderBy('name')
                    ->get();
            } catch (\Exception $e) {
                // Return empty collection if database is not available
                return collect();
            }
        });
    }

    public function render(): View
    {
        $posts = $this->getNewsletterPosts();
        $categories = $this->getCategories();

        return view('livewire.blog.compact-newsletter', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }
}
