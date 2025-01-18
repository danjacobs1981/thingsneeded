import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                // 'resources/js/app.js',
                // 'resources/js/start.js',
                // 'resources/js/global.js',
                // 'resources/js/website/scripts.js',
                'resources/js/website/thing/script.js',
            ],
            refresh: true,
        }),
    ],
});
