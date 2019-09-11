<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Report by Provider
            </h3>

        </div>
        <form class="reportSearchForm row" >
            <div class="m-form__control custom-selecter-btn float-left m-l-15 m-r-10">
                <select class="form-control m-bootstrap-select m-input m-input--air m-input--pill"
                        id="serviceProviderFilter" name="provider"
                        multiple data-width="250px" title="Select Provider" data-selected-text-format="count > 3">
                    @foreach($providers as $provider)
                        @if(!is_null($pid))
                            <option value="{{$provider->id}}" {{in_array($provider->id,$pid)?'selected':''}}>{{$provider->cname}}</option>
                        @else
                            <option value="{{$provider->id}}">{{$provider->cname}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-auto no-pd">
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
                        <button class="c-p dropdown-item exportReportData" data-export-type="csv"
                                data-target="provider">
                            CSV
                        </button>
                        <button class="c-p dropdown-item exportReportData" data-export-type="json"
                                data-target="provider">
                            JSON
                        </button>
                        <button class="c-p dropdown-item exportReportData" data-export-type="pdf"
                                data-target="provider">
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

<!-- END: Subheader -->