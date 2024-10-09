import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import {svelte} from "@sveltejs/vite-plugin-svelte";
import { vitePreprocess } from "@sveltejs/vite-plugin-svelte";


const materialize_files = [
    './resources/assets/vendor/scss/rtl/core.scss',
    './resources/assets/vendor/scss/rtl/core-dark.scss',
    './resources/assets/vendor/scss/rtl/theme-bordered-dark.scss',
    './resources/assets/vendor/scss/rtl/theme-bordered.scss',
    './resources/assets/vendor/scss/rtl/theme-default-dark.scss',
    './resources/assets/vendor/scss/rtl/theme-default.scss',
    './resources/assets/vendor/scss/rtl/theme-raspberry-dark.scss',
    './resources/assets/vendor/scss/rtl/theme-raspberry.scss',
    './resources/assets/vendor/scss/rtl/theme-semi-dark.scss',
    './resources/assets/vendor/scss/rtl/theme-semi-dark-dark.scss',
    './resources/assets/vendor/scss/core.scss',
    './resources/assets/vendor/scss/core-dark.scss',
    './resources/assets/vendor/scss/theme-bordered-dark.scss',
    './resources/assets/vendor/scss/theme-bordered.scss',
    './resources/assets/vendor/scss/theme-default-dark.scss',
    './resources/assets/vendor/scss/theme-default.scss',
    './resources/assets/vendor/scss/theme-raspberry-dark.scss',
    './resources/assets/vendor/scss/theme-raspberry.scss',
    './resources/assets/vendor/scss/theme-semi-dark.scss',
    './resources/assets/vendor/scss/theme-semi-dark-dark.scss',
    // './resources/assets/css/demo.css',


    './resources/assets/vendor/js/helpers.js',
    './resources/assets/js/config.js',

    // page
    './resources/assets/vendor/scss/pages/page-auth.scss',
    './resources/assets/vendor/scss/pages/page-auth.scss',

    // dashboard page
    './resources/assets/vendor/libs/apex-charts/apexcharts.js',
    './resources/assets/vendor/libs/swiper/swiper.js'
];

const frontpage = [
    './resources/js/frontpage.js',
    './resources/css/frontpage.pcss'
];

export default defineConfig({
    plugins: [
        laravel({
            input: [
                './resources/sass/app.scss',
                './resources/sass/font-awesome/css/all.min.css',
                './resources/js/app.js',
                ...materialize_files,
                ...frontpage,
            ],
            refresh: true,
        }),
        svelte({
            preprocess: [vitePreprocess({ postcss: true })],
            alias:{
                "@/*": "./resources/js/*",
                '$lib': `/resources/js/lib`,
                '$lib/*': `/resources/js/lib/*`,
                'utils': `/resources/js/utils`,
                'utils/*': `/resources/js/utils/*`,
                'stores': `/resources/js/stores`,
                'stores/*': `/resources/js/stores/*`,
                "@img": "/resources/assets/img",
                "@img/*": "/resources/assets/img/*",
            }
        }),
    ],
    server: {
        watch: {
          ignored: ["**/storage/**", '**/public/storage/**/*'],
        },
        usePolling: true,
    },
    esbuild: {
        legalComments: "none",
    },
    resolve:{
        alias: {
            "@/*": "./resources/js/*",
            '$lib': `/resources/js/lib`,
            '$lib/*': `/resources/js/lib/*`,
            'utils': `/resources/js/utils`,
            'utils/*': `/resources/js/utils/*`,
            'stores': `/resources/js/stores`,
            'stores/*': `/resources/js/stores/*`,
            "@img": "/resources/assets/img",
            "@img/*": "/resources/assets/img/*",
        },
        extensions: [".js", ".svelte", ".json", '.ts', '.tsx'],
    }
});
