<?php

namespace App\Livewire\Discussion;

use App\Models\Discussion;
use App\Models\DiscussionReply;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;

class DiscussionShow extends Component
{
    public Discussion $discussion;
    
    #[Rule('required|string|min:10')]
    public string $replyContent = '';

    public function mount(string $slug): void
    {
        $this->discussion = Discussion::query()
            ->with(['user', 'category', 'replies.user'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Increment view count only once per session
        $sessionKey = 'viewed_discussion_' . $this->discussion->id;
        if (!session()->has($sessionKey)) {
            $this->discussion->incrementViewCount();
            session()->put($sessionKey, true);
        }
    }

    public function markAsResolved(): void
    {
        // Only discussion author can mark as resolved
        if (auth()->id() !== $this->discussion->user_id) {
            abort(403, 'You can only mark your own discussions as resolved.');
        }

        $this->discussion->markAsResolved();
        
        session()->flash('success', 'Discussion marked as resolved!');
        
        // Refresh the discussion data
        $this->discussion->refresh();
    }

    public function markAsUnresolved(): void
    {
        // Only discussion author can mark as unresolved
        if (auth()->id() !== $this->discussion->user_id) {
            abort(403, 'You can only mark your own discussions as unresolved.');
        }

        $this->discussion->markAsUnresolved();
        
        session()->flash('success', 'Discussion marked as unresolved!');
        
        // Refresh the discussion data
        $this->discussion->refresh();
    }
    
    public function addReply(): void
    {
        if (!auth()->check()) {
            abort(403, 'You must be logged in to reply.');
        }
        
        $this->validate();
        
        DiscussionReply::create([
            'discussion_id' => $this->discussion->id,
            'user_id' => auth()->id(),
            'content' => $this->replyContent,
        ]);
        
        // Reset form
        $this->replyContent = '';
        
        // Refresh discussion with replies
        $this->discussion->load('replies.user');
        
        session()->flash('success', 'Reply added successfully!');
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.discussion.discussion-show')->layoutData([
            'seoData' => [
                'title' => $this->discussion->title.' - phpuzem',
                'description' => substr(strip_tags($this->discussion->content), 0, 160),
            ],
        ]);
    }
}