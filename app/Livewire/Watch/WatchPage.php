<?php

namespace App\Livewire\Watch;

use Livewire\Component;

class WatchPage extends Component
{
    public function render()
    {
        $seoData = [
            'title' => 'Watch & Learn - phpuzem | Video Courses & Tutorials',
            'description' => 'Comprehensive video courses and tutorials to master modern PHP & Laravel development. Learn through hands-on screencasts and complete series.',
            'keywords' => 'video courses, PHP tutorials, Laravel screencasts, web development videos, programming lessons',
            'url' => request()->url(),
            'type' => 'website',
            'image' => asset('images/og-watch.jpg'),
        ];

        return view('livewire.watch.watch-page')
            ->title('Watch & Learn - phpuzem | Video Courses & Tutorials')
            ->layout('components.layouts.app', compact('seoData'));
    }
}
