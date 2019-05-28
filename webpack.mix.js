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

mix.js([
      'resources/js/app.js',
      'resources/views/client/assets/js/script.js',
   ], 'public/js')
   .js([
      'resources/js/voyager.js',
   ], 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .styles([
      'resources/views/client/assets/css/responsive-style.css',
      'resources/views/client/assets/css/style.css',
   ], 'public/css/client.css')
   .options({
      processCssUrls: false,
   })
   .copyDirectory('resources/views/client/assets/img', 'public/img')
   .copyDirectory('resources/views/client/assets/fonts', 'public/fonts')
   .browserSync({
      proxy: process.env.APP_URL
   });
