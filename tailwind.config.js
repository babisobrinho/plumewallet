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

    safelist: [
        // emerald
        'bg-emerald-200',
        'dark:bg-emerald-700',
        'text-emerald-700',
        'dark:text-emerald-200',

        // gray
        'bg-gray-200',
        'dark:bg-gray-700',
        'text-gray-700',
        'dark:text-gray-200',

        // sky
        'bg-sky-200',
        'dark:bg-sky-700',
        'text-sky-700',
        'dark:text-sky-200',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms, typography],

    darkMode: 'class',
};
