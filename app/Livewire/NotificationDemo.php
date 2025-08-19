<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

class NotificationDemo extends Component
{
    public function showSuccess(): void
    {
        session()->flash('success', 'Success! This notification will disappear in 5 seconds! 🎉');
    }

    public function showError(): void
    {
        session()->flash('error', 'Error! Auto-disappears in 5 seconds! ❌');
    }

    public function showWarning(): void
    {
        session()->flash('warning', 'Warning! Auto-disappears in 5 seconds! ⚠️');
    }

    public function showInfo(): void
    {
        session()->flash('info', 'Info! Auto-disappears in 5 seconds! ℹ️');
    }

    public function showMultiple(): void
    {
        session()->flash('success', 'Success: Operation completed successfully!');
        session()->flash('info', 'Info: Additional information is available.');
        session()->flash('warning', 'Warning: Please review the changes.');
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.notification-demo', [
            'seoData' => [
                'title' => 'Notification Demo - phpuzem',
                'description' => 'Demo page for testing notification system.',
            ],
        ]);
    }
}
