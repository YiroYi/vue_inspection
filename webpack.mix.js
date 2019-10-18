let mix = require('laravel-mix');



 mix.styles([

], 'public/css/plantilla.css')
.scripts([

], 'public/js/plantilla.js')
.js(['resources/assets/js/app.js'],'public/js/app.js');


/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |'resources/assets/plantilla/js/calendar.min.js',
 'resources/assets/plantilla/js/chartjs-data.js',
 'resources/assets/plantilla/js/echart-data.js',
 'resources/assets/plantilla/js/editable_table_data.js',
 'resources/assets/plantilla/js/form-validation.js',
 'resources/assets/plantilla/js/getmdl-select.js',
 'resources/assets/plantilla/js/google-maps-data.js',
 'resources/assets/plantilla/js/home-data2.js',
 'resources/assets/plantilla/js/home-data3.js',
 'resources/assets/plantilla/js/material-loading.js',
 'resources/assets/plantilla/js/morris_chart_data.js',
 'resources/assets/plantilla/js/owl_data.js',
 'resources/assets/plantilla/js/pages.js',
 'resources/assets/plantilla/js/select2-init.js',
 'resources/assets/plantilla/js/steps-data.js',
 'resources/assets/plantilla/js/sweet-alert-data.js',
 'resources/assets/plantilla/js/table_data.js',
 'resources/assets/plantilla/js/timeline.js',
 'resources/assets/plantilla/js/treeview-data.js',
 'resources/assets/plantilla/js/vector-data.js',
 'resources/assets/plantilla/js/wizard-data.js'
 */
