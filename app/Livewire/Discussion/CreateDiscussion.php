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
    #[Rule('required|string|min:5|max:255')]
    public string $title = '';

    #[Rule('required|string|min:10')]
    public string $content = '';

    #[Rule('required|exists:categories,id,is_active,1')]
    public ?int $category_id = null;

    public function save(): void
    {
        $this->validate();

        Discussion::query()
            ->create([
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
