<div>
    <h1 class="p-2">{{$blog ? 'Edit Blog' : 'Create Blog'}} </h1>

    <div>
        <x-alerts.success/>
    </div>

    <div class="mt-3">
        <p class="text-center text-sm">slug: {{$slug}}</p>
        <form wire:submit="saveDetails">
            <div class="flex flex-col justify-center">
                <div class="p-2">
                    <x-forms.input-text name="Title" wire:model.live="title"/>
                </div>
                <div class="p-2">
                    <x-forms.input-dropdown-checkbox name="Categories" modal="category" :data="$categories"/>
                </div>
                <div class="p-2">
                    <x-forms.input-select name="Status" :data="$statusData" wire:model.live.debounce.500ms="status"/>
                </div>
            </div>


            <input type="hidden" wire:model="slug">

            @if($status == 3)
                <div class="p-2">
                    <x-forms.input-date-time name="Publish Later" modal="publish_at" wire:model="publish_at"/>
                </div>
            @endif

            <div class="p-2 flex justify-center mt-4">
                <div class="p-2 w-32 h-32">
                    @if($currentImage)
                        <img class="w-full h-auto" src="{{ asset('blogs/' . $currentImage) }}" alt="{{$currentImage}}"/>
                    @else
                        <img class="w-full h-auto" src="https://placehold.co/300x300?text=Placeholder+Image&font=roboto" alt="Default blog image"/>
                    @endif

                </div>
                <div>
                    <x-forms.input-file wire:model="image" modal="image" name="Upload Thumbnail"/>
                </div>
            </div>

            <div class="flex justify-center mt-2 mb-2">
                <x-forms.input-submit/>
            </div>
        </form>
    </div>

    <!-- Child Component for Blog Content/CKEditor -->
    @if($blog)
        <div class="mt-6">
            @livewire('general.c-k-editor', ['blogId' => $blog->id])
        </div>
    @endif
</div>


