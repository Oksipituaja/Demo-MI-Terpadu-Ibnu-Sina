/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './app/**/*.{php,html,js}',
    './resources/views/**/*.{php,html,js}',
    './resources/js/**/*.{ts,tsx,js,jsx}',
  ],
  theme: {
    extend: {
      colors: {
        // Skema 60-30-10: Dominan (60%) Off-White
        'neutral-bg': '#FAFAFA',

        // Skema 60-30-10: Sekunder (30%) Navy & Islamic Green
        'primary': '#1E40AF',      // Navy Blue - Profesional & Terpercaya
        'primary-light': '#3B82F6',
        'primary-dark': '#1E3A8A',
        'secondary': '#15803D',    // Islamic Green - Identitas Madrasah
        'secondary-light': '#22C55E',
        'secondary-dark': '#166534',

        // Skema 60-30-10: Aksen (10%) Gold Yellow
        'accent': '#FACC15',       // Gold Yellow - CTA & Attention
        'accent-light': '#FCD34D',
        'accent-dark': '#EAB308',

        // Neutral untuk text & borders
        'soft-black': '#1F2937',
        'soft-gray': '#6B7280',
      },
    },
  },
  plugins: [],
}

