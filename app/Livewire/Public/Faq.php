<?php

namespace App\Livewire\Public;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Faq extends Component
{
    #[Layout('components.layouts.public')]
    #[Title('Frequently Asked Questions - Enchanted Quill')]
    public function render()
    {
        return view('livewire.public.faq');
    }
}
