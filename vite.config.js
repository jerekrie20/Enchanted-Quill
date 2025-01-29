import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    server: {
        cors: true, // Enables CORS
        hmr: {
            host: 'enchanted_quill.test', // Ensure WebSocket connections match your app domain
        }
    },

    plugins: [
        tailwindcss(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/ckeditor5.js'],
            refresh: true,
        }),
    ],
});
