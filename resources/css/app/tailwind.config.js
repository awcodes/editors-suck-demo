import theme from "tailwindcss/defaultTheme";
import colors from "tailwindcss/colors"

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './resources/views/**/*.blade.php',
        './vendor/awcodes/typist/resources/views/**/*.blade.php',
        './vendor/awcodes/dimmer/resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            colors: {
                info: colors.cyan,
                success: colors.emerald,
                warning: colors.yellow,
                danger: colors.rose,
            }
        },
    },
    plugins: [
        require('@tailwindcss/typography')
    ],
}

