import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Roboto', ...defaultTheme.fontFamily.sans], // Default for body text
                heading: ['Playfair Display', ...defaultTheme.fontFamily.serif], // For headings
            },
            colors: {
                bg: 'var(--color-bg)',
                text: 'var(--color-text)',
                primary: 'var(--color-primary)',
                secondary: 'var(--color-secondary)',
                accent: 'var(--color-accent)',
                navbg: 'var(--color-navbg)',
                secondaryText: 'var(--color-secondaryText)',
                secondarynavbg: 'var(--color-secondarynavbg)',
                danger: 'var(--color-danger)'
            },
            borderRadius: {
                // Custom border radii
                none: '0px',
                sm: '4px',
                DEFAULT: '8px',
                md: '12px',
                lg: '16px',
                full: '9999px',
            },
            keyframes: {
                slideIn: {
                    '0%': {
                        transform: 'translateX(100%)',
                        opacity: '0',
                    },
                    '100%': {
                        transform: 'translateX(0)',
                        opacity: '1',
                    },
                },
                slideOut: {
                    '0%': {
                        transform: 'translateX(0)',
                        opacity: '1',
                    },
                    '100%': {
                        transform: 'translateX(100%)',
                        opacity: '0',
                    },
                },
            },
            animation: {
                slideIn: 'slideIn 0.3s ease-out',
                slideOut: 'slideOut 0.3s ease-in',
            },

        },
    },
    plugins: [
        require('flowbite/plugin')
    ],
};
