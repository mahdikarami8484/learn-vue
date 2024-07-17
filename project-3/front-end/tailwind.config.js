
/** @type {import('tailwindcss').Config} */

import animations from './src/assets/animations/animations'
import keyframes from './src/assets/animations/keyframes'

export default {
  content: ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}'],
  darkMode: true,
  theme: {
    extend: {
      colors: {
        'color-1': '#9290C3',
        'color-2': '#535C91',
        'color-3': '#1B1A55',
        'color-4': '#070F2B'
      }, 
      keyframes,
      animation: animations
    },
  },
  plugins: [],
}

