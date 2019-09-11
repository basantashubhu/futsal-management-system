<div class="m-subheader">
    <div class="d-flex align-items-center">

        <div class="">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Citizen Report
            </h3>
        </div>
        <form class="reportSearchForm">
            <div class="col-auto no-pd float-left">
                <div class="date_filter">
                    <span class="m-subheader__daterange m_report_date_filter" id="m_report_date_filter">
                       <span class="m-subheader__daterange-label">
                            <span class="m-subheader__daterange-date m--font-brand"></span>
                           <input type="hidden" name="dateRange" id="statement" class="data-range-input">
                       </span>
                       <a class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                            <i class="la la-angle-down"></i>
                       </a>
                   </span>
                </div>
            </div>
        </form>
        <div class="col text-right">
            <div class="m-btn-group m-btn-group--pill btn-group" role="group"
                 aria-label="Button group with nested dropdown">
                <div class="m-btn-group btn-group" role="group">
                    <button id="ietableExport" type="button"
                            class="btn btn-warning btn-sm m-btn m-btn--pill-last br-60 dropdown-toggle"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Export as
                    </button>
                    <div class="dropdown-menu" aria-labelledby="ietableExport"
                         x-placement="bottom-start">
                        <button class="c-p dropdown-item exportReportData" data-export-type="csv" data-target="citizen">
                            CSV
                        </button>
                        <button class="c-p dropdown-item exportReportData" data-export-type="json"
                                data-target="citizen">
                            JSON
                        </button>
                        <button class="c-p dropdown-item exportReportData" data-export-type="pdf" data-target="citizen">
                            PDF
                        </button>
                        {{--<button class="c-p dropdown-item" id="sendEmail"--}}
                        {{--data-modal-route="sendEmailGlobal?table=ledger">--}}
                        {{--Send Email--}}
                        {{--</button>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

