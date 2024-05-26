/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
      ],
  theme: {
    extend: {
        colors: {
            'g0': '#f0ffe5',
            'g1':'#d6ffda',
            'g2': '#afffb8',
            'g3': '#71ff82',
            'g4': '#2dfb43',
            'g5': '#02e51c',
            'g6': '#00bf12',
            'g7': '#009912',
            'g8': '#067514',
            'g9': '#085f14',
            'g10': '#003607',
        }
    },
  },
  plugins: [
    require('flowbite/plugin')
],
}



