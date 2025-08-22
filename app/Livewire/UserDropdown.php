<?php

namespace App\Livewire;

use Livewire\Component;

class UserDropdown extends Component
{
    public bool $open = false;

    public function toggle(): void
    {
        $this->open = ! $this->open;
    }

    public function openDropdown(): void
    {
        $this->open = true;
    }

    public function closeDropdown(): void
    {
        $this->open = false;
    }

    public function navigateToDashboard(): void
    {
        $this->closeDropdown();
        $this->redirect('/dashboard');
    }

    public function logout(): void
    {
        $this->closeDropdown();
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        $this->redirect(route('filament.dashboard.auth.login'));
    }

    public function render()
    {
        return view('livewire.user-dropdown');
    }
}
