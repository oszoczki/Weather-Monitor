import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/scss/app.scss',
                'resources/js/app.js',
                'resources/js/select2-init.js',
                'resources/js/temperature-chart.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
