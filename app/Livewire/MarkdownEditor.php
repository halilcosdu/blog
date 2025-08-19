<?php

namespace App\Livewire;

use Livewire\Attributes\Locked;
use Livewire\Component;

class MarkdownEditor extends Component
{
    public string $content = '';

    public string $name = 'content';

    public string $placeholder = 'Write something...';

    public int $rows = 8;

    public bool $required = false;

    public string $activeTab = 'write';

    #[Locked]
    public array $mentionDropdown = [
        'show' => false,
        'users' => [],
        'selectedIndex' => 0,
        'top' => 0,
        'left' => 0,
        'query' => '',
        'startPos' => 0,
    ];

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
        if ($tab === 'preview') {
            $this->dispatch('update-preview');
        }
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

    public function updateContent(string $content): void
    {
        $this->content = $content;
    }

    public function showMentionDropdown(array $data): void
    {
        $this->mentionDropdown = array_merge($this->mentionDropdown, $data);
        $this->mentionDropdown['show'] = true;
        $this->searchUsers($this->mentionDropdown['query'] ?? '');
    }

    public function hideMentionDropdown(): void
    {
        $this->mentionDropdown['show'] = false;
        $this->mentionDropdown['users'] = [];
    }

    public function selectMention(array $user): void
    {
        $this->dispatch('select-mention', user: $user);
        $this->hideMentionDropdown();
    }

    public function selectMentionByIndex(int $index): void
    {
        if (isset($this->mentionDropdown['users'][$index])) {
            $user = $this->mentionDropdown['users'][$index];
            $this->selectMention($user);
        }
    }

    public function searchUsers(string $query = ''): void
    {
        // Simulated user search - in real app this would be a database query
        $users = [
            ['id' => 1, 'name' => 'John Doe', 'username' => 'johndoe'],
            ['id' => 2, 'name' => 'Jane Smith', 'username' => 'janesmith'],
            ['id' => 3, 'name' => 'Alice Johnson', 'username' => 'alice.johnson'],
            ['id' => 4, 'name' => 'Bob Wilson', 'username' => 'bob_wilson'],
        ];

        if ($query) {
            $users = array_filter($users, function ($user) use ($query) {
                return stripos($user['name'], $query) !== false ||
                       stripos($user['username'], $query) !== false;
            });
        }

        $this->mentionDropdown['users'] = array_values(array_slice($users, 0, 8));
    }

    public function render()
    {
        return view('livewire.markdown-editor');
    }
}
