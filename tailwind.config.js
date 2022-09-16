/** @type {import('tailwindcss').Config} */
const theme = require("tailwindcss/defaultTheme");
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    theme: {
        container: {
            center: true,
            padding: "1rem",
            screens: {
                DEFAULT: "100%",
                sm: "40rem",
                md: "48rem",
                lg: "64rem",
                xl: "80rem",
                // "2xl": "96rem",
            },
        },
        extend: {
            fontSize: {
                "4.5xl": "2.5rem",
                "2.5xl": "1.75rem",
            },
            spacing: {
                108: "27.125rem",
            },
            fontFamily: {
                "segoe-ui": ["Segoe UI", "system-ui", "sans-serif"],
                montserrat: ["Montserrat", "system-ui", "sans-serif"],
            },
            backgroundPosition: {
                maquininhas: "left 85%",
            },
            minHeight: {
                160: "40rem",
            },
            colors: {
                passou: {
                    magenta: "#7a378a",
                    "magenta-800": "#461d52",
                    cyan: "#00ab97",
                },
            },
        },
    },
    plugins: [],
};
