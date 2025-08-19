<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class SimpleMarkdownEditor extends Component
{
    public string $content = '';

    public string $name = 'content';

    public string $placeholder = 'Write something...';

    public int $rows = 8;

    public bool $required = false;

    public string $activeTab = 'write';

    public function mount(
        string $name = 'content',
        string $value = '',
        string $placeholder = 'Write something...',
        int $rows = 8,
        bool $required = false
    ): void {
        $this->name = $name;
        $this->content = $value;
        $this->placeholder = $placeholder;
        $this->rows = $rows;
        $this->required = $required;
    }

    public function setActiveTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    public function insertText(string $before, string $after = ''): void
    {
        $this->dispatch('insert-text', before: $before, after: $after);
    }

    public function insertCodeBlock(): void
    {
        $this->dispatch('insert-code-block');
    }

    public function insertLink(): void
    {
        $this->dispatch('insert-link');
    }

    public function updatedContent(): void
    {
        $this->dispatch('content-updated', name: $this->name, content: $this->content);
    }

    #[On('clear-editor-content')]
    public function clearContent(): void
    {
        $this->content = '';
        $this->activeTab = 'write';
        $this->dispatch('content-updated', name: $this->name, content: '');
    }

    public function render()
    {
        return view('livewire.simple-markdown-editor');
    }
}
