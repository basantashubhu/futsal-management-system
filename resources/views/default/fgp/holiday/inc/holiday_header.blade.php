<style>
    body .toolbar .m-form__label {
        background-color: #f2f3f8;
        padding-left: 10px;
        border-radius: 30px;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }
    .fc-body .active_row {
     background-color: #111 !important; 
    }

    .bootstrap-select.btn-group > .dropdown-toggle.bs-placeholder {
        height: 36px;
        color: #9699a2;
    }

    .info-active{
        background: #36a3f7;
        color: #fff !important;
    }
</style>
<div class="m-subheader">
    <div class="d-flex align-items-center">
        <div class="mr-auto" id="appHead">
            <h3 class="m-subheader__title float-left application-title-color">
                Holidays
            </h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="#" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__separator">
                    -
                </li>
                <li class="m-nav__item">
                    <a data-route="holiday" class="m-nav__link">
                        <span class="m-nav__link-text">
                            Tables
                        </span>
                    </a>
                </li>
                <li class="m-nav__separator">
                    -
                </li>
                <li class="m-nav__item">
                    <a data-route="holiday" class="m-nav__link c-p">
                        <span class="m-nav__link-text">
                            Holidays
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        @canAccess('holiday', 'add')
        <button class="btn btn-info m-btn btn-sm m-btn--custom m-btn--icon m-btn--pill" data-modal-route="/addHoliday" data-backdrop="static" data-keyboard="false">
            <span>
                <i class="la la-plus"></i>
                <span>
                    Holiday
                </span>
            </span>
        </button>
        @endcanAccess
    </div>
