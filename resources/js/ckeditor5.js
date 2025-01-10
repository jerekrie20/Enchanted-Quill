import {
    Alignment,
    Autoformat,
    AutoImage,
    Autosave,
    BlockQuote,
    Bold,
    ClassicEditor,
    Code,
    Essentials,
    FindAndReplace,
    FontBackgroundColor,
    FontColor,
    FontFamily,
    FontSize,
    Heading,
    Highlight,
    HorizontalLine,
    ImageBlock,
    ImageCaption,
    ImageInline,
    ImageInsert,
    ImageInsertViaUrl,
    ImageResize,
    ImageStyle,
    ImageTextAlternative,
    ImageToolbar,
    ImageUpload,
    Indent,
    IndentBlock,
    Italic,
    Link,
    LinkImage,
    List,
    ListProperties,
    MediaEmbed,
    PageBreak,
    Paragraph,
    PasteFromOffice,
    RemoveFormat,
    SimpleUploadAdapter,
    SpecialCharacters,
    SpecialCharactersArrows,
    SpecialCharactersCurrency,
    SpecialCharactersEssentials,
    SpecialCharactersLatin,
    SpecialCharactersMathematical,
    SpecialCharactersText,
    Strikethrough,
    Subscript,
    Superscript,
    Table,
    TableCaption,
    TableCellProperties,
    TableColumnResize,
    TableProperties,
    TableToolbar,
    TextTransformation,
    Title,
    TodoList,
    Underline,
    WordCount
} from 'ckeditor5';

import 'ckeditor5/ckeditor5.css';

let classicEditorInstance = null;

function initEditor() {
    console.log("editor is running")
    const editorElement = document.querySelector('#editor');
    const hiddenInput = document.querySelector('#editor-content');

    if (!editorElement) return; // If there's no #editor in the DOM, do nothing

    // Destroy the existing editor (if it exists)
    if (classicEditorInstance) {
        // Save the editor content to the hiddenInput BEFORE destroying
        hiddenInput.value = classicEditorInstance.getData();
      //  console.log("Saving editor content before destroying:", currentContent);

        classicEditorInstance.destroy()
            .then(() => {
                console.log("Editor destroyed successfully");
            })
            .catch((error) => {
                console.error("Error while destroying the editor:", error);
            });
    }

    // Create a new editor instance
    ClassicEditor.create(editorElement, {
        plugins: [
            Alignment,
            Autoformat,
            AutoImage,
            Autosave,
            BlockQuote,
            Bold,
            Code,
            Essentials,
            FindAndReplace,
            FontBackgroundColor,
            FontColor,
            FontFamily,
            FontSize,
            Heading,
            Highlight,
            HorizontalLine,
            ImageBlock,
            ImageCaption,
            ImageInline,
            ImageInsert,
            ImageInsertViaUrl,
            ImageResize,
            ImageStyle,
            ImageTextAlternative,
            ImageToolbar,
            ImageUpload,
            Indent,
            IndentBlock,
            Italic,
            Link,
            LinkImage,
            List,
            ListProperties,
            MediaEmbed,
            PageBreak,
            Paragraph,
            PasteFromOffice,
            RemoveFormat,
            SimpleUploadAdapter,
            SpecialCharacters,
            SpecialCharactersArrows,
            SpecialCharactersCurrency,
            SpecialCharactersEssentials,
            SpecialCharactersLatin,
            SpecialCharactersMathematical,
            SpecialCharactersText,
            Strikethrough,
            Subscript,
            Superscript,
            Table,
            TableCaption,
            TableCellProperties,
            TableColumnResize,
            TableProperties,
            TableToolbar,
            TextTransformation,
            Title,
            TodoList,
            Underline,
            WordCount
        ],

        toolbar: [
            'findAndReplace',
            '|',
            'heading',
            '|',
            'fontSize',
            'fontFamily',
            'fontColor',
            'fontBackgroundColor',
            '|',
            'bold',
            'italic',
            'underline',
            'strikethrough',
            'subscript',
            'superscript',
            'code',
            'removeFormat',
            '|',
            'specialCharacters',
            'horizontalLine',
            'pageBreak',
            'link',
            'insertImage',
            'mediaEmbed',
            'insertTable',
            'highlight',
            'blockQuote',
            '|',
            'alignment',
            '|',
            'bulletedList',
            'numberedList',
            'todoList',
            'outdent',
            'indent'
        ],
        image: {
            toolbar: [
                'toggleImageCaption',
                'imageTextAlternative',
                '|',
                'imageStyle:inline',
                'imageStyle:wrapText',
                'imageStyle:breakText',
                '|',
                'resizeImage'
            ]
        },
        link: {
            addTargetToExternalLinks: true,
            defaultProtocol: 'https://',
            decorators: {
                toggleDownloadable: {
                    mode: 'manual',
                    label: 'Downloadable',
                    attributes: {
                        download: 'file'
                    }
                }
            }
        },
        licenseKey: 'GPL',
        list: {
            properties: {
                styles: true,
                startIndex: true,
                reversed: true
            }
        },
        placeholder: 'Type or paste your content here!',
        table: {
            contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties']
        },
        simpleUpload: {
            uploadUrl: '/upload',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        }
    })
        .then(editor => {
            classicEditorInstance = editor; // Store editor instance globally

          //  console.log('Hidden input initial value:', hiddenInput.value);

            // Populate the editor with the content from the hidden input (Livewire-bound)
            if (hiddenInput.value) {
                editor.setData(hiddenInput.value);
                //console.log('Editor initialized with data:', editor.getData());
            } else {
                console.warn('No initial content in hiddenInput.value.');
            }

            // Sync CKEditor with hidden input value
            editor.model.document.on('change:data', () => {
                hiddenInput.value = editor.getData();
                hiddenInput.dispatchEvent(new Event('input')); // Notify Livewire
            });

           // console.log('CKEditor instance content:', editor.getData());
        })
        .catch(error => {
            console.error('CKEditor init error:', error);
        });
}

// Attach the function to the global scope:
window.initEditor = initEditor;

