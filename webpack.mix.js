let mix = require('laravel-mix');

mix.autoload({
    jquery: ['$', 'window.jQuery', 'jQuery']
});

mix.js('vue-app/src/main.js', 'admin/assets/vue.js').vue({ version: 3 });
