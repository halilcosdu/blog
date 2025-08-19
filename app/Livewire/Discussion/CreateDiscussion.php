<?php

namespace App\Livewire\Discussion;

use App\Models\Category;
use App\Models\Discussion;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreateDiscussion extends Component
{
    #[Rule('required|string|max:255')]
    public string $title = '';

    #[Rule('required|string')]
    public string $content = '';

    #[Rule('required|exists:categories,id')]
    public ?int $category_id = null;

    public function save(): void
    {
        // Debug content
        logger()->info('Discussion content before validation:', [
            'content' => $this->content,
            'content_length' => strlen($this->content),
            'content_empty' => empty($this->content),
        ]);

        $this->validate();

        Discussion::create([
            'user_id' => Auth::id(),
            'category_id' => $this->category_id,
            'title' => $this->title,
            'content' => $this->content,
            'is_resolved' => false,
            'views_count' => 0,
        ]);

        session()->flash('success', 'Discussion created successfully!');

        $this->redirectRoute('discussions.index');
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('livewire.discussion.create-discussion', [
            'categories' => $categories,
        ])->layoutData([
            'seoData' => [
                'title' => 'Create New Discussion - phpuzem',
                'description' => 'Start a new discussion with the PHP and Laravel community.',
            ],
        ]);
    }
}
