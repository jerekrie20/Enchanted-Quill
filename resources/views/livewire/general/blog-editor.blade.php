<div>
    <h1 class="p-2">Edit Blogs</h1>

    <div>
        <x-alerts.success/>
    </div>

    <div>
        <form wire:submit.prevent="save" class="p-2" id="blog-form">
            @csrf

            <!-- This is the CKEditor area, ignore by Livewire -->
            <div id="editor" class="m-h-96" wire:ignore>
                {!! $content !!}
            </div>

            <!-- Hidden input bound to Livewire property -->
            <input
                type="hidden"
                id="editor-content"
                name="content"
                wire:model.defer="content"
            >

            <div class="flex justify-center mt-2">
                <x-forms.input-submit />
            </div>
        </form>
    </div>
</div>
