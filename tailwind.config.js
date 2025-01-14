import forms from '@tailwindcss/forms';
import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                'base-100': 'var(--base-100)',
                'base-200': 'var(--base-200)',
                'base-300': 'var(--base-300)',
                'base-400': 'var(--base-400)',
                'base-500': 'var(--base-500)',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [forms],
};
