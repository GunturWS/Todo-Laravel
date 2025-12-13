/** @type {import('tailwindcss').Config} */
export default {
    content: ["./resources/**/*.blade.php", "./resources/**/*.js"],
    theme: {
        extend: {
            colors: {
                "nova-dark": "#242424",
                "nova-gray": "#665c54",
                "nova-milk": "#e7d7ad",
            },
        },
    },
    plugins: [],
};

