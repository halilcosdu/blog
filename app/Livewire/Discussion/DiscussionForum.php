<?php

namespace App\Livewire\Discussion;

use Livewire\Component;

class DiscussionForum extends Component
{
    public function render()
    {
        return view('livewire.discussion.discussion-forum')
            ->layout('components.layouts.app', [
                'seoData' => [
                    'title' => 'Discussion Forum - phpuzem',
                    'description' => 'Ask questions, share knowledge, and connect with the PHP and Laravel community.',
                ]
            ]);
    }
}
