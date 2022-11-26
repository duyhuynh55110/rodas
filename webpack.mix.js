const mix = require('laravel-mix');

// Alias path for css, js
mix.webpackConfig({
    resolve: {
        extensions: ['.js', '.vue', '.json'],
        alias: {
            '@admin_js': __dirname + '/resources/assets/admin/js',
            '@utils': __dirname + '/resources/assets/admin/js/utils/index.js',
        },
    }
});

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
const assetAdminPath = 'public/admin-lte/';

// Build admin-lte resource (CSS, JS, Image)
mix.sass('resources/assets/admin/scss/app.scss', assetAdminPath + 'css')
.js('resources/assets/admin/js/app.js', assetAdminPath + 'js')
.copyDirectory('node_modules/admin-lte/dist/img', assetAdminPath + 'img')
// Publish page script
// brands
mix.js('resources/assets/admin/js/pages/brands.js', assetAdminPath + 'pages')
// products
mix.js('resources/assets/admin/js/pages/products.js', assetAdminPath + 'pages')
// giftBoxes
mix.js('resources/assets/admin/js/pages/gift-boxes.js', assetAdminPath + 'pages')
.version();
