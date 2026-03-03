import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        minify: 'esbuild',
        cssCodeSplit: true,
        cssMinify: true,
        rollupOptions: {
            output: {
                manualChunks: {
                    'vendor': ['axios'],
                },
                chunkFileNames: 'assets/chunk-[hash].js',
                entryFileNames: 'assets/[name]-[hash].js',
                assetFileNames: 'assets/[name]-[hash][extname]',
            },
        },
        reportCompressedSize: true,
        chunkSizeWarningLimit: 500,
    },
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
    optimizeDeps: {
        include: ['axios'],
    },
});
