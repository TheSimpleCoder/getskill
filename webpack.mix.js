const mix = require('laravel-mix');
let webpack = require('webpack');

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

mix
    .setPublicPath('public/build/admin')
    .setResourceRoot('/build/admin/')
    .js('resources/assets/admin/js/app.js', 'admin/js')
    .sass('resources/assets/admin/sass/app.scss', 'admin/css')
    .version();

mix
    .setPublicPath('public/build')
    .setResourceRoot('/build/')
    .js('resources/assets/js/app.js', 'js')
    .sass('resources/assets/sass/style.scss', 'css')
    .version()
    .options({
        processCssUrls: false
    });


mix.webpackConfig({
    plugins: [
        new webpack.IgnorePlugin(/^codemirror$/)
    ]
});
