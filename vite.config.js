import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import tailwind from '@tailwindcss/vite';
import Components from 'unplugin-vue-components/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.ts',
            ],
            publicDirectory: 'public',
            refresh: true,
        }),
        vue(),
        tailwind(),
        Components({
            dirs: ['resources/js/components'],
            extensions: ['vue'],
            deep: true,
        }),
    ],
    assetsInclude: ['**/*.glb', '**/*.gltf'],
    resolve: {
        alias: {
            '@': '/resources/',
        },
    },
    build: {
        outDir: 'public/build', 
        emptyOutDir: true, 
        manifest: 'manifest.json', 
    },
});