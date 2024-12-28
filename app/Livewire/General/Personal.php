<?php

namespace App\Livewire\General;

use App\Services\ImageService;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Personal extends Component
{
    use WithFileUploads;

    #[Validate]
    public $avatar;

    public $currentAvatar;

    public $user;

    protected function rules()
    {
        return[
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg'],
        ];
    }

    public function resetButton(): void
    {
      $this->reset();
    }

    public function save()
    {
        $this->validate();

        $imageService = new ImageService();


        if($this->avatar) {
            $current = '';
            if(!empty($this->user->avatar)){
                $current = $this->user->avatar;
            }
            $this->avatar = $imageService->saveImage($this->avatar, $current, 'avatars', 'user' );
        }

        $this->user->update([
           'avatar' => $this->avatar
        ]);

        $this->reset();

        session()->flash('success', 'Updated successfully!');
    }

    public function mount()
    {
        $this->user = auth()->user();

    }

    public function render()
    {
        return view('livewire.general.personal',[
            $this->currentAvatar = auth()->user()->avatar
        ]);
    }
}
