/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        screens: {
            "2xl": {
                min: "1280px",
                max: "1535px",
            },
            xl: {
                min: "1024px",
                max: "1279px",
            },
            lg: {
                min: "768px",
                max: "1023px",
            },
            md: {
                min: "640px",
                max: "767px",
            },
            sm: {
                min: "0px",
                max: "639px",
            },
        },
        extend: {
            colors: {
                "main-bg": "#F1F0E9",
                main: "#244447",
                secondary: "#225157",
                third: "#A7EDB6",
                fourth: "#DBE4E5",
                "danger-bg": "#EDA7A7",
                danger: "#4C2323",
                "input-disabled": "#DDE9EA",
                "green-light": "#3D5658",
                "input-text": "#3D5658",
                "input-border": "#EBE43E",
                outline: "#97A7A8",
            },
            backgroundImage: {
                bg_beranda: "url('../public/beranda.jpg')",
                bg_berita1: "url('../public/berita1.jpg')",
                bg_berita2: "url('../public/berita2.jpeg')",
            },
        },
        screens: {
            sm: "640px",

            md: "768px",

            lg: "1024px",

            xl: "1280px",

            "2xl": "1536px",
        },
    },
    plugins: [],
};
