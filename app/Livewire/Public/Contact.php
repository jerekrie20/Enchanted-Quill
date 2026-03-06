<?php

namespace App\Livewire\Public;

use App\Models\ContactMessage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Contact extends Component
{
    #[Layout('components.Layouts.public')]
    #[Title('Contact Us - Enchanted Quill')]
    public $name = '';

    public $email = '';

    public $subject = '';

    public $message = '';

    public function submit(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'min:10'],
        ]);

        ContactMessage::create($validated);

        session()->flash('success', 'Thank you for your message! We\'ll get back to you soon.');

        $this->reset(['name', 'email', 'subject', 'message']);
    }

    public function render()
    {
        return view('livewire.public.contact');
    }
}
