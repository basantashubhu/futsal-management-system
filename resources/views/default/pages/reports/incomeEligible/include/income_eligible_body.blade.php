<div class="m-content" id="ieContent" data-dateRange="{{$dateRange}}">
    <!--begin:: Widgets/Stats-->
    @include($viewLocation.'.chart')

    <div class="m-portlet m-portlet--mobile with-border">
        <div class="m-portlet__body">
            <!--begin: Datatable -->
            <div class="ieReport_table" id="auto_column_hide"></div>
            <!--end: Datatable -->
        </div>
    </div>
</div>