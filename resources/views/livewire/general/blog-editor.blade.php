<div>
    <h1 class="p-2">Edit Blogs</h1>

    <div>
        <x-alerts.success/>
    </div>

    <div>
        <form wire:submit="saveDetails">
            <div class="flex justify-center">
                <div class="p-2"><x-forms.input-text name="Title" wire:model="title"/></div>
                <div class="p-2"><x-forms.input-select name="Status" :data="$statusData" wire:model.live.debounce.500ms="status"/></div>
            </div>

            @if($status == 3)
                <div class="p-2"><x-forms.input-date-time name="Publish Later" wire:model="publish_at"/></div>
            @endif
        </form>
    </div>

    <div>
        <form wire:submit.prevent="saveEditor" class="p-2" id="blog-form">
            @csrf

            <!-- This is the CKEditor area, ignore by Livewire -->
            <div >
                <div id="editor" class="m-h-96">
                    {!! $content !!}
                </div>

            </div>

            <!-- Hidden input bound to Livewire property -->
            <input
                type="hidden"
                id="editor-content"
                name="content"
                wire:model="content"
            >

            <div class="flex justify-center mt-2">
                <x-forms.input-submit />
            </div>
        </form>
    </div>
</div>


@script
<script>
    initEditor()
    Livewire.hook('morphed',  ({ el, component }) => {
        initEditor()
    })
</script>
@endscript
