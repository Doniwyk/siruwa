/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                main: "#244447",
                secondary: "#225157",
            },
            backgroundImage: {
                bg_beranda: "url('../public/beranda.jpg')",
                bg_berita1: "url('../public/berita1.jpg')",
                bg_berita2: "url('../public/berita2.jpeg')",
            },
        },
    },
    plugins: [],
};
