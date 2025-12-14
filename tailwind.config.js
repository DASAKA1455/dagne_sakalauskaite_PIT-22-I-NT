import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                primary: '#000000ff',
                secondary: '#adaba2ff',
                accent: '#3f3949ff',
                background: '#ffffffff',
                surface: '#3f3949ff',
                textPrimary: '#e0e0e0',
                textSecondary: '#a0a0a0',
            },
            fontFamily: {
                sans: ['Orbitron', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
