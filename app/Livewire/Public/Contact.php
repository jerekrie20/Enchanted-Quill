<?php

namespace App\Livewire\Public;

use App\Mail\AdminContactNotification;
use App\Models\Contact as ContactModel;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Contact extends Component
{
    #[Layout('components.layouts.public')]
    #[Title('Contact Us - Enchanted Quill')]
    public $name = '';

    public $email = '';

    public $subject = '';

    public $message = '';

    public function mount()
    {
        if (auth()->check()) {
            $this->name = auth()->user()->name;
            $this->email = auth()->user()->email;
        }
    }

    public function submit(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255', 'blasp_check'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255', 'blasp_check'],
            'message' => ['required', 'string', 'min:10', 'blasp_check'],
        ]);

        $contactData = array_merge($validated, [
            'status' => ContactModel::STATUS_UNREAD,
            'user_id' => auth()->id(),
            'is_from_admin' => false,
        ]);

        // Let's prepend subject to the message.
        $contactData['message'] = 'Subject: '.$validated['subject']."\n\n".$validated['message'];
        unset($contactData['subject']);

        $contact = ContactModel::create($contactData);

        // Send email to admin
        $admin = User::where('role', 'admin')->first();
        $adminEmail = $admin ? $admin->email : config('mail.from.address');

        Mail::to($adminEmail)->send(new AdminContactNotification($contact));

        session()->flash('success', 'Thank you for your message! We\'ll get back to you soon.');

        $this->reset(['message']);

        if (! auth()->check()) {
            $this->reset(['name', 'email', 'subject']);
        } else {
            $this->reset(['subject']);
        }
    }

    public function render()
    {
        return view('livewire.public.contact');
    }
}
