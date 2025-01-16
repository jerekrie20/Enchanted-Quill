<div>

    <form wire:submit.prevent="saveContent" class="p-2" id="blog-form">
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

    @script
    <script>
        initEditor()
        Livewire.hook('morphed', ({ el, component }) => {
            const editorElement = document.querySelector('#editor');
            if (editorElement) {
                initEditor();
            }
        })
    </script>
    @endscript
</div>
