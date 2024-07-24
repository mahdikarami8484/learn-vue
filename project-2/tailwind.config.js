/** @type {import('tailwindcss').Config} */

import { animation } from './src/assets/animations/animations'
import { keyframes } from './src/assets/keyframes/keyframes'


export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      keyframes,
      animation
    },
  },
  plugins: [],
}

