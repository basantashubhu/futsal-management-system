let mix = require('laravel-mix');

let {styles, scripts} = require('./fgp.webpack.mix');

let front_assets_src = 'resources/assets/default/';
/*

mix.copyDirectory(front_assets_src + 'css/theme/vendors/base/fonts', 'public/css/fonts');
mix.copyDirectory('node_modules/clientjs', 'resources/assets/js/clientjs');
mix.copyDirectory('node_modules/d3', 'resources/assets/js/d3');

// Required Files
mix.copyDirectory('node_modules/jquery', 'resources/assets/js/jquery');
mix.copyDirectory('node_modules/lodash', 'resources/assets/js/lodash');
mix.copyDirectory('node_modules/axios', 'resources/assets/js/axios');
mix.copyDirectory('node_modules/bootstrap/js', 'resources/assets/js/bootstrap');
mix.copyDirectory('node_modules/chart.js/dist/Chart.js', 'resources/assets/js/chart.js');
mix.copyDirectory('node_modules/print-this/printThis.js', 'resources/assets/js/printThis.js');
mix.copyDirectory('node_modules/fullcalendar/dist/fullcalendar.js', 'resources/assets/js/fullcalendar.js');
mix.copyDirectory('node_modules/fullcalendar/dist/fullcalendar.css', 'resources/assets/css/fullcalendar.css');

// Color Picker
mix.copyDirectory('node_modules/spectrum-colorpicker/spectrum.css', 'resources/assets/default/scss/custom/spectrum/spectrum.css');
mix.copyDirectory('node_modules/spectrum-colorpicker/spectrum.js', 'resources/assets/spectrum-colorpicker/js/spectrum.js');

//Prints js
mix.copyDirectory('node_modules/print-js', 'resources/assets/js/print-js');


// Theme Media Files
mix.copyDirectory(front_assets_src + 'css/theme/app/media', 'public/assets/app/media/');
mix.copyDirectory(front_assets_src + 'css/theme/app/media', 'public/assets/app/media/');
mix.copyDirectory(front_assets_src + 'css/theme/app/media', 'public/assets/app/media/');
mix.copyDirectory(front_assets_src + 'images/file-icon', 'public/assets/images/file-icon/');
*/

// Theme Default Assets
// --------------------------
mix.styles([
    front_assets_src + 'css/theme/vendors/base/vendors.bundle.css',
    front_assets_src + 'css/theme/demo/demo3/base/style.bundle.css',
    front_assets_src + 'js/theme/vendors/custom/datatables/datatables.bundle.css',
    front_assets_src + 'js/theme/vendors/custom/jquery-ui/jquery-ui.bundle.css',
    // 'resources/fgp_assets/css/custom/dataTable.min.css',
    // front_assets_src + 'js/theme/vendors/custom/fullcalendar/fullcalendar.bundle.css',
    'resources/assets/css/fullcalendar.css',
    'resources/assets/css/site_style.css',
    'resources/assets/fgp/master.css',
    'resources/assets/fgp/timeline.css',
	'resources/assets/fgp/volunteerProfile.css',
    'resources/fgp_assets/css/custom/custom_fgp_css.css',
    'resources/fgp_assets/css/location_composit/location_composit.css',
    'resources/fgp_assets/css/custom/floatLable.css',
    'resources/assets/fgp/mediaQuery.css'


].concat(styles), 'public/css/theme.css');

// Theme Default Assets
// --------------------------
mix.sass(front_assets_src + 'scss/custom/default.scss', 'public/css/style.css');


mix.scripts([
    'resources/assets/js/clientjs/dist/client.min.js',
    'resources/assets/default/js/custom/Track/track.js',
    'resources/assets/js/print-js/dist/print.min.js',
    front_assets_src + 'js/theme/vendors/base/vendors.bundle.js',
    front_assets_src + 'js/theme/vendors/custom/flot/flot.bundle.js',
    front_assets_src + 'js/theme/demo/demo3/base/scripts.bundle.js',
    front_assets_src + 'js/theme/app/js/dashboard.js',
    front_assets_src + 'js/theme/vendors/custom/jquery-ui/jquery-ui.bundle.js',
    // front_assets_src + 'js/theme/vendors/custom/fullcalendar/fullcalendar.bundle.js',
    front_assets_src + 'js/theme/vendors/custom/portlets/draggable.js',
    front_assets_src + 'js/theme/vendors/custom/portlets/tools.js',
    front_assets_src + 'js/theme/snippets/pages/user/login.js',
    front_assets_src + 'js/theme/vendors/custom/forms/widgets/bootstrap-datetimepicker.js',
    front_assets_src + 'js/theme/vendors/custom/forms/widgets/bootstrap-datepicker.js',
    front_assets_src + 'js/theme/vendors/custom/forms/widgets/bootstrap-select.js',
    front_assets_src + 'js/theme/vendors/custom/datatables/datatables.bundle.js',
    front_assets_src + 'js/custom/lodash/lodash.js',
    'resources/assets/default/js/custom/global/ajaxRequest.js',
    'resources/assets/default/js/custom/global/print.js',
    'resources/assets/default/js/d3/dist/d3.js',
    'resources/assets/js/chart.js',
    'resources/assets/js/printThis.js',
    'resources/assets/js/fullcalendar.js',
    'resources/assets/js/site_js.js',
    'resources/assets/default/fgp/js/row-callback.js',
], 'public/js/theme.js');

// logindepend Js
mix.scripts([
    'resources/assets/js/axios/dist/axios.js',
], 'public/js/logincore.js');


// Config Js
mix.scripts([
    'resources/assets/default/js/custom/global/config.js',
], 'public/js/config.js');


