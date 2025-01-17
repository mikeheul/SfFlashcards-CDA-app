/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      colors: {
        blue: "#163047",
        gray: "#bbc2c4"
      }
    },
  },
  plugins: [],
}
