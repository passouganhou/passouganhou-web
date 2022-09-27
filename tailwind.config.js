/** @type {import('tailwindcss').Config} */
const theme = require("tailwindcss/defaultTheme");
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    safelist: ["bg-white", "bg-passou-magenta"],

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
            borderRadius: {
                "5xl": "2.7rem",
            },
            fontSize: {
                "4.5xl": "2.5rem",
                "2.5xl": "1.75rem",
            },
            spacing: {
                0.5: "2px",
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
                    "magenta-700": "#662583",
                    "magenta-800": "#461d52",
                    cyan: "#00ab97",
                    "soft-cyan": "#6cdbd4",
                    gray: "#a7a6a7",
                },
            },
        },
    },
    plugins: [],
};
