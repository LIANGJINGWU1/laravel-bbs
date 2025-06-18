/** @type {import('tailwindcss').Config} */
module.exports = {
    prefix: 'tw-', // 防止和 Bootstrap class 冲突
    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './resources/js/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter'],
            },
        },
    },
    plugins: [],
}
