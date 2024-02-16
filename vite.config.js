import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import { resolve } from "path";
import { readdirSync } from "fs";

// Function to get all files inside a directory
const getFilesInDirectory = (directory) => {
    return readdirSync(directory)
        .filter((file) => file.endsWith(".js")) // Filter only JavaScript files
        .map((file) => resolve(directory, file));
};

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                ...getFilesInDirectory("resources/js"),
            ],
            refresh: true,
        }),
    ],
});
