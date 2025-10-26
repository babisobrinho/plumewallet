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
        // amber
        'bg-amber-100',
        'bg-amber-200',
        'dark:bg-amber-800',
        'dark:bg-amber-900',
        'text-amber-800',
        'text-amber-900',
        'dark:text-amber-100',
        'dark:text-amber-200',
        
        // blue
        'bg-blue-100',
        'text-blue-800',
        'dark:bg-blue-900',
        'dark:text-blue-200',

        // cyan
        'bg-cyan-100',
        'text-cyan-800',
        'dark:bg-cyan-900',
        'dark:text-cyan-200',

        // emerald
        'bg-emerald-100',
        'bg-emerald-200',
        'dark:bg-emerald-700',
        'dark:bg-emerald-900',
        'text-emerald-700',
        'text-emerald-800',
        'dark:text-emerald-200',
        
        // gray
        'bg-gray-100',
        'bg-gray-200',
        'dark:bg-gray-700',
        'text-gray-700',
        'text-gray-800',
        'dark:text-gray-200',
        'dark:bg-gray-900',

        // green
        'bg-green-100',
        'text-green-800',
        'dark:bg-green-900',
        'dark:text-green-200',

        // indigo
        'bg-indigo-100',
        'text-indigo-800',
        'dark:bg-indigo-900',
        'dark:text-indigo-200',

        // red
        'bg-red-100',
        'text-red-800',
        'dark:bg-red-900',
        'dark:text-red-200',
        'bg-red-200',
        'text-red-900',
        'dark:bg-red-800',
        'dark:text-red-100',

        // rose
        'bg-rose-100',
        'text-rose-800',
        'dark:bg-rose-900',
        'dark:text-rose-200',

        // sky
        'bg-sky-200',
        'dark:bg-sky-700',
        'text-sky-700',
        'dark:text-sky-200',

        // orange
        'bg-orange-100',
        'text-orange-800',
        'dark:bg-orange-900',
        'dark:text-orange-200',

        // pink
        'bg-pink-100',
        'text-pink-800',
        'dark:bg-pink-900',
        'dark:text-pink-200',

        // FAQ Category classes
        'bg-gray-100',
        'text-gray-800',
        'dark:bg-gray-700',
        'dark:text-gray-300',

        // purple
        'bg-purple-100',
        'text-purple-800',
        'dark:bg-purple-900',
        'dark:text-purple-200',

        // teal
        'bg-teal-100',
        'text-teal-800',
        'dark:bg-teal-900',
        'dark:text-teal-200',

        // violet
        'bg-violet-100',
        'text-violet-800',
        'dark:bg-violet-900',
        'dark:text-violet-200',

        // yellow
        'bg-yellow-100',
        'bg-yellow-200',
        'dark:bg-yellow-800',
        'dark:bg-yellow-900',
        'text-yellow-800',
        'text-yellow-900',
        'dark:text-yellow-100',
        'dark:text-yellow-200',
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
