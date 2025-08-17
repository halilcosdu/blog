<?php

namespace App\Livewire\Blog;

use App\Models\Post;
use Illuminate\Support\Str;
use Livewire\Component;

class PostShow extends Component
{
    public Post $post;

    public function mount($slug)
    {
        $this->post = Post::query()
            ->published()
            ->with(['user:id,name,email', 'category:id,name,slug'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Increment views count
        $this->post->increment('views_count');
    }

    public function render()
    {
        $relatedPosts = Post::query()
            ->published()
            ->where('category_id', $this->post->category_id)
            ->where('id', '!=', $this->post->id)
            ->with(['user:id,name,email', 'category:id,name,slug'])
            ->take(3)
            ->get();

        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Posts', 'url' => '/posts'],
            ['name' => $this->post->category->name, 'url' => '/category/'.$this->post->category->slug],
            ['name' => $this->post->title, 'url' => request()->url()],
        ];

        $seoData = [
            'title' => $this->post->title.' - phpuzem',
            'description' => $this->post->excerpt ?: Str::limit(strip_tags($this->post->content), 160),
            'keywords' => implode(', ', $this->post->tags ?? []).', Laravel, PHP, Tutorial',
            'url' => request()->url(),
            'type' => 'article',
            'image' => $this->post->featured_image ?: asset('images/og-default.jpg'),
            'publishedTime' => $this->post->published_at?->toISOString(),
            'modifiedTime' => $this->post->updated_at?->toISOString(),
            'section' => $this->post->category?->name,
            'tags' => $this->post->tags ?? [],
            'author' => $this->post->user?->name,
            'authorEmail' => $this->post->user?->email,
            'authorImage' => null, // Can be added if you have user profile images
            'breadcrumbs' => $breadcrumbs,
            'readingTime' => $this->post->reading_time ?? null,
            'wordCount' => $this->post->word_count ?? null,
            'category' => $this->post->category?->name,
        ];

        return view('livewire.blog.post-show', [
            'relatedPosts' => $relatedPosts,
        ])
            ->title($this->post->title.' - phpuzem')
            ->layout('components.layouts.app', compact('seoData'));
    }
}
