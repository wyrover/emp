var elixir = require('laravel-elixir');
require('laravel-elixir-imagemin');
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass(["app.scss","datetimepicker.scss","chartist.scss"],"public/css/app.css")
        .styles(["bootstrap-chosen.css","animate.css"],"public/css/vendor.css")
        .imagemin()
        .scripts([
            "bower_components/vue/dist/vue.min.js",
            "bower_components/randomColor.js",
            "bower_components/vue-resource/dist/vue-resource.min.js",
            "bower_components/jquery-nicescroll/dist/jquery.nicescroll.min.js",
            "moment.js",
            "datetimepicker.js",
            "bower_components/chosen/chosen.jquery.min.js",
            "bower_components/starPop.js",
        ], 'public/js/plugin.js')
        .scripts(["bower_components/chart/chart.js","bower_components/chart/legend.js"],"public/js/chart.js")
        .scripts("main.js","public/js/main.js")
        .scripts("home.js","public/js/home.js")
        .scripts("employee.public.js","public/js/employee.public.js")
        .scripts("locale.public.js","public/js/locale.public.js")
        .scripts("employee.show.js","public/js/employee.show.js")
        .scripts("employee.create.js","public/js/employee.create.js")
        .scripts("employee.update.js","public/js/employee.update.js")
});
