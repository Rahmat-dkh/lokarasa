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
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                outfit: ['Outfit', 'sans-serif'],
            },
            colors: {
                // P2MW Startup Palette - Optimized for Professionalism
                primary: {
                    DEFAULT: '#1e40af', // Deep Royal Blue
                    light: '#3b82f6',
                    dark: '#1e3a8a',
                },
                innovation: {
                    DEFAULT: '#f97316', // Synergy Orange
                    light: '#fb923c',
                    dark: '#ea580c',
                },
                growth: {
                    DEFAULT: '#22c55e', // Success Green
                    light: '#4ade80',
                    dark: '#16a34a',
                },
                neutral: {
                    light: '#F8FAFC', // Slate 50
                    dark: '#0f172a',  // Midnight Slate
                }
            },
            borderRadius: {
                '3xl': '1.5rem',
                '4xl': '2rem',
                '5xl': '2.5rem',
            }
        },
    },

    plugins: [forms],
};
