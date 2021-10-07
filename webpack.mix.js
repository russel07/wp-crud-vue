let mix = require('laravel-mix');

mix.js('vue-app/src/main.js', 'admin/assets/vue.js').vue({ version: 3 });
