<?php

namespace App\Livewire\Blog;

use App\Models\Post;
use Livewire\Component;

class Pricing extends Component
{
    public function render()
    {
        $topLessons = \Cache::remember('pricing.top_lessons', 600, function () {
            return Post::query()
                ->published()
                ->whereNotNull('featured_image')
                ->with(['user:id,name,email', 'category:id,name,slug'])
                ->orderByDesc('views_count')
                ->take(12)
                ->get();
        });

        $seoData = [
            'title' => 'Pricing - phpuzem | Affordable Laravel Learning Plans',
            'description' => 'Choose your learning plan at phpuzem. From free tutorials to premium courses with source code, priority support, and expert guidance for Laravel developers.',
            'keywords' => 'Laravel pricing, PHP course pricing, Laravel tutorial cost, web development learning, programming course subscription',
            'url' => request()->url(),
            'type' => 'website',
            'image' => asset('images/og-pricing.jpg'),
        ];

        return view('livewire.blog.pricing', [
            'topLessons' => $topLessons,
        ])
            ->title('Pricing - phpuzem | Affordable Laravel Learning Plans')
            ->layout('components.layouts.app', compact('seoData'));
    }
}
