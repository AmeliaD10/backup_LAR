const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .styles([
        'public/css/style.css'
    ], 'public/css/all-styles.css');
