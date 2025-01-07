<div>

    <div>
        <x-alerts.success/>
    </div>

    <h2>Change Personal Info</h2>

    <form wire:submit="save">
        @csrf

            <div class="flex flex-col justify-center mr-2 w-full">
                <div class="mt-2 m-auto">

                    {{-- Current or Uploaded Image --}}
                    @if($avatar)
                        {{-- Show uploaded image preview --}}
                        <img class="w-32 h-32 rounded-full" src="{{ $avatar->temporaryUrl() }}" alt="Image Preview" />
                    @elseif(!empty($currentAvatar))
                        {{-- Show current image --}}
                        <img class="w-32 h-32 rounded-full" src="{{ asset('avatars/' . $currentAvatar) }}" alt="{{$currentAvatar}}" />
                    @else
                        {{-- Default Placeholder Image --}}
                        <img class="w-32 h-32 rounded-full" src="https://images.pexels.com/photos/2690323/pexels-photo-2690323.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="Default Image" />
                    @endif
                </div>
                <p class="text-danger text-center italic">Image is cropped to 300x300, centered</p>
                <input wire:model.live="avatar" accept="image/*" class="block w-full mt-2 text-sm text-secondaryText rounded-lg cursor-pointer bg-text focus:outline-none" aria-describedby="user_avatar_help" id="user_avatar" type="file">
                <div>
                    @error('avatar') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="flex flex-col justify-center mt-3">
                    <x-forms.input-text name="name" wire:model.blur="name"/>
                    <x-forms.input-email name="email" wire:model.blur="email"/>
                </div>
            </div>

        <div class="mt-2 flex justify-center">
            <x-forms.input-submit/>
          <!--  <x-forms.input-reset/> -->
        </div>

    </form>
</div>
