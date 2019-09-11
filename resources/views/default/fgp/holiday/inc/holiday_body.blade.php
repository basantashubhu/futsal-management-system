<style>
.custom_tabs .nav.nav-tabs{
    margin-bottom: 0px;
}
.custom_tabs .nav-tabs .nav-item {
    margin-bottom: -2px;
}
.custom_tabs .tab-content{
    border-left: 1px solid #dee2e6;
    border-right: 1px solid #dee2e6;
    border-bottom: 1px solid #dee2e6;
    padding: 10px;
    background-color: #fff;
    border-bottom-right-radius: 0.25rem;
    border-bottom-left-radius: 0.25rem;
    border-top-right-radius: 0.25rem;
}
.fc-event--holiday {
    background-color: pink !important;
    border-color: pink !important;
    color: #fff !important;
}
.fc-event--holiday .fc-title{
    color: #fff !important;
}
.fc-time{
    display: none;
}
</style>
<div style="padding-bottom: 50px;">
    <div id="hol_tab_data">
    @include('default.fgp.holiday.inc.table_body')
    </div>
    <div id="hol_calendar" style="display: none;">
    @include('default.fgp.holiday.inc.calendar_body')
    </div>
</div>