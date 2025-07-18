import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                'resources/js/SweetAlert/Swal.js',
                'resources/js/Splide/CategorySplide.js'
            ],
            refresh: true,
        }),
    ],
});
