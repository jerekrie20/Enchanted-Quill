<?php

namespace App\Livewire\Portal;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Settings extends Component
{
    use WithFileUploads;

    #[Layout('components.Layouts.portal')]
    #[Validate('required|string|max:255')]
    public $name = '';

    #[Validate('required|email|max:255')]
    public $email = '';

    #[Validate('nullable|string|max:500')]
    public $bio = '';

    #[Validate('nullable|image|max:2048')]
    public $profile_image;

    #[Validate('nullable|string|min:8')]
    public $current_password = '';

    #[Validate('nullable|string|min:8')]
    public $new_password = '';

    #[Validate('nullable|string|min:8|same:new_password')]
    public $new_password_confirmation = '';

    public function mount(): void
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->bio = $user->bio ?? '';
    }

    public function updateProfile(): void
    {
        $this->validate([
            'name' => 'required|string|max:255|blasp_check',
            'email' => 'required|email|max:255|unique:users,email,'.Auth::id(),
            'bio' => 'nullable|string|max:500|blasp_check',

        ]);

        $user = Auth::user();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->bio = $this->bio;
        $user->save();

        session()->flash('profile-updated', 'Profile updated successfully.');
    }

    public function updateProfileImage(): void
    {
        $this->validate([
            'profile_image' => 'required|image|max:2048',
        ]);

        $user = Auth::user();

        if ($user->profile_image) {
            \Storage::disk('public')->delete($user->profile_image);
        }

        $path = $this->profile_image->store('profile-images', 'public');
        $user->profile_image = $path;
        $user->save();

        $this->profile_image = null;
        session()->flash('image-updated', 'Profile image updated successfully.');
    }

    public function removeProfileImage(): void
    {
        $user = Auth::user();

        if ($user->profile_image) {
            \Storage::disk('public')->delete($user->profile_image);
            $user->profile_image = null;
            $user->save();
            session()->flash('image-removed', 'Profile image removed successfully.');
        }
    }

    public function updatePassword(): void
    {
        $this->validate([
            'current_password' => 'required|string',
            'new_password' => ['required', 'string', Password::min(8)],
            'new_password_confirmation' => 'required|string|same:new_password',
        ]);

        $user = Auth::user();

        if (! Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', 'The current password is incorrect.');

            return;
        }

        $user->password = Hash::make($this->new_password);
        $user->save();

        $this->current_password = '';
        $this->new_password = '';
        $this->new_password_confirmation = '';

        session()->flash('password-updated', 'Password updated successfully.');
    }

    public function render()
    {
        return view('livewire.portal.settings')
            ->title('Settings - Enchanted Quill');
    }
}
