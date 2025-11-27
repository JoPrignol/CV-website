// tailwind.config.ts

import { defineConfig } from 'tailwindcss';

export default defineConfig({
  content: [
    './resources/**/*.{js,vue,ts,jsx,tsx}',
    './resources/views/**/*.blade.php',
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Roboto Mono', 'ui-sans-serif', 'system-ui', 'sans-serif'],
      },
    },
  },
  plugins: [],
});
