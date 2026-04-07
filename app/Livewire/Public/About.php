<?php

namespace App\Livewire\Public;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class About extends Component
{
    #[Layout('components.layouts.public')]
    #[Title('About Us - Enchanted Quill')]
    public function render()
    {
        return view('livewire.public.about');
    }
}
