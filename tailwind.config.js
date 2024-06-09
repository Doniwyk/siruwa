/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",

        "./public/**/*.blade.php",
        "./public/**/*.js",
        "./public/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        screens: {
            sm: { min: "0px",max: "767px" },
            // => @media (min-width: 0px and max-width: 767px) { ... }

            md: { min: "768px" },
            // => @media (min-width: 768px and max-width: 1023px) { ... }

            lg: { min: "1024px" },
            // => @media (min-width: 1024px and max-width: 1279px) { ... }

            xl: { min: "1280px" },
            // => @media (min-width: 1280px and max-width: 1535px) { ... }

            "2xl": { min: "1536px" },
            // => @media (min-width: 1536px) { ... }
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
                "text-input-disabled": '#5E7C7F',
                "green-light": "#3D5658",
                "input-text": "#3D5658",
                "input-border": "#244447",
                outline: "#97A7A8",
            },
            backgroundImage: {
                bg_beranda: "url('../public/beranda.jpg')",
                bg_berita1: "url('../public/berita1.jpg')",
                bg_berita2: "url('../public/berita2.jpeg')",
            },
            transitionProperty: {
                'left': 'left',
              },
        },
    },
    plugins: [
        require('flowbite/plugin')
    ],
};
