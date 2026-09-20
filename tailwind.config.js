/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}"
  ],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        sacred: {
          50: '#FDFBF7',
          100: '#FEF3C7',
          200: '#FDE68A',
          500: '#E06D14',
          600: '#C85A17',
          700: '#B45309',
          800: '#7A1C1C',
          900: '#5C1010',
          dark: '#111827',
          charcoal: '#1F2937'
        }
      },
      fontFamily: {
        divine: ['"Cinzel"', '"Rozha One"', '"Noto Sans Devanagari"', 'serif'],
        sans: ['"Outfit"', '"Inter"', 'system-ui', 'sans-serif'],
        devnag: ['"Noto Sans Devanagari"', 'serif']
      },
      borderRadius: {
        '3xl': '1.75rem',
        '4xl': '2.25rem'
      },
      boxShadow: {
        'sacred': '0 10px 30px -5px rgba(224, 109, 20, 0.25)',
        'sacred-lg': '0 20px 40px -10px rgba(122, 28, 28, 0.3)'
      }
    }
  },
  plugins: []
}
