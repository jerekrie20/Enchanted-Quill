<?php

namespace App\Livewire\General;

use App\Services\ImageService;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Personal extends Component
{
    use WithFileUploads;

    #[Validate]
    public $avatar;
    #[Validate]
    public $name;
    #[Validate]
    public $email;

    public $currentAvatar;

    #[Locked]
    public $user;


    protected function rules()
    {
        return[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', Rule::unique('users')->ignore($this->user->id), 'string', 'email:rfc', 'max:255'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg'],
        ];
    }

    public function save()
    {
        $this->authorize('update', $this->user);

        // Validate the rules defined above

        $validatedData = $this->validate();

        $imageService = new ImageService();


        if($this->avatar) {
            $current = '';
            if(!empty($this->user->avatar)){
                $current = $this->user->avatar;
            }
            $this->avatar = $imageService->saveImage($this->avatar, $current, 'avatars', 'user' );
        }else{
            $this->avatar = $this->currentAvatar;
        }

        // Remove null values to only update the submitted fields
        $filteredData = array_filter($validatedData);

        $filteredData['avatar'] = $this->avatar;

        // Update the user's data with only the changed fields
        $this->user->update($filteredData);

        $this->reset(['avatar']);

        session()->flash('success', 'Updated successfully!');

        return redirect()->route('admin.settings', ['tab' => 'profile']);
    }

    public function mount()
    {

        $this->user = auth()->user();
        if ($this->user) {
            $this->currentAvatar = $this->user->avatar;
            $this->name = $this->user->name;
            $this->email = $this->user->email;
        }

    }

    public function render()
    {
        return view('livewire.general.personal');
    }
}
