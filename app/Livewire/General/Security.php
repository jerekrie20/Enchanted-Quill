<?php

namespace App\Livewire\General;

use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Security extends Component
{
    #[Validate]
    public $password;
    #[Validate]
    public $password_confirmation;

    #[Locked]
    public $user;


    //Validation Rules
    protected function rules()
    {
        return [
            'password' => [
                'nullable',
                'string',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
        ];
    }

    //Validation messages for passwords
    protected $messages = [
        'password.confirmed' => 'Your password confirmation does not match.',
        'password.min' => 'Your password must be at least :min characters.',
        'password.letters' => 'Your password must include at least one letter.',
        'password.mixedCase' => 'Your password must include both uppercase and lowercase characters.',
        'password.numbers' => 'Your password must include at least one number.',
        'password.symbols' => 'Your password must include at least one special character.',
        'password.uncompromised' => 'Your password has been found in a data breach. Please choose a different password.',
    ];

    public function save(): RedirectResponse
    {
        $this->authorize('update', $this->user);

        $validatedData = $this->validate();

        $this->user->update($validatedData);

        session()->flash('success', 'Password was updated successfully!');

        return redirect()->route('admin.settings', ['tab' => 'security']);


    }

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function render()
    {
        return view('livewire.general.security');
    }
}
