<style>
    .fc-unthemed .fc-event, .fc-unthemed .fc-event-dot {
        background: #ffc0cb;
        border: 1px solid #ffc0cb;
        -webkit-box-shadow: 0px 1px 15px 1px rgba(69, 65, 78, 0.08);
        -moz-box-shadow: 0px 1px 15px 1px rgba(69, 65, 78, 0.08);
        box-shadow: 0px 1px 15px 1px rgb(255, 192, 203);
    }
    .fc-body .active_row {
     background-color: #111 !important; 
    }

    .fc-event--holiday .fc-title {
        color: #000 !important;
        font-size: 12px !important;
    }
    .fc-day-grid-event > .fc-content {
    white-space: normal;
    text-overflow: ellipsis;
    max-height:none;
    margin-top: -25px;
}
</style>
<div id="m_supervisor_calendar_div" class="row">
{{--     <div class="col-lg-3">
        <!--begin::Portlet-->
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon">
                            <i class="fa fa-asterisk"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            Index
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div id="m_calendar_external_events" class="fc-unthemed">
                    <div class="fc-event fc-event-external fc-start m-fc-event--holiday m--margin-bottom-15 ui-draggable ui-draggable-handle" data-color="m-fc-event--primary">
                        <div class="fc-title">
                            <div class="fc-content">Holiday</div>
                        </div>
                    </div>
                    <div class="fc-event fc-event-external fc-start m-fc-event--info m--margin-bottom-15 ui-draggable ui-draggable-handle" data-color="m-fc-event--success">
                        <div class="fc-title">
                            <div class="fc-content">Upcomming Schedule</div>
                        </div>
                    </div>
                    <div class="fc-event fc-event-external fc-start m-fc-event--metal m--margin-bottom-15 ui-draggable ui-draggable-handle" data-color="m-fc-event--metal">
                        <div class="fc-title">
                            <div class="fc-content">Past Schedule</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--end::Portlet-->
    </div> --}}
    <div class="col-lg-12">
        <div id="m_holiday_calendar" style="height: 650px;"></div>
    </div>
</div>
@include('default.fgp.holiday.inc.holiday_calendar_script')
