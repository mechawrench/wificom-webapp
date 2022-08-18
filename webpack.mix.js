const mix = require('laravel-mix')

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss'),
    ])
    .version()

mix.js('resources/filament/filament-turbo.js', 'public/js')
    .extract(['@hotwired/turbo'], 'js/vendor-turbo.js');
