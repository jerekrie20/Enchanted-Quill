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

// Common base configuration
const baseConfig = {
    licenseKey: 'GPL',
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
    table: {
        contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties']
    }
};

// Full plugin list for rich content
const fullPlugins = [
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
];

// Simplified plugins for book descriptions
const descriptionPlugins = [
    Autoformat,
    Bold,
    Essentials,
    Heading,
    Italic,
    Link,
    List,
    Paragraph,
    PasteFromOffice,
    RemoveFormat,
    Strikethrough,
    Underline
];

// Writing-focused plugins for chapters
const chapterPlugins = [
    Alignment,
    Autoformat,
    AutoImage,
    Autosave,
    BlockQuote,
    Bold,
    Code,
    Essentials,
    FindAndReplace,
    FontFamily,
    FontSize,
    Heading,
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
    PageBreak,
    Paragraph,
    PasteFromOffice,
    RemoveFormat,
    SimpleUploadAdapter,
    SpecialCharacters,
    SpecialCharactersEssentials,
    Strikethrough,
    Subscript,
    Superscript,
    Underline
];

// Make functions available globally
window.getChronicleEditorConfig = getChronicleEditorConfig;
window.getBookDescriptionEditorConfig = getBookDescriptionEditorConfig;
window.getChapterEditorConfig = getChapterEditorConfig;
window.createEditor = createEditor;

// Chronicle (Blog) Editor Configuration - Full featured for rich blog posts
function getChronicleEditorConfig() {
    return {
        ...baseConfig,
        plugins: fullPlugins,
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
        placeholder: 'Begin your chronicle upon the enchanted parchment...',
        simpleUpload: {
            uploadUrl: '/upload',
            maxFileSize: 50000000,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        }
    };
}

// Book Description Editor Configuration - Simplified for book summaries
function getBookDescriptionEditorConfig() {
    return {
        ...baseConfig,
        plugins: descriptionPlugins,
        toolbar: [
            'heading',
            '|',
            'bold',
            'italic',
            'underline',
            'strikethrough',
            'removeFormat',
            '|',
            'link',
            '|',
            'bulletedList',
            'numberedList'
        ],
        placeholder: 'Describe your story here...'
    };
}

// Chapter Editor Configuration - Optimized for long-form writing
function getChapterEditorConfig() {
    return {
        ...baseConfig,
        plugins: chapterPlugins,
        toolbar: [
            'findAndReplace',
            '|',
            'heading',
            '|',
            'fontSize',
            'fontFamily',
            '|',
            'bold',
            'italic',
            'underline',
            'strikethrough',
            'subscript',
            'superscript',
            'removeFormat',
            '|',
            'horizontalLine',
            'pageBreak',
            'link',
            'insertImage',
            'blockQuote',
            '|',
            'alignment',
            '|',
            'bulletedList',
            'numberedList',
            'outdent',
            'indent',
            '|',
            'specialCharacters'
        ],
        placeholder: 'Inscribe your chapter here...',
        simpleUpload: {
            uploadUrl: '/upload',
            maxFileSize: 50000000,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        }
    };
}

// Helper function to find removed images
function findRemovedImages(previousContent, currentContent) {
    const parser = new DOMParser();

    const previousDoc = parser.parseFromString(previousContent, 'text/html');
    const currentDoc = parser.parseFromString(currentContent, 'text/html');

    const previousImages = Array.from(previousDoc.querySelectorAll('img'))
        .map(img => img.getAttribute('src'))
        .filter(src => src !== null && src.trim() !== '');
    const currentImages = Array.from(currentDoc.querySelectorAll('img'))
        .map(img => img.getAttribute('src'))
        .filter(src => src !== null && src.trim() !== '');

    return previousImages.filter(src => !currentImages.includes(src));
}

// Function to send a request to the server to delete images
function removeImagesFromServer(removedImages) {
    removedImages.forEach(imageUrl => {
        const imagePath = imageUrl.replace(window.location.origin + '/storage/', '');

        axios.post('/delete-image', { imagePath })
            .then(response => {
                // Image removed successfully
            })
            .catch(error => {
                console.error('Error removing image on server:', error);
            });
    });
}

// Create and initialize an editor instance with change tracking
function createEditor(editorElement, hiddenInput, config) {
    let editorInstance = null;
    let previousContent = '';

    if (!editorElement) {
        console.error('Editor element not found');
        return null;
    }

    return ClassicEditor.create(editorElement, config)
        .then(editor => {
            editorInstance = editor;

            if (hiddenInput.value) {
                editor.setData(hiddenInput.value);
                previousContent = hiddenInput.value;
            } else {
                previousContent = editor.getData();
            }

            // Sync CKEditor with hidden input value
            editor.model.document.on('change:data', () => {
                const currentContent = editor.getData();

                // Detect removed images
                const removedImages = findRemovedImages(previousContent, currentContent);

                if (removedImages.length > 0) {
                    removeImagesFromServer(removedImages);
                }

                // Update previous content and hidden input
                hiddenInput.value = currentContent;
                hiddenInput.dispatchEvent(new Event('input')); // Notify Livewire
                previousContent = currentContent;
            });

            return editor;
        })
        .catch(error => {
            console.error('CKEditor init error:', error);
            throw error;
        });
}
