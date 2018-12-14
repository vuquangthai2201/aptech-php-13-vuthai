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
   .copy('resources/assets/fonts/font-awesome-4.7.0/fonts', 'public/fonts')
   .copy('resources/assets/fonts/montserrat', 'public/fonts/montserrat')
   .copy('resources/assets/fonts/poppins', 'public/fonts/poppins')
   .sass('resources/sass/app.scss', 'public/css');

mix.styles([
    'resources/assets/vendor/bootstrap/css/bootstrap.min.css',
    'resources/assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css',
    'resources/assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css',
    'resources/assets/vendor/animate/animate.css',
    'resources/assets/vendor/animsition/css/animsition.min.css',
    'resources/assets/vendor/select2/select2.min.css',
    'resources/assets/vendor/slick/slick.css',
    'resources/assets/vendor/lightbox2/css/lightbox.min.css',
    'resources/assets/css/util.css',
    'resources/assets/css/main.css',
    'resources/assets/vendor/noui/nouislider.min.css',
], 'public/css/all.css');

mix.scripts([
    'resources/assets/vendor/animsition/js/animsition.min.js',
    'resources/assets/vendor/bootstrap/js/popper.js',
    'resources/assets/vendor/bootstrap/js/bootstrap.min.js',
    'resources/assets/vendor/select2/select2.min.js',
    'resources/assets/js/select.js',
    'resources/assets/vendor/slick/slick.min.js',
    'resources/assets/js/slick-custom.js',
    'resources/assets/vendor/countdowntime/countdowntime.js',
    'resources/assets/vendor/lightbox2/js/lightbox.min.js',
    'resources/assets/vendor/sweetalert/sweetalert.min.js',
    'resources/assets/js/btn.js',
    'resources/assets/js/main.js',
    'resources/assets/vendor/noui/nouislider.min.js',
    'resources/assets/js/filterbar.js',
], 'public/js/all.js');

mix.styles([
    'resources/assets/css/custom-admin.css',
    'resources/assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css',
    'resources/assets/css/admin-main.css',
], 'public/css/admin.css');

mix.scripts([
    'resources/assets/js/admin.js',
], 'public/js/admin.js');

mix.copy([
    'storage/app/images/products'
], 'public/images/products');
