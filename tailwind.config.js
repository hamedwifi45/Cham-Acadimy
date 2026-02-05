import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
        primary: {
          500: '#2563EB',
          600: '#1D4ED8',
        },
        secondary: '#0F172A',
        background: '#F8FAFC',
        dark: '#0F172A',
        text: {
          primary: '#1E293B',
          secondary: '#64748B',
        },
        success: '#10B981',
        warning: '#F59E0B',
        error: '#EF4444',
      },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms, typography],
};
