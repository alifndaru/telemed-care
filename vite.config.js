import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        host: "0.0.0.0", // Allows external access to Vite from Docker
        port: 5173, // Ensures Vite runs on the correct port
        hmr: {
            host: "localhost", // Hot Module Reload host for localhost access
        },
    },
    build: {
        rollupOptions: {
            external: ["alpinejs"],
        },
    },
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
});
