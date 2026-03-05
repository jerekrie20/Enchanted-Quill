<div>
    <form wire:submit.prevent="saveContent" id="book-description-form" class="space-y-6">
        @csrf

        {{-- CKEditor Area --}}
        <div class="relative">
            <div class="mb-4">
                <label class="block text-sm font-heading text-text mb-2 flex items-center gap-2">
                    <svg class="w-4 h-4 text-primary" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14.17 3.25l5.58 5.58c.48.48.48 1.26 0 1.74L9.34 21H3.75v-5.59L14.17 3.25m0-1.41c-.37 0-.74.15-1.02.42L2 13.42V22h8.58L21.75 10.83c.56-.56.56-1.47 0-2.02l-5.58-5.58c-.29-.29-.67-.44-1.02-.44z"/>
                    </svg>
                    Describe Your Story
                </label>
            </div>

            <div class="bg-white dark:bg-navbg/40 border-2 border-text/10 focus-within:border-primary dark:focus-within:border-secondary rounded-sm transition-colors duration-300 overflow-hidden">
                <div id="book-description-editor" class="min-h-64 prose dark:prose-invert max-w-none p-4">
                    {!! $description !!}
                </div>
            </div>

            {{-- Decorative flourish --}}
            <div class="flex items-center gap-2 mt-4">
                <div class="h-px flex-1 bg-text/10"></div>
                <div class="flex gap-1">
                    <div class="w-1 h-1 rounded-full bg-primary/30"></div>
                    <div class="w-1.5 h-1.5 rounded-full bg-primary/50"></div>
                    <div class="w-1 h-1 rounded-full bg-primary/30"></div>
                </div>
                <div class="h-px flex-1 bg-text/10"></div>
            </div>
        </div>

        {{-- Hidden input bound to Livewire property --}}
        <input
            type="hidden"
            id="book-description-editor-content"
            name="description"
            wire:model="description"
        >

        <div class="flex justify-center pt-4">
            <x-forms.input-submit />
        </div>
    </form>

    @script
    <script>
        let bookDescriptionEditorInstance = null;

        function initBookDescriptionEditor() {
            console.log("Book description editor initializing");
            const editorElement = document.querySelector('#book-description-editor');
            const hiddenInput = document.querySelector('#book-description-editor-content');

            if (!editorElement) return;

            // Destroy existing editor
            if (bookDescriptionEditorInstance) {
                hiddenInput.value = bookDescriptionEditorInstance.getData();
                bookDescriptionEditorInstance.destroy()
                    .then(() => console.log("Book description editor destroyed"))
                    .catch(error => console.error("Error destroying book description editor:", error));
            }

            // Create new editor
            const config = window.getBookDescriptionEditorConfig();
            window.createEditor(editorElement, hiddenInput, config)
                .then(editor => {
                    bookDescriptionEditorInstance = editor;
                    console.log("Book description editor initialized successfully");
                })
                .catch(error => {
                    console.error("Book description editor initialization error:", error);
                });
        }

        initBookDescriptionEditor();

        Livewire.hook('morphed', ({ el, component }) => {
            const editorElement = document.querySelector('#book-description-editor');
            if (editorElement) {
                initBookDescriptionEditor();
            }
        });
    </script>
    @endscript
</div>
