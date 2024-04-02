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
        'nav':'#0F4C52',
        'bg_color': 'F1F0E9',
      },
      backgroundImage: {
        'bg_beranda': "url('../public/beranda.jpg')",
      }
    },
  },
  plugins: [],
}