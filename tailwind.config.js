/** @type {import('tailwindcss').Config} */
const plugin = require("tailwindcss/plugin");
const theme = require("tailwindcss/defaultTheme");
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    safelist: [
        "bg-white",
        "bg-passou-magenta",
        "items-center",
        "items-end",
        "mx-auto",
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
                xl: "79rem",
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
                maquininhas: "left 45%",
            },
            minHeight: {
                160: "40rem",
            },
            colors: {
                passou: {
                    "magenta-300": "#bf53d9",
                    "magenta-400": "#8C37A0",
                    magenta: "#7a378a",
                    "magenta-700": "#662583",
                    "magenta-750": "#5F2879",
                    "magenta-800": "#461d52",
                    "magenta-850": "#451D50",
                    cyan: "#00ab97",
                    "cyan-300": "#00c4a9",
                    "cyan-400": "#41A997",
                    light: "#F3F3F3",
                    "soft-cyan": "#6cdbd4",
                    gray: "#a7a6a7",
                    dark: "#333333",
                },
            },
        },
    },
    plugins: [
        plugin(function ({ addVariant }) {
            addVariant("nth-child-2", "&:nth-child(2)");
        }),
    ],
};