// Required Js
mix.scripts([
    'resources/assets/js/axios/dist/axios.js',
    'resources/assets/default/js/custom/route/router.js',
    'resources/assets/default/js/custom/global/ajaxRequest.js',
    'resources/assets/default/js/custom/global/helper.js',
    'resources/assets/default/js/custom/global/base64.js',
    'resources/assets/default/js/custom/global/tableExport.js',
    'resources/assets/default/js/custom/global/signPad.js',
    'resources/assets/spectrum-colorpicker/js/spectrum.js',
    'resources/assets/default/js/custom/global/ssn.js',
    'resources/assets/default/js/custom/components/alertConfig.js',
    'resources/assets/default/js/custom/components/modal.js'
], 'public/js/app.js');


mix.scripts([
    'resources/assets/default/js/custom/form/inputCapitalize.js',
    // 'resources/assets/default/js/custom/components/data-table.min.js',
    'resources/assets/default/js/custom/components/rowReorder.js',
    'resources/assets/default/js/custom/route/route.js',
    'resources/assets/default/js/custom/calendar/calendar.js',
    'resources/assets/default/js/custom/form/validateForm.js',
    'resources/assets/default/js/custom/form/validateFormCustom.js',
    'resources/assets/default/js/custom/form/validateFormPage.js',
    'resources/assets/default/js/custom/form/npApplicationValidate.js',
    'resources/assets/default/js/custom/form/singleApplicationNP.js',
    'resources/assets/default/js/custom/form/enableForm.js',
    'resources/assets/default/js/custom/components/table.js',
    'resources/assets/default/js/custom/components/advanceSearch.js',
    'resources/assets/default/js/custom/components/datatable.js',
    'resources/assets/default/js/custom/components/row-grouping.js',
    'resources/assets/default/js/custom/components/lookUp.js',
    'resources/assets/default/js/custom/components/accordion.js',
    'resources/assets/default/js/custom/form/lookup.js',
    'resources/assets/default/js/custom/form/dataManipulate.js',
    'resources/assets/default/js/custom/form/zip_code.js',
    'resources/assets/default/js/custom/form/addMultipleFields.js',
    'resources/assets/default/js/custom/form/dateRangePicker.js',
    'resources/assets/default/js/custom/pages/dashboard.js',
    'resources/assets/default/js/custom/pages/settings.js',
    'resources/assets/default/js/custom/pages/application.js',
    'resources/assets/default/js/custom/pages/rescueApp.js',
    'resources/assets/default/js/custom/pages/applicationSP.js',
    'resources/assets/default/js/custom/pages/applicationModalNP.js',
    'resources/assets/default/js/custom/pages/applicationAddCitizen.js',
    'resources/assets/default/js/custom/pages/applicationAddNP.js',
    'resources/assets/default/js/custom/pages/np.js',
    'resources/assets/default/js/custom/pages/rescue.js',
    'resources/assets/default/js/custom/pages/processFormNPPage.js',
    'resources/assets/default/js/custom/pages/npAddFromPage.js',
    'resources/assets/default/js/custom/pages/client_application.js',
    'resources/assets/default/js/custom/pages/rate.js',
    'resources/assets/default/js/custom/pages/page.js',
    'resources/assets/default/js/custom/pages/client.js',
    'resources/assets/default/js/custom/pages/veterinarian.js',
    'resources/assets/default/js/custom/pages/certificate.js',
    'resources/assets/default/js/custom/pages/template.js',
    'resources/assets/default/js/custom/pages/pets.js',
    'resources/assets/default/js/custom/notification/notification.js',
    'resources/assets/default/js/custom/todo/todo.js',
    'resources/assets/default/js/custom/global/polyfill.js',
    'resources/assets/default/js/custom/customtable/jsontotable.js',
    'resources/assets/default/js/custom/developernote/developernote.js',
    'resources/assets/default/js/custom/form/checkEmail.js',
    
].concat(scripts), 'public/js/custom.js');

//Front End JS
// mix.scripts([
//     front_assets_src + 'js/theme/vendors/base/vendors.bundle.js',
//     front_assets_src + 'js/theme/demo/demo3/base/scripts.bundle.js'
// ], 'public/js/front-end-theme.js');

// Required Js
// mix.scripts([
//     'resources/assets/js/axios/dist/axios.js',
//     'resources/assets/default/js/custom/route/router.js',
//     'resources/assets/default/js/custom/global/ajaxRequest.js',
//     'resources/assets/default/js/custom/components/lookUp.js',
// ], 'public/js/front-end-app.js');

// mix.scripts([
//     'resources/assets/default/js/custom/route/route.js'
// ], 'public/js/front-end-custom.js');


/**
 * ---------------
 * Web Assets
 * --------------
 */

// let web_assets_src = 'resources/assets/web/';

// mix.styles([
//     web_assets_src+'css/formidableproe1e7.css',
//     web_assets_src+'css/search-filter.mina1ec.css',
//     web_assets_src+'css/normalize.css',
//     web_assets_src+'css/style.css',
//     web_assets_src+'css/loader.css',
// ], 'public/css/web.css');

// mix.scripts([
//     web_assets_src+'js/lib/conditionizr-4.3.0.min.js',
//     web_assets_src+'js/lib/modernizr-2.7.1.min.js',
//     'resources/assets/js/axios/dist/axios.js',
//     'node_modules/jquery/dist/jquery.min.js',
//     web_assets_src+'js/jquery-migrate.min.js',
//     web_assets_src+'js/ajaxRequest.js',
//     web_assets_src+'js/router.js',
//     web_assets_src+'js/route.js',
//     web_assets_src+'js/scripts.js',
//     web_assets_src+'js/jquery.searchabledropdown-1.0.8.min.js',
//     web_assets_src+'js/custom/application.js',
// ], 'public/js/web.js');