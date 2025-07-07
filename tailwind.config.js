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
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                plume: {
                    'azul-500': '#3B82F6',
                    blue: {
                        500: '#084baa',
                        600: '#052a54',
                        700: '#0b4c64',
                    },
                    teal: {
                        300: '#80e8d8',
                        400: '#40d1be',
                        500: '#0d7d5a',
                        600: '#00796b',
                        700: '#06747f',
                    },
                    red: {
                        300: '#f7b0c0',
                        400: '#f08096',
                        500: '#d45271',
                        600: '#ff6f61',
                        700: '#a52a2a',
                    },
                    yellow: {
                        300: '#fcdb9a',
                        400: '#fbc762',
                        500: '#f9a825',
                        600: '#be9135',
                        700: '#8c7853',
                    },
                    green: {
                        300: '#a6e8b4',
                        400: '#73d185',
                        500: '#28a745',
                        600: '#218838',
                        700: '#1e7e34',
                    },
                    cyan: {
                        300: '#80f2f5',
                        400: '#40e8ed',
                        500: '#00c2cb',
                        600: '#009ba2',
                        700: '#007479',
                    },
                    purple: {
                        300: '#c2a6d1',
                        400: '#a273b8',
                        500: '#501564',
                        600: '#3d104e',
                        700: '#2a0b37',
                    },
                    violet: {
                        300: '#d1a6e8',
                        400: '#b873d1',
                        500: '#9b40b8',
                        600: '#7e3396',
                        700: '#612674',
                    },
                    lime: {
                        300: '#e8f2a6',
                        400: '#d1ed73',
                        500: '#b8e840',
                        600: '#96c233',
                        700: '#749b26',
                    },
                    orange: {
                        300: '#f7d1a6',
                        400: '#f0b873',
                        500: '#e89b40',
                        600: '#c27e33',
                        700: '#9b6126',
                    },
                    gray: {
                        100: '#f3f4f6',
                        200: '#e5e7eb',
                        300: '#d1d5db',
                        400: '#9ca3af',
                        500: '#6b7280',
                        600: '#4b5563',
                        700: '#374151',
                        800: '#1f2937',
                        900: '#111827',
                    },
                    black: '#000000',
                    white: '#ffffff',
                    cream: '#fff9f0'
                }
            },
        },
    },

    plugins: [
        forms,
        typography,
    ],
};

