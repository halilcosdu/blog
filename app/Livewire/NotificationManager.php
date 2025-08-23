<?php

namespace App\Livewire;

use Livewire\Component;

class NotificationManager extends Component
{
    public array $notifications = [];

    protected $listeners = ['show-notification' => 'handleGlobalNotification'];

    public function mount(): void
    {
        $this->addSessionNotifications();
    }

    public function addNotification(string $type, string $message): void
    {
        $id = uniqid();
        $this->notifications[] = [
            'id' => $id,
            'type' => $type,
            'message' => $message,
            'created_at' => now()->timestamp,
        ];

        // Auto-remove after 5 seconds using JavaScript
        $this->dispatch('auto-remove-notification', id: $id);
    }

    public function removeNotification(string $id): void
    {
        $this->notifications = array_filter(
            $this->notifications,
            fn ($notification) => $notification['id'] !== $id
        );
    }

    public function handleGlobalNotification(...$params): void
    {
        // Handle different parameter formats
        if (count($params) === 1 && is_array($params[0])) {
            // Passed as array: ['type' => 'success', 'message' => 'Message']
            $data = $params[0];
        } elseif (count($params) >= 2) {
            // Passed as separate parameters: 'success', 'Message'
            $data = ['type' => $params[0], 'message' => $params[1]];
        } else {
            // Fallback
            $data = [];
        }

        $type = $data['type'] ?? 'info';
        $message = $data['message'] ?? '';
        $this->addNotification($type, $message);
    }

    private function addSessionNotifications(): void
    {
        if (session()->has('success')) {
            $this->addNotification('success', session('success'));
            session()->forget('success');
        }

        if (session()->has('error')) {
            $this->addNotification('error', session('error'));
            session()->forget('error');
        }

        if (session()->has('warning')) {
            $this->addNotification('warning', session('warning'));
            session()->forget('warning');
        }

        if (session()->has('info')) {
            $this->addNotification('info', session('info'));
            session()->forget('info');
        }
    }

    public function render()
    {
        return view('livewire.notification-manager');
    }
}
