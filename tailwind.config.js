import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Jost', ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                'sm': '0.938rem',
            },
        },
        screens: {
            sm: '640px',
            md: '768px',
            lg: '984px',
            xl: '1046px',
            '2xl': '1200px',
        },
        container: {
            center: true,
            // screens: {
            //     sm: '600px',
            //     md: '728px',
            //     lg: '984px',
            //     xl: '1046px',
            // },
            padding: {
                DEFAULT: '1rem',
                sm: '2rem',
                xl: '1rem',
                '2xl': '2rem',
            },
        },
    },
    plugins: [],
};
