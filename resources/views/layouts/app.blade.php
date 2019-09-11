<!DOCTYPE html>
<!-- /**
 * DEVELOPERS
 * ----------------------------------------------
 * SUMAN  THAPA - LEAD  (NEPALNME@GMAIL.COM)
 * ----------------------------------------------
 * - BASANTA TAJPURIYA 
 * - RAKESH SHRESTHA
 * - LEKHRAJ RAI
 * -----------------------------------------------
 * Created On:
 *
 * THIS INTELLECTUAL PROPERTY IS COPYRIGHT Ⓒ 2019
 * ZEUSLOGIC, INC. ALL RIGHT RESERVED
*/
-->
<html lang="en" >
    <!-- begin::Head -->
    <head>
        <meta charset="utf-8">
        <title>{{ config('app.name') }} @yield('title') </title>
        <meta name="author" content="Suman Thapa">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Latest updates and statistic charts">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--begin::Web font -->
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
        <script>
          WebFont.load({
            google: {"families":["Montserrat:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>
        <!--end::Web font -->
        <!--begin::Base Styles -->
        <link href="{{ asset('css/theme.css') }}" rel="stylesheet" type="text/css" />
        <style>
            
            *{
                font-size: {{globalFontSize}};
                overflow-y: auto;
            }

            i{
                font-size: {{globalFontSize}};  
            }
            
        </style>
        <!--end::Base Styles -->
        <!-- <link rel="shortcut icon" href="assets/demo/demo3/media/img/logo/favicon.ico" /> -->
    </head>
<!-- end::Head -->
<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default" >
    @yield('content')

@section('scripts')
    <script src="{{ asset('js/theme.js') }}" type="text/javascript" charset="utf-8"></script>
@show
</body>
</html>
