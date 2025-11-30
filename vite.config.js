import vue from '@vitejs/plugin-vue';
import AutoImport from 'unplugin-auto-import/vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

import { defineConfig } from 'vite';
// import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js'],
            refresh: true,
        }),
        vue(),
        AutoImport({
            imports: ['vue', 'vue-router',],
            // dts: 'resources/js/auto-imports.d.ts',
        }),
        // tailwindcss(),
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, './resources/js'),
            '@css': '/resources/css',
            '@assets': '/public/assets',
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
});
