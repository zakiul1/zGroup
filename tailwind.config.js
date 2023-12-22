/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: ["./template-parts/*.{php,html,js}", "./*.{php,html,js}", "./node_modules/flowbite/**/*.js"],
  theme: {
    extend: {
      container: {
        center: true,
        padding: '1rem',
        screens: {
          sm: '640px',
          md: '768px',
          lg: '1024px',
          xl: '1140px', // Set your custom container width here
        },
      },
    },
  },

  plugins: [

  ]
}