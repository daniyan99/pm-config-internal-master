const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/configurator/index.scss', 'public/css/configurator')
    .copy('node_modules/@fortawesome/fontawesome-pro/css/all.css', 'public/css/font-awesome')
    .copy('node_modules/@fortawesome/fontawesome-pro/webfonts', 'public/css/webfonts')
    .copy('resources/js/configurator', 'public/js/configurator')
    .copy('resources/images/original', 'storage/app/public/original')
    .copy('resources/images/sidebar-icons/', 'public/images/sidebar-icons');
