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

    // Mention functionality
    public bool $showMentionDropdown = false;

    public array $mentionUsers = [];

    public int $mentionSelectedIndex = 0;

    public string $mentionQuery = '';

    public int $mentionStartPos = 0;

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

        // Dispatch event to JavaScript when switching tabs
        if ($tab === 'preview') {
            $this->dispatch('preview-tab-activated');
        } elseif ($tab === 'write') {
            $this->dispatch('write-tab-activated');
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

    public function updatedContent(): void
    {
        $this->dispatch('content-updated', name: $this->name, content: $this->content);
    }

    #[On('clear-editor-content')]
    public function clearContent(): void
    {
        $this->content = '';
        $this->activeTab = 'write';
        $this->hideMentionDropdown();
        $this->dispatch('content-updated', name: $this->name, content: '');
    }

    // Mention functionality methods
    public function showMentions(): void
    {
        $this->showMentionDropdown = true;
        $this->mentionSelectedIndex = 0;
        $this->searchUsers();
    }

    public function hideMentionDropdown(): void
    {
        $this->showMentionDropdown = false;
        $this->mentionUsers = [];
        $this->mentionQuery = '';
    }

    public function searchUsers(string $query = ''): void
    {
        $this->mentionQuery = $query;

        // Mock user data for now - in production you'd fetch from API or database
        $allUsers = [
            ['id' => 1, 'name' => 'John Doe', 'username' => 'john.doe'],
            ['id' => 2, 'name' => 'Jane Smith', 'username' => 'jane.smith'],
            ['id' => 3, 'name' => 'Alice Johnson', 'username' => 'alice.johnson'],
            ['id' => 4, 'name' => 'Bob Wilson', 'username' => 'bob_wilson'],
            ['id' => 5, 'name' => 'Admin User', 'username' => 'admin'],
        ];

        if ($query) {
            $users = array_filter($allUsers, function ($user) use ($query) {
                return stripos($user['name'], $query) !== false ||
                       stripos($user['username'], $query) !== false;
            });
        } else {
            $users = $allUsers;
        }

        $this->mentionUsers = array_values(array_slice($users, 0, 5));
    }

    public function selectMention(array $user): void
    {
        $this->dispatch('select-mention', user: $user, startPos: $this->mentionStartPos);
        $this->hideMentionDropdown();
    }

    public function selectMentionByIndex(int $index): void
    {
        if (isset($this->mentionUsers[$index])) {
            $this->selectMention($this->mentionUsers[$index]);
        }
    }

    public function navigateMention(string $direction): void
    {
        if ($direction === 'up') {
            $this->mentionSelectedIndex = max(0, $this->mentionSelectedIndex - 1);
        } else {
            $this->mentionSelectedIndex = min(count($this->mentionUsers) - 1, $this->mentionSelectedIndex + 1);
        }
    }

    public function render()
    {
        return view('livewire.simple-markdown-editor');
    }
}
