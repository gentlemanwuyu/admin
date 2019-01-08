var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    //拷贝AdminLTE相关的文件和插件
    mix.copy('node_modules/admin-lte/bower_components','public/assets/adminlte/bower_components');
    mix.copy('node_modules/admin-lte/plugins','public/assets/adminlte/plugins');
    mix.copy('node_modules/admin-lte/dist','public/assets/adminlte/dist');
});
