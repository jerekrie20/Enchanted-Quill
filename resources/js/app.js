import './bootstrap';
import 'flowbite';

import {
    ClassicEditor,
    AutoImage,
    Autosave,
    BlockQuote,
    BlockToolbar,
    Bold,
    Essentials,
    Heading,
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
    Paragraph,
    PasteFromOffice,
    SimpleUploadAdapter,
    SpecialCharacters,
    Table,
    TableCaption,
    TableCellProperties,
    TableColumnResize,
    TableProperties,
    TableToolbar,
    TodoList,
    Underline
} from 'ckeditor5';

import 'ckeditor5/ckeditor5.css';

const licenseKey = import.meta.env.VITE_CKEDITOR_LICENSE_KEY;

function initEditor() {
    const editorElement = document.querySelector('#editor')
    const hiddenInput = document.querySelector('#editor-content')
    if (!editorElement) return // If there's no #editor in the DOM, do nothing

    ClassicEditor.create(editorElement, {
        plugins: [
            AutoImage,
            Autosave,
            BlockQuote,
            BlockToolbar,
            Bold,
            Essentials,
            Heading,
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
            Paragraph,
            PasteFromOffice,
            SimpleUploadAdapter,
            SpecialCharacters,
            Table,
            TableCaption,
            TableCellProperties,
            TableColumnResize,
            TableProperties,
            TableToolbar,
            TodoList,
            Underline
        ],
        blockToolbar: ['bold', 'italic', '|', 'link', 'insertImage', 'insertTable', '|', 'bulletedList', 'numberedList', 'outdent', 'indent'],

        toolbar: [
            'heading',
            '|',
            'bold',
            'italic',
            'underline',
            '|',
            'link',
            'insertImage',
            'mediaEmbed',
            'insertTable',
            'blockQuote',
            '|',
            'bulletedList',
            'numberedList',
            '|',
            'undo',
            'redo'
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
        },
        licenseKey
    })
        .then(editor => {
            // Keep hidden input in sync with CKEditor
            editor.model.document.on('change:data', () => {
                hiddenInput.value = editor.getData()
                hiddenInput.dispatchEvent(new Event('input')) // Let Livewire know
            })
        })
        .catch(error => {
            console.error('CKEditor init error:', error)
        })
}

// Initialize once DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    initEditor()
})

// Listen for the "blog-updated" Livewire 3 event from backend
window.addEventListener('blog-updated', event => {
    // event.detail is { message: "Blog updated successfully!" }
    const { message } = event.detail;
    // Show a quick alert (or a toast, or a fancy UI modal)
    alert(message);
});




