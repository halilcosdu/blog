<?php

namespace App\Livewire\Blog;

use App\Livewire\BaseComponent;

class Pricing extends BaseComponent
{
    private function getTopLessons()
    {
        return $this->cacheMedium($this->getCacheKey('top_lessons'), function () {
            return \App\Models\Episode::published()
                ->where('is_standalone', true)
                ->whereNotNull('thumbnail')
                ->with(['user:id,name,email', 'category:id,name,slug'])
                ->orderByDesc('views_count')
                ->take(12)
                ->get();
        });
    }

    public function render()
    {
        $topLessons = $this->getTopLessons();
        $seoData = $this->getPricingSEO();

        return view('livewire.blog.pricing', [
            'topLessons' => $topLessons,
        ])
            ->title('Pricing - phpuzem | Affordable Laravel Learning Plans')
            ->layout('components.layouts.app', $seoData);
    }
}
