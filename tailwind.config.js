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
                    blue: {
                        500: '#084baa',
                        600: '#052a54',
                        700: '#0b4c64',
                    },
                    teal: {
                        500: '#0d7d5a',
                        600: '#00796b',
                        700: '#06747f',
                    },
                    red: {
                        500: '#d45271',
                        600: '#ff6f61',
                        700: '#a52a2a',
                    },
                    yellow: {
                        500: '#f9a825',
                        600: '#be9135',
                        700: '#8c7853',
                    },
                    green: { // Adicionado para a cor verde
                        500: '#28a745', // Exemplo de verde, ajuste se tiver um específico
                        600: '#218838',
                    },
                    cyan: '#00c2cb',
                    purple: '#501564',
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
