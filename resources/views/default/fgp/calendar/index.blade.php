<style>
    
    .fc-event--holiday {
        background-color: pink !important;
        border-color: pink !important;
        color: #ffffff !important;
    }
    .fc-event--holiday .fc-title {
        color: #ffffff !important;
    }
    .fc-event--past {
        color: #fff !important;
        background-color: #aeafb5 !important;
        border-color: #aeafb5 !important;
    }
    .fc-event--past .fc-title {
        color: #ffffff !important;
    }

    .m-fc-event--holiday .fc-content:before {
        background: pink !important;
    }

   body .toolbar .m-form__label {
        background-color: #f2f3f8;
        padding-left: 10px;
        border-radius: 30px;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .calendar-view-act-btns{
        display: none;
    }      

    .cal-lists{
        padding:0;
        padding-right: 10px;
        list-style: none;
        margin-top: 10px;
        height: 565px;
        overflow-y: auto;
    }
    
   

    .cal-lists li{                                                
        padding: 10px;
        border-bottom: 1px solid #e8e8e8;
        background: white;
    }
    .cal-lists li:hover{
        background-color: #f9f9f9;
        transition: all 300ms ease-in-out;
        cursor: pointer; 
    }
    .cal-lists .active{
        background: #dc3545 !important;
        color: white;
        transition: all 600ms ease-in-out;
        padding: 10px;
        display: block;
    }  

    .hide-list{
        display: none;
    }

    .show-list{
        display: block;
    }

    .cal-site-vol-ul{
        padding-left: 15px;
        list-style: none;
        margin: 10px 0;
        display: none;
    }

    .cal-site-vol-ul li:last-child{
        border-bottom: none;
    }

    .cal-site-vol-ul li:hover{
        background: white !important;
    }

    .sub-class-active{
        background-color: #e8e8e8 !important;
    }


    /* width */
    ::-webkit-scrollbar {
      width: 3px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
      background: #f1f1f1; 
    }
     
    /* Handle */
    ::-webkit-scrollbar-thumb {
      background: #028fb8; 
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
      background: #028fb8; 
      cursor: pointer;
    }


</style>
<div class="m-subheader">
    <div class="d-flex align-items-center">
        
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Calendar
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
                <li class="m-nav__item m-menu__item--expanded m-menu__item--open">
                    <a data-route="calendarSchedules" class="m-nav__link">
                        <span class="m-nav__link-text">
                            Calendar
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="ml-auto calendar-default-act-btns">
            {{-- <button title="Calender View" class="btn btn-sm btn-outline-primary mr-10 m-btn m-btn--outline-2x m-btn--icon m-btn--icon-only m-btn--pill btn-calendar-view">
                <i class="la la-calendar"></i>
            </button>
            <button title="Table View" class="btn btn-sm btn-outline-primary mr-10 m-btn m-btn--outline-2x m-btn--icon m-btn--icon-only m-btn--pill btn-table-view">
                <i class="la la-table"></i>
            </button> --}}
            <button class="btn btn-default m-btn btn-sm m-btn--custom m-btn--icon m-btn--pill" >
                <span>
                    <i class="fa fa-print"></i>
                    <span>
                        Print
                    </span>
                </span>
            </button>
        </div>
        <div class="ml-auto calendar-view-act-btns" >
            
            {{-- <button class="btn btn-default m-btn btn-sm m-btn--custom m-btn--icon m-btn--pill clear-all-templates" style="margin-right: 10px">
                <span>
                    <i class="la la-refresh"></i>
                    <span>
                        Load Default Template
                    </span>
                </span>
            </button> --}}

            <button class="btn btn-default m-btn btn-sm m-btn--custom m-btn--icon m-btn--pill back-to-calendar" >
                <span>
                    <i class="la la-arrow-left"></i>
                    <span>
                        Back
                    </span>
                </span>
            </button>            
        </div>
    </div>
</div>
<div class="m-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="m_calendar_time_Changable" id="m_portlet" style="background-color: #f2f3f8">
                
                <div class="m-portlet__body">
                    <div id="calendar-table-data" style="display: none">
                        <div class="d_template_datatable" id="calendar_data_table"></div>
                    </div>
                    <div id="m_supervisor_calendar_div" class="row">
                        <div class="col-lg-3">
                            <div class="vol-ts-details ts-tab-holder m-portlet m-portlet--mobile m-portlet--body-progress- with-border" style="padding-bottom: 30px; padding: 20px">

                                <ul class="nav nav-tabs  m-tabs-line m-tabs-line--2x m-tabs-line--danger no-m-bottom" role="tablist">     

                                  <li class="nav-item m-tabs__item no-m-right no-pd-bottom" style="min-width: 55px" 
                                  >
                                    <a class="nav-link m-tabs__link active" data-toggle="tab" href="#calendar-site-tab" role="tab" style="height: 100%;">
                                      Tab 1
                                    </a>
                                  </li>  
                                  <li class="nav-item m-tabs__item no-m-right no-pd-bottom" 
                                  >
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#calendar-vol-tab" role="tab" style="height: 100%;">
                                      Tab 2
                                    </a>
                                  </li>     

                                </ul>

                                <div class="tab-content ts-panel-tab-content">
                                    <div class="tab-pane active" id="calendar-site-tab">
                                        <div class="m-t-10 cal-site-search">                                         
                                            
                                            <div class="cal-site-searcher" style="flex: 1">
                                                <div class="input-group">
                                                    <input type="text" class="form-control m-input cal-list-search" placeholder="Search" aria-describedby="basic-addon2" data-search-to="sites">
                                                    <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="flaticon-search-1"></i></span></div>
                                                </div>
                                            </div>
                                        </div>                                       

                                        <ul class="cal-lists" data-list-type="sites">
                                            @forelse([] as $site)
                                                <li>
                                                    <span>
                                                        Lorem ipsum dolor sit amet. 
                                                    </span>                                              
                                                </li>
                                            @empty
                                                <li>No data available.</li>
                                            @endforelse
                                           
                                        </ul>
                                    </div>
                                    <div class="tab-pane " id="calendar-vol-tab">
                                        <div class="m-t-10 cal-vol-search">                                         
                                            
                                            <div class="cal-vol-searcher" style="flex: 1">
                                                <div class="input-group">
                                                    <input type="text" class="form-control m-input cal-list-search" placeholder="Search" aria-describedby="basic-addon2" data-search-to="volunteers">
                                                    <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="flaticon-search-1"></i></span></div>
                                                </div>
                                            </div>
                                        </div>                                        

                                        <ul class="cal-lists" data-list-type="volunteers">
                                            @forelse([] as $cal_vol)
                                                <li>
                                                    <i class="fa fa-user"></i> Lorem, ipsum.
                                                </li>
                                            @empty
                                                <li>No data available.</li>
                                            @endforelse
                                           
                                        </ul>
                                    </div>
                                    
                                </div>    
                            </div> 

                           
                        </div>
                        <div class="col-lg-9">
                            <div class="m-portlet m-portlet--mobile m-portlet--body-progress- with-border" style="background-color: white; padding: 10px">
                                <div id="m_supervisor_calendar" ></div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="m-portlet" id="m_member_calendar_detail" style="display: none;">
            </div>

            <div class="row">
                {{--  View  --}}
                <div id="m_calendar_time_detail" class="col-md-12 no-pd"  style="display: none;"></div>
            </div>
        </div>

    </div>
</div>
@include('default.fgp.calendar._partials._calendar')
@include('default.fgp.calendar._partials._js')

<script>

    sup_calender();   
    
    $(document).off('click', 'table tbody tr').on('click', 'table tbody tr', function (e) {
        e.stopPropagation();
        e.preventDefault();
    });

    $(document).off('click', '.sup_calendar_back').on('click', '.sup_calendar_back', function (e) {
        e.preventDefault();
        $('#m_calendar_time_detail').slideUp('slow');
        $('.m_calendar_time_Changable').slideDown('slow');
    });

    $(document).off('click','.btn-calendar-view').on('click','.btn-calendar-view', function(e){
        e.preventDefault();
        $('#calendar-table-data').slideUp('slow');
        $('#m_supervisor_calendar_div').slideDown('slow');
        $('#calander-table-toolbar').hide();
        $('#calander-view-toolbar').show();
        $('#switch_lable').text('Switch to Table View');
    });
    $(document).off('click','.btn-table-view').on('click','.btn-table-view', function(e){
        e.preventDefault();
        $('#calander-view-toolbar').hide();
        $('#calander-table-toolbar').show();
        $('#m_supervisor_calendar_div').slideUp('slow');
        $('#calendar-table-data').slideDown('slow');
        $('#switch_lable').text('Switch to Calendar View');
    });


    $(document).off('click', '.cal-lists>li').on('click', '.cal-lists>li', function(e){

        e.preventDefault();

        let listType = $(this).closest('.cal-lists').attr('data-list-type');

        $(this).find('span').addClass('active');
        $(this).siblings().find('span').removeClass('active');
        $(this).siblings().find('.cal-site-vol-ul').slideUp();
        $(this).siblings().find('.cal-site-vol-ul li').removeClass("sub-class-active");

        $(this).find('.cal-site-vol-ul').slideDown();
        // $(this).parent().siblings().find('.cal-site-vol-ul').removeClass('sub-class-active');

        let options = {
            method: 'get',
            loader: true 
        }

        if(listType === "volunteers"){

            let vol_id = $(this).attr('data-vol-id');

            options.url = 'fetch/calendarByVolunteer/'+vol_id;

        }else{

            let site_id = $(this).attr('data-site-id');

            options.url = 'fetch/calendarBySite/'+site_id;

        }        

        sendAjax(options, function(response){

            $("#m_supervisor_calendar").fullCalendar('removeEventSource', 'calendar_dashboard');
            $("#m_supervisor_calendar").fullCalendar('removeEvents');
            $("#m_supervisor_calendar").fullCalendar('addEventSource', response);
            $("#m_supervisor_calendar").fullCalendar('rerenderEvents', response);
            

        }, function(error){

            toastr.error("problem fetchin volunteer details");

        })


    });

    $(document).off('click', '.cal-site-vol-ul li').on('click', '.cal-site-vol-ul li', function(e){

        e.stopPropagation();

        let vol_id = $(this).attr('data-vol-id');

        $(this).addClass('sub-class-active');
        $(this).siblings().removeClass('sub-class-active');

        let options = {
            method: 'get',
            loader: true 
        }

        options.url = 'fetch/calendarByVolunteer/'+vol_id;

        sendAjax(options, function(response){

            $("#m_supervisor_calendar").fullCalendar('removeEventSource', 'calendar_dashboard');
            $("#m_supervisor_calendar").fullCalendar('removeEvents');
            $("#m_supervisor_calendar").fullCalendar('addEventSource', response);
            $("#m_supervisor_calendar").fullCalendar('rerenderEvents', response);
            $("#m_supervisor_calendar").fullCalendar({lazyFetching : true});
            

        }, function(error){

            toastr.error("problem fetchin volunteer details");

        })

    });

    /* Shows the index calendar view */

    $('.back-to-calendar').on('click', function(e){

        $('.m_calendar_time_Changable').slideDown('slow');
        $('.calendar-default-act-btns').slideDown('slow');
        $('#m_calendar_time_detail').hide();
        $('.calendar-view-act-btns').hide();


    });

</script>