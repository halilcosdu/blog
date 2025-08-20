<?php

namespace App\Livewire\Blog;

use App\Livewire\BaseComponent;
use App\Models\Package;

class PackagesSection extends BaseComponent
{
    public $packages = [];

    public $loaded = false;

    public function loadContent(): void
    {
        if ($this->loaded) {
            return;
        }

        $this->packages = Package::active()
            ->with('tags')
            ->ordered()
            ->limit(6)
            ->get()
            ->map(function ($package) {
                return [
                    'name' => $package->name,
                    'description' => $package->description,
                    'status' => $package->status,
                    'icon' => $package->icon,
                    'url' => $package->url,
                    'github_url' => $package->github_url,
                    'packagist_url' => $package->packagist_url,
                    'documentation_url' => $package->documentation_url,
                    'version' => $package->version,
                    'downloads_count' => number_format($package->downloads_count),
                    'stars_count' => number_format($package->stars_count),
                    'tags' => $package->tags,
                    'status_color' => $package->status_color,
                ];
            })
            ->toArray();

        $this->loaded = true;
    }

    public function getStatusBadgeClasses(string $status): string
    {
        return match ($status) {
            'Released' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300',
            'Beta' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-300',
            'Coming Soon' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300',
            'In Development' => 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-300',
            'Planning' => 'bg-slate-100 text-slate-700 dark:bg-slate-900/30 dark:text-slate-300',
            default => 'bg-slate-100 text-slate-700 dark:bg-slate-900/30 dark:text-slate-300',
        };
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.blog.packages-section');
    }
}
