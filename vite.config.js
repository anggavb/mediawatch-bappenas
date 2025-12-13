import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import vuetify from 'vite-plugin-vuetify';
import fonts from 'unplugin-fonts/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        vuetify(),
        fonts({
            provider: 'google',
            preconnect: true,
            fonts: [
                {
                    family: 'Roboto',
                    weights: ['400', '500', '700'],
                },
            ],
        }),
    ],
    resolve: {
        alias: {
            '@': '/resources/js',
            '@scss': '/resources/scss',
        },
    },
});
