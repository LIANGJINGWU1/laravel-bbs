import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources'),
        },
    },
    css: {
        preprocessorOptions: {
            scss: {
                quietDeps: true
            }
        }
    },
    build: {
        rollupOptions: {
            output: {
                assetFileNames: (assetInfo) => {
                    if (/\.(woff2?|ttf|eot|svg)$/.test(assetInfo.name)) {
                        return 'build/fonts/[name][extname]';  // 👈 自定义字体输出路径
                    }
                    return 'build/assets/[name][extname]';
                },
            },
        },
    }
});

// import { defineConfig } from 'vite';
// import laravel from 'laravel-vite-plugin';
//
// export default defineConfig({
//     plugins: [
//         laravel({
//             input: [
//                 'resources/sass/app.scss',
//                 'resources/js/app.js',
//             ],
//             refresh: true,
//         }),
//     ],
//     css: {
//         preprocessorOptions: {
//             scss: {
//                 quietDeps: true // 隐藏依赖项的警告
//             }
//         }
//     }
// });
