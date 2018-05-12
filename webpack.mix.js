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

mix.js('resources/assets/js/app.js', 'public/js')
   .js('node_modules/vue2-autocomplete-js/dist/vue2-autocomplete.js', 'public/js')
   .css('node_modules/vue2-autocomplete-js/dist/style/vue2-autocomplete.css', 'public/css')
   .sass('resources/assets/sass/app.scss', 'public/css');
