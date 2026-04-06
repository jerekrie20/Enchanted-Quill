<?php

namespace App\Livewire\Portal;

use App\Models\Boss;
use Livewire\Component;

class BossBar extends Component
{
    public function getActiveBossProperty(): ?Boss
    {
        return Boss::active()->siteWide()->first();
    }

    public function render()
    {
        return view('livewire.portal.boss-bar');
    }
}
