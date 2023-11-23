import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
//define target host and port
export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    build: {
        assetsInlineLimit: 0,
    },
});
