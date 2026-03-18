import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import { viteStaticCopy } from 'vite-plugin-static-copy';

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        viteStaticCopy({
            targets: [
                {
                    src: 'node_modules/tinymce/skins',
                    dest: 'tinymce',
                },
            ],
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
                    'tinymce': ['tinymce'],
                },
                chunkFileNames: 'assets/chunk-[hash].js',
                entryFileNames: 'assets/[name]-[hash].js',
                assetFileNames: 'assets/[name]-[hash][extname]',
            },
        },
        reportCompressedSize: true,
        chunkSizeWarningLimit: 1000,
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