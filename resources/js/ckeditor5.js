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
    console.log("editor is running");
    const editorElement = document.querySelector('#editor');
    const hiddenInput = document.querySelector('#editor-content');

    let previousContent; // Track the previous editor content for detecting changes

    if (!editorElement) return; // If there's no #editor in the DOM, do nothing

    // Destroy the existing editor (if it exists)
    if (classicEditorInstance) {
        // Save the editor content to the hiddenInput BEFORE destroying
        hiddenInput.value = classicEditorInstance.getData();

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

            if (hiddenInput.value) {
                editor.setData(hiddenInput.value);
                previousContent = hiddenInput.value;
            } else {
                console.warn('No initial content in hiddenInput.value.');
                previousContent = editor.getData(); //
            }

            // Sync CKEditor with hidden input value
            editor.model.document.on('change:data', () => {
                const currentContent = editor.getData();

               // console.log('Current Content:', currentContent); // Log current editor content
              //  console.log('Previous Content:', previousContent); // Log previous editor content

                // Detect removed images
                const removedImages = findRemovedImages(previousContent, currentContent);
                //console.log('Detected removed images:', removedImages); // Check the output of findRemovedImages

                if (removedImages.length > 0) {
                   // console.log('Calling removeImagesFromServer with:', removedImages); // Add log here
                    removeImagesFromServer(removedImages);
                }

                // Update previous content and hidden input
                hiddenInput.value = currentContent;
                hiddenInput.dispatchEvent(new Event('input')); // Notify Livewire
                previousContent = currentContent; // Track changes
            });
        })
        .catch(error => {
            console.error('CKEditor init error:', error);
        });
}

// Helper function to find removed images
function findRemovedImages(previousContent, currentContent) {
   // console.log('finding remove images');
    const parser = new DOMParser();

    // Parse previous and current content into DOM
    const previousDoc = parser.parseFromString(previousContent, 'text/html');
    const currentDoc = parser.parseFromString(currentContent, 'text/html');

    // Get all image sources, filter out invalid/null src attributes
    const previousImages = Array.from(previousDoc.querySelectorAll('img'))
        .map(img => img.getAttribute('src'))
        .filter(src => src !== null && src.trim() !== '');
    const currentImages = Array.from(currentDoc.querySelectorAll('img'))
        .map(img => img.getAttribute('src'))
        .filter(src => src !== null && src.trim() !== '');

   // console.log('Previous Images:', previousImages); // Log valid previous images
   // console.log('Current Images:', currentImages); // Log valid current images

    // Detect removed images (present in `previousImages` but not in `currentImages`)
    // console.log('Removed Images:', removedImages); // Log detected removed images

    return previousImages.filter(src => !currentImages.includes(src));
}

// Function to send a request to the server to delete images
function removeImagesFromServer(removedImages) {
   // console.log('Image being removed')

    removedImages.forEach(imageUrl => {
        // Extract image name/path from URL if necessary
        const imagePath = imageUrl.replace(window.location.origin + '/storage/', '');

        // Send an AJAX request to delete the image from the server
        axios.post('/delete-image', { imagePath })
            .then(response => {
               // console.log('Image removed from server:', imagePath);
            })
            .catch(error => {
                console.error('Error removing image on server:', error);
            });
    });
}

// Attach the function to the global scope
window.initEditor = initEditor;


