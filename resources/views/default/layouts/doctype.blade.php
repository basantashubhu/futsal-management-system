<!DOCTYPE html>
<!-- /**
 * DEVELOPERS
 * ----------------------------------------------
 * SUMAN  THAPA - LEAD  (NEPALNME@GMAIL.COM)
 * ----------------------------------------------
 * - RUNA SIDDHI BAJRACHARYA
 * - RABIN BHANDARI
 * - SHIVA THAPA
 * - PRABHAT GURUNG
 * - KIRAN CHAULAGAIN
 * -----------------------------------------------
 * Created On:
 *
 * THIS INTELLECTUAL PROPERTY IS COPYRIGHT Ⓒ 2018
 * ZEUSLOGIC, INC. ALL RIGHT RESERVED
*/
-->
<html lang="en">
<!-- begin::Head -->
<head>
    <meta charset="utf-8">
    <title>Foster Grandparents Program</title>
    <meta name="author" content="Suman Thapa">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]},
            active: function () {
                sessionStorage.fonts = false;
            }
        });
    </script>
    <!--end::Web font -->
    <!--begin::Base Styles -->
    <link href="{{'images/fgp_logo1.png'}}" rel="shortcut icon">
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css"/>
    <script src="{{ asset('js/config.js') }}" type="text/javascript" charset="utf-8"></script>
    <script>
        std.config.date_format = "{{sitedateformat() }}";
        std.config.alt_id  = "{{getSiteSettings('alt_id_true')}}";
    </script>
    <!--end::Base Styles -->
    <!-- <link rel="shortcut icon" href="assets/demo/demo3/media/img/logo/favicon.ico" /> -->

        <style>
            .datepicker.datepicker-dropdown {
                z-index: 100000 !important;
            }
        .lookup-popover{
            position: absolute;
            text-align: center;
            z-index: 99999999;
            background-color: #fff;
            color: red;
            border-radius: 5px;
            padding: 10px;
            -webkit-box-shadow: 0px 1px 15px 1px rgba(69, 65, 78, 0.08);
            box-shadow: 0px 1px 15px 1px rgba(26, 25, 29, 0.08);
        }
        .lookup-popover::after{
            content: '';
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -10px;
            width: 0;
            height: 0;
            border-top: solid 10px #ffffff;
            border-left: solid 10px transparent;
            border-right: solid 10px transparent;
        }
        
        
        </style>
        @if(globalFontSize())
            <style>
                *{
                    font-size: {{globalFontSize()}}px !important;
                }

                #m_ver_menu .m-menu__link-icon{
                    font-size: {{globalFontSize() * 2}}px !important;
                }

                .headerAvatar{
                    font-size: {{globalFontSize() * 3}}px !important;  
                }

                h3{
                    font-size: {{globalFontSize() / 11.2}}rem !important;
                }

                @if(globalFontSize() == 14)
                    .templateSelectPicker .bootstrap-select{
                        width: 315px !important;
                    }        

                    @media only screen and (max-width: 1461px){
                        #tsStatusFilter label{
                            width: 55px;
                        }

                        #tsStatusFilter .custom-selecter-btn .bootstrap-select{
                            width: 150px !important;
                            
                        }

                        #tsLocationFilter label{
                            width: 115px !important;
                        }

                        #tsLocationFilter span.select2-container{
                            width: 315px !important;
                            
                        }
                    }
                @endif

                @if(globalFontSize() == 15)
                    .templateSelectPicker .bootstrap-select{ width: 293px !important; }
                @endif

                @if(globalFontSize() == 16)
                    .templateSelectPicker .bootstrap-select{ width: 277px !important; }
                    
                @endif

                @if(globalFontSize() == 17)
                    .templateSelectPicker .bootstrap-select{ width: 260px !important; }
                    
                @endif

                @if(globalFontSize() >= 14)
                    .modal-custom-width{
                        max-width: 1400px;
                    }

                    .modal-lg{
                        max-width: 900px;
                    }

                    /* Volunteers */

                    .addPhoneRow,
                    .removePhoneRow{
                        height: 30px !important;
                        width: 40px !important;
                    }

                    /* Timesheets */

                    .sel-stipend-period .custom-selecter-btn .bootstrap-select{
                        width: 315px !important
                    }

                @endif

            </style>
        @endif
        
</head>
<!-- end::Head -->