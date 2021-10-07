const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
        zIndex: {
            '0': 0,
            '10': 10,
            '20': 20,
            '25': 25,
            '30': 30,
            '40': 40,
            '50': 50,
            '75': 75,
            '100': 100,
            'auto': 'auto',
        }
    },

    variants: {
        extend: {
            opacity: ['disabled'],
            visibility: ['hover', 'focus', 'group-hover', 'group-focus'],
            display: ['responsive', 'hover', 'focus', 'group-hover', 'group-focus'],
            float: ['hover', 'focus', 'group-hover', 'group-focus'],
            inset: ['hover', 'focus', 'group-hover', 'group-focus'],
            width: ['responsive', 'hover', 'focus', 'group-hover', 'group-focus'],
            wordBreak: ['responsive', 'hover', 'focus', 'group-hover', 'group-focus'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
