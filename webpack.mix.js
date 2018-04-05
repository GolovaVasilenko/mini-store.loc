let mix = require('laravel-mix');

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

mix.styles([
    'resources/assets/front/css/bootstrap.css',
    'resources/assets/front/css/bootstrap-theme.css',
    'resources/assets/front/css/style.css'
], 'public/css/front.css');

mix.scripts([
    'resources/assets/front/js/jquery.js',
    'resources/assets/front/js/bootstrap.min.js',
    'resources/assets/front/js/SmoothScroll.js',
    'resources/assets/front/js/theme-scripts.js'
], 'public/js/front.js');

mix.copy('resources/assets/front/fonts', 'public/fonts');
mix.copy('resources/assets/front/images', 'public/images');