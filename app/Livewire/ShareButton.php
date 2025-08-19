<?php

namespace App\Livewire;

use Livewire\Component;

class ShareButton extends Component
{
    public bool $copied = false;

    public string $shareUrl;

    public function mount(): void
    {
        $this->shareUrl = request()->url();
    }

    public function copyToClipboard(): void
    {
        $this->copied = true;
        $this->dispatch('copy-url', url: $this->shareUrl);

        // Reset after 2 seconds
        $this->dispatch('reset-copied-state');
    }

    public function resetCopiedState(): void
    {
        $this->copied = false;
    }

    public function render()
    {
        return view('livewire.share-button');
    }
}
