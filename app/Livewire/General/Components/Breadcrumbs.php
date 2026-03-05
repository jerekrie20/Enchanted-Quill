<?php

namespace App\Livewire\General\Components;

use Livewire\Component;

class Breadcrumbs extends Component
{
    public array $items = [];

    public function mount(array $items = []): void
    {
        $this->items = $items;
    }

    public function render()
    {
        return view('livewire.general.components.breadcrumbs');
    }
}
