const mix = require('laravel-mix');
let webpack = require('webpack');

const res = 'resources/';

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix
//     .setPublicPath('public/build/admin')
//     .setResourceRoot('/build/admin/')
//     .js('resources/assets/admin/js/app.js', 'admin/js')
//     .sass('resources/assets/admin/sass/app.scss', 'admin/css')
//     .version();
//
// mix
//     .setPublicPath('public/build')
//     .setResourceRoot('/build/')
//     .js('resources/assets/js/app.js', 'js')
//     .sass('resources/assets/sass/style.scss', 'css')
//     .version()
//     .options({
//         processCssUrls: false
//     });
//
//
// mix.webpackConfig({
//     plugins: [
//         new webpack.IgnorePlugin(/^codemirror$/)
//     ]
// });

mix
    .scripts([
        'public/build/js/scripts.min.js',
        'public/js/application.js',
        'public/js/dropzone.js',
        'public/js/jquery.datetimepicker.full.min.js',
        'public/build/js/catalog.js',
        'public/build/js/footer-accordion.js',
        'public/build/js/menu.js',
        'public/build/js/sorting.js',
        'public/js/jquery.maskedinput.min.js',
        'public/js/jquery-ui.js',
        'public/js/nouislider.js',
        'public/js/range-slider.js',
        'public/build/js/slick.js',
        'public/build/js/slider.js',
        'public/build/js/lazyload.min.js',
        'public/js/jquery.fancybox.min.js',
        'public/Semantic-UI/semantic.min.js',
        'public/js/select2.min.js',
        'public/build/js/seo-text.js',
        'public/build/js/common.js'
    ], 'public/js/build.min.js')
    .sass(res + 'scss/main.scss', 'public/css/main.min.css')
    .options({
        postCss: [
            require('postcss-discard-comments')({
                removeAll: true
            }),
            require('cssnano')()
        ],
        processCssUrls: false
    })
    // .copy(res + 'js/frontend/jquery.min.js', 'public/js')
    // .copy(res + 'js/frontend/sourcebuster.min.js', 'public/js')
    // .copy(res + 'fonts', 'public/fonts')
    // .copy(res + 'img', 'public/img')
    .version();
