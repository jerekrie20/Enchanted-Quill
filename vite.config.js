import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        cors: true, // Enables CORS
        hmr: {
            host: 'enchanted_quill.test', // Ensure WebSocket connections match your app domain
        }
    },

    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/ckeditor5.js'],
            refresh: true,
        }),
    ],
});
