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
                "main-bg": "#F1F0E9",
                main: "#244447",
                secondary: "#225157",
                third: "#A7EDB6",
                "danger-bg": "#EDA7A7",
                danger: "#4C2323",
            },
            backgroundImage: {
                bg_beranda: "url('../public/beranda.jpg')",
            },
        },
    },
    plugins: [],
};
