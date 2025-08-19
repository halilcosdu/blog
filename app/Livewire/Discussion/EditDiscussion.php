<?php

namespace App\Livewire\Discussion;

use App\Models\Category;
use App\Models\Discussion;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;

class EditDiscussion extends Component
{
    use AuthorizesRequests;

    public Discussion $discussion;

    #[Rule('required|string|max:255')]
    public string $title = '';

    #[Rule('required|string')]
    public string $content = '';

    #[Rule('required|exists:categories,id')]
    public ?int $category_id = null;

    public function mount(string $slug): void
    {
        $this->discussion = Discussion::query()->where('slug', $slug)->firstOrFail();

        // Check if user can edit this discussion
        if (Auth::id() !== $this->discussion->user_id) {
            abort(403, 'You can only edit your own discussions.');
        }

        $this->title = $this->discussion->title;
        $this->content = $this->discussion->content;
        $this->category_id = $this->discussion->category_id;
    }

    public function save(): void
    {
        $this->validate();

        $this->discussion->update([
            'title' => $this->title,
            'content' => $this->content,
            'category_id' => $this->category_id,
        ]);

        session()->flash('success', 'Discussion updated successfully!');

        $this->redirectRoute('discussions.show', ['slug' => $this->discussion->slug]);
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('livewire.discussion.edit-discussion', [
            'categories' => $categories,
        ])->layoutData([
            'seoData' => [
                'title' => 'Edit Discussion - phpuzem',
                'description' => 'Edit your discussion post.',
            ],
        ]);
    }
}
