<div>
    <form wire:submit.prevent="saveContent" id="blog-form" class="space-y-6">
        @csrf

        {{-- CKEditor Area --}}
        <div class="relative">
            <div class="mb-4">
                <label class="block text-sm font-heading text-text mb-2 flex items-center gap-2">
                    <svg class="w-4 h-4 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Compose Your Tale
                </label>
            </div>

            <div class="bg-white dark:bg-navbg/40 border-2 border-text/10 focus-within:border-secondary dark:focus-within:border-primary rounded-sm transition-colors duration-300 overflow-hidden">
                <div id="editor" class="min-h-96 prose dark:prose-invert max-w-none p-4">
                    {!! $content !!}
                </div>
            </div>

            {{-- Decorative flourish --}}
            <div class="flex items-center gap-2 mt-4">
                <div class="h-px flex-1 bg-text/10"></div>
                <div class="flex gap-1">
                    <div class="w-1 h-1 rounded-full bg-secondary/30"></div>
                    <div class="w-1.5 h-1.5 rounded-full bg-secondary/50"></div>
                    <div class="w-1 h-1 rounded-full bg-secondary/30"></div>
                </div>
                <div class="h-px flex-1 bg-text/10"></div>
            </div>
        </div>

        {{-- Hidden input bound to Livewire property --}}
        <input
            type="hidden"
            id="editor-content"
            name="content"
            wire:model="content"
        >

        <div class="flex justify-center pt-4">
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
