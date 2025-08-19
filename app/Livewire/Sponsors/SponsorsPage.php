<?php

namespace App\Livewire\Sponsors;

use Livewire\Component;

class SponsorsPage extends Component
{
    public function render()
    {
        return view('livewire.sponsors.sponsors-page')
            ->title('Become a Sponsor - phpuzem');
    }
}
