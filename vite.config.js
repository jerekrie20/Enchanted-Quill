import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    server: {
        cors: true,
        strictPort: true,
        port: 5173,
        host: '0.0.0.0', // Bind to all interfaces
        hmr: {
            host: 'enchanted-quill.test', // Use lowercase to match browser logs
            protocol: 'wss',
            port: 5173,
        },
        watch: {
            usePolling: true,
        },
    },

    plugins: [
        tailwindcss(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/ckeditor5.js'],
            refresh: true,
        }),
    ],
});
