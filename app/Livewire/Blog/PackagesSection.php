<?php

namespace App\Livewire\Blog;

use App\Livewire\BaseComponent;

class PackagesSection extends BaseComponent
{
    public $packages = [];

    public $loaded = false;

    public function loadContent(): void
    {
        if ($this->loaded) {
            return;
        }

        $this->packages = config('packages.packages', []);
        $this->loaded = true;
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.blog.packages-section');
    }
}