</div>
<div class="m-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="m-portlet m-portlet--mobile m-portlet--body-progress- with-border">
                <div class="m-portlet__head">
                    <div class="m-form m-form--label-align-right m--margin-top-bottom">
                        <div class="form-group m-form__group row justify-content-start align-items-center toolbar justify-content-start">
                            <!-- Advance Filter -->
                            <div id="holiday_toolbars" style="display: inherit;">
                                <div class="col-auto mt-20 no-pd-right">
                                    <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-left m-dropdown--align-push" data-dropdown-toggle="click" title="Advance Filter" data-dropdown-persistent="true" aria-expanded="true">
                      <!--                   <a href="#" id="showHolidayAdavanceSearch" class="m-portlet__nav-link btn btn-sm btn-brand  m-btn m-btn--outline-2x m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle closeClass"> -->
                                           <!--  <i class="la la-plus m--hide"></i>
                                            <i class="la la-filter"></i> -->
                                        <!-- </a> -->
                                        <div class="m-dropdown__wrapper" style="width: 500px;">
                                            <span class="m-dropdown__arrow m-dropdown__arrow--left m-dropdown__arrow--adjust"></span>
                                            <div class="m-dropdown__inner">
                                                <div class="m-dropdown__body no-pd-i">
                                                    <div class="m-dropdown__content">
                                                        <div class="row">
                                                            <div class="col-12 col-sm-12">
                                                                <div class="advance-search">


        <!-- <form class="m-form m-form--fit m-form--label-align-right" id="holidayAdvancedFilter"> -->
          <!--   <div class="m-portlet__body" style="padding: 0px 0 8px 0;">
                <div class="row">
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                            <label for="example-text-input" class="col-form-label">Name</label>
                            <input class="form-control m-input advanceSearch" type="text" value="" name="name" id="hol_name" autocomplete="off">
                        </div> -->
                        
                      <!--   <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                            <label for="example-email-input" class="col-form-label">Date</label>
                            <input class="form-control m-input" type="text" value="" name="hol_date" id="hol_date" autocomplete="off">
                        </div> -->
                    <!--     <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                            <label for="example-search-input" class="col-form-label">County</label>
                            <input class="form-control m-input advanceSearch" type="text" value="" name="county" id="hol_county" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                            <label for="example-text-input" class="col-form-label">Type</label>
                            <input class="form-control m-input advanceSearch" type="text" value="" name="type" id="hol_type" autocomplete="off">
                        </div>

                        <div class="form-group np-pd-left no-pd-bottom m-form__group row" id="m_application_date_filter_advance1">
                            <label for="example-text-input" class="col-form-label">ETO Eligibility</label>
                            <input class="form-control m-input" type="text" name="eto_eli" id="eto_eli" autocomplete="off">
                        </div>
                       
                    </div>
                </div>
            </div>

            <div class="m-form__actions footer-action">
                <div class="row row justify-content-between">
                    <div class="col">
                        <label for="showHolidayAdavanceSearch" onclick="$('#showHolidayAdavanceSearch').trigger('click')" class="cancelBtn btn btn-sm m-btn m-btn--custom m-btn--pill btn-default float-left">
                            Cancel
                        </label>
                        <label for="showHolidayAdavanceSearch" class="btn btn-sm m-btn m-btn--custom m-btn--pill btn-default float-left m-l-5 clearBtn clearBtn1" data-target="holidayAdvancedFilter" data-close="showHolidayAdavanceSearch">
                                    Clear
                        </label>
                    </div>
                    <div class="col">
                    </div>
                    <div class="col text-right">
                        <button type="button" 
                        for="showHolidayAdavanceSearch" class="applyBtn1 btn m-btn btn-sm m-btn--custom m-btn--pill btn-success submitHolidayFilter" data-target="holidayAdvancedFilter" id="btnHolidayAdvanceSearch" onclick="$('#showHolidayAdavanceSearch').trigger('click')">
                            Apply
                        </button>
                    </div>
                </div>
            </div> -->
        </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Advance Filter -->
                                <form class="form form-inline" id="holiday_Filter">
                                    <div class="col-auto mt-15 no-pd-left">
                                        <div class="m-form__group m-form__group--inline w-220 pill-style">
                                            <div class="m-form__label left">
                                                <label class="m-label m-label--single">
                                                    Name
                                                </label>
                                            </div>
                                            <div class="m-form__control custom-selecter-btn">
                                                <input type="text" class="form-control btn-redius" name="name" id="holiday_name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-auto mt-15">
                                        <div class="m-form__group m-form__group--inline w-220 pill-style">
                                            <div class="m-form__label left">
                                                <label class="m-label m-label--single">
                                                    Type
                                                </label>
                                            </div>
                                            <div class="m-form__control custom-selecter-btn">
                                                <select class="form-control m-bootstrap-select m-input selectpicker m-input--pill" data-style="btn-redius" id="holiday_type"
                                                        multiple data-width="250px" title="Select Holiday Type" data-selected-text-format="count > 3" name="type[]">
                                                        @if(count($cal_types)>0)
                                                            @foreach($cal_types as $type)
                                                                <option value="{{$type->cal_type}}">{{$type->cal_type}}</option>
                                                            @endforeach
                                                        @else
                                                            <option value="" disabled="disabled">Not Available</option>
                                                        @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="d-md-none m--margin-bottom-10"></div>
                                    </div>
                                   <!--  <div class="col-auto mt-15">
                                        <div class="m-form__group m-form__group--inline w-220 pill-style">
                                            <div class="m-form__label left">
                                                <label class="m-label m-label--single" style="width: 100px;">
                                                    ETO Eligibility
                                                </label>
                                            </div>
                                            <div class="m-form__control custom-selecter-btn">
                                                <input type="text" class="form-control btn-redius" name="eto_eli" id="eto_eli">
                                            </div>
                                        </div>
                                    </div> -->
                                    <button type="button" class="hidden" id="holidaySearchBtn" data-target="holiday_Filter"></button>
                                </form>
                                <div class="col-auto mt-20">
                                    <button title="Reset Search" data-route="holiday" class="btn btn-sm btn-outline-primary  m-btn m-btn--outline-2x m-btn--icon m-btn--icon-only m-btn--pill btnRefresh">
                                        <i class="fa fa-undo"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="col text-right mt-15">
                                <div class="m-btn-group m-btn-group--pill btn-group m-btn-group m-btn-group--pill btn-group-sm mr-15" role="group" aria-label="Small button group" style="height: 27px; margin-top: 2px;">
                                    <button title="Calender View" class="btn btn-sm btn-outline-info btn-calendar-view">
                                        <i class="la la-calendar"></i>
                                    </button>
                                    <button title="Table View" class="btn btn-sm btn-outline-info btn-table-view info-active">
                                        <i class="la la-table"></i>
                                    </button>
                                </div>
                                {{-- <span class="m-switch m-switch--outline m-switch--info mt-15">
                                    <label class="mr-10" id="switch_lable" style="font-size: 14px; font-weight: 500;">Switch to Calendar View</label>
                                    <label style="margin-bottom: -10px;">
                                        <input type="checkbox" id="calendar_switch_view" name="">
                                        <span></span>
                                    </label>
                                </span> --}}
                                <div class="m-btn-group m-btn-group--pill btn-group" role="group" aria-label="Button group with nested dropdown" style="margin-top: -8px;">
                                    <div class="m-btn-group btn-group" role="group">
                                        <button id="ietableExport" type="button" class="btn mt-10 btn-warning btn-sm m-btn m-btn--pill-last br-60 dropdown-toggle showInBig" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Export as
                                        </button>
                                        <button id="ietableExport" type="button" class="btn btn-warning btn-sm m-btn m-btn--pill-last br-60 dropdown-toggle showInMedium" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="la la-bars"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="ietableExport" x-placement="bottom-start">
                                            <button class="c-p dropdown-item holidayExporter" data-sort-field="name" data-sort-value="desc" data-export-type="csv">
                                                CSV
                                            </button>
                                            <button class="c-p dropdown-item holidayExporter" data-sort-field="name" data-sort-value="desc" data-export-type="json">
                                                JSON
                                            </button>
                                            <button class="c-p dropdown-item holidayExporter" data-sort-field="name" data-sort-value="desc" data-export-type="pdf">
                                                PDF
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                   @include('default.fgp.holiday.inc.holiday_body')
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).off('click','.btn-calendar-view').on('click','.btn-calendar-view', function(e){
        e.preventDefault();
        $('#hol_tab_data').slideUp('slow');
        $('#hol_calendar').slideDown('slow');
        $('#holiday_toolbars').slideUp('slow');
        $('#switch_lable').text('Switch to Table View');
        $(this).addClass('info-active');
        $('.btn-table-view').removeClass('info-active');
        calendar();
    });

    $(document).off('click','.btn-table-view').on('click','.btn-table-view', function(e){
        e.preventDefault();
        $('#hol_calendar').slideUp('slow');
        $('#hol_tab_data').slideDown('slow');
        $('#holiday_toolbars').slideDown('slow');
        $('#switch_lable').text('Switch to Calendar View');
        $(this).addClass('info-active');
        $('.btn-calendar-view').removeClass('info-active');
    });
</script>
