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

    public ?int $editingReplyId = null;

    #[Rule('required|string|min:10')]
    public string $editReplyContent = '';

    public function mount(string $slug): void
    {
        $this->discussion = Discussion::query()
            ->with(['user', 'category', 'replies.user'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Increment view count only once per session
        $sessionKey = 'viewed_discussion_'.$this->discussion->id;
        if (! session()->has($sessionKey)) {
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

    public function markAsBestAnswer(int $replyId): void
    {
        // Only discussion author can mark best answer
        if (auth()->id() !== $this->discussion->user_id) {
            abort(403, 'Only the discussion author can mark a best answer.');
        }

        $reply = DiscussionReply::findOrFail($replyId);

        // Ensure the reply belongs to this discussion
        if ($reply->discussion_id !== $this->discussion->id) {
            abort(403, 'This reply does not belong to this discussion.');
        }

        $reply->markAsBestAnswer();

        session()->flash('success', 'Reply marked as best answer!');

        // Refresh discussion with replies
        $this->discussion->load('replies.user');
        $this->discussion->refresh();
    }

    public function removeBestAnswer(int $replyId): void
    {
        // Only discussion author can remove best answer
        if (auth()->id() !== $this->discussion->user_id) {
            abort(403, 'Only the discussion author can remove a best answer.');
        }

        $reply = DiscussionReply::findOrFail($replyId);

        // Ensure the reply belongs to this discussion
        if ($reply->discussion_id !== $this->discussion->id) {
            abort(403, 'This reply does not belong to this discussion.');
        }

        $reply->removeBestAnswer();

        session()->flash('success', 'Best answer removed!');

        // Refresh discussion with replies
        $this->discussion->load('replies.user');
        $this->discussion->refresh();
    }

    public function addReply(): void
    {
        if (! auth()->check()) {
            abort(403, 'You must be logged in to reply.');
        }

        $this->validateOnly('replyContent');

        DiscussionReply::create([
            'discussion_id' => $this->discussion->id,
            'user_id' => auth()->id(),
            'content' => $this->replyContent,
        ]);

        // Reset form
        $this->replyContent = '';
        $this->dispatch('reply-added');

        // Refresh discussion with replies
        $this->discussion->load('replies.user');

        session()->flash('success', 'Reply added successfully!');
    }

    public function startEditingReply(int $replyId): void
    {
        $reply = DiscussionReply::findOrFail($replyId);

        // Only reply author can edit their reply
        if (auth()->id() !== $reply->user_id) {
            abort(403, 'You can only edit your own replies.');
        }

        $this->editingReplyId = $replyId;
        $this->editReplyContent = $reply->content;
    }

    public function updateReply(): void
    {
        $this->validateOnly('editReplyContent');

        $reply = DiscussionReply::findOrFail($this->editingReplyId);

        // Only reply author can edit their reply
        if (auth()->id() !== $reply->user_id) {
            abort(403, 'You can only edit your own replies.');
        }

        $reply->update([
            'content' => $this->editReplyContent,
        ]);

        // Reset editing state
        $this->editingReplyId = null;
        $this->editReplyContent = '';
        $this->dispatch('reply-updated');

        // Refresh discussion with replies
        $this->discussion->load('replies.user');

        session()->flash('success', 'Reply updated successfully!');
    }

    public function cancelEditingReply(): void
    {
        $this->editingReplyId = null;
        $this->editReplyContent = '';
    }

    public function deleteReply(int $replyId): void
    {
        $reply = DiscussionReply::findOrFail($replyId);

        // Only reply author can delete their reply
        if (auth()->id() !== $reply->user_id) {
            abort(403, 'You can only delete your own replies.');
        }

        // If this was the best answer, unmark it
        if ($reply->is_best_answer) {
            $reply->removeBestAnswer();
        }

        $reply->delete();

        // Refresh discussion with replies
        $this->discussion->load('replies.user');

        session()->flash('success', 'Reply deleted successfully!');
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
