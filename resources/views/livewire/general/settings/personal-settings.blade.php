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
                <div class="relative group mt-2">
                    <input wire:model.live="avatar" accept="image/*" class="block w-full text-sm text-white rounded-lg cursor-pointer bg-text focus:outline-hidden" aria-describedby="user_avatar_help" id="user_avatar" type="file">
                    <div wire:loading wire:target="avatar" class="absolute inset-0 bg-bg/80 backdrop-blur-sm flex items-center justify-center rounded-lg border-2 border-primary/30">
                        <span class="text-sm font-serif text-primary animate-pulse flex items-center gap-2">
                            <i class="fa-solid fa-spinner fa-spin"></i>
                            Inscribing portrait...
                        </span>
                    </div>
                </div>
                <div>
                    @error('avatar') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="flex flex-col justify-center mt-3">
                    <x-forms.input-text name="name" wire:model.blur-sm="name"/>
                    <x-forms.input-email name="email" wire:model.blur-sm="email"/>
                </div>
            </div>

        <div class="mt-2 flex justify-center">
            <x-forms.input-submit/>
          <!--  <x-forms.input-reset/> -->
        </div>

    </form>
</div>
