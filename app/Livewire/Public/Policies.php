<?php

namespace App\Livewire\Public;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Policies extends Component
{
    #[Layout('components.Layouts.public')]
    #[Title('Policies - Enchanted Quill')]
    public function render()
    {
        return view('livewire.public.policies');
    }
}
