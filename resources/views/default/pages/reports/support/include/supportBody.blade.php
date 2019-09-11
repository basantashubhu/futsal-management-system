<div class="m-content" id="supportContent">
    <!--begin:: Widgets/Stats-->
    @include($viewLocation.'.chart')

    <div class="m-portlet m-portlet--mobile with-border">
        <div class="m-portlet__body">

            <div class="m-form m-form--label-align-right m--margin-top-bottom">
                <div class="global-filter row no-gutters">
                    <div class="col-lg-12">
                        <div class="m-portlet no-m-i m-portlet--bordered-semi">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row justify-content-start align-items-center toolbar justify-content-start">
                                    <!-- Advance Filter -->
                                @include($viewLocation.'.advanceSearch')
                                <!-- Advance Filter -->

                                    <form id="SupportReportFilter" class="row">
                                        <div class="col-auto">
                                            <div class="m-form__group m-form__group--inline w-220 pill-style">
                                                <div class="m-form__label left">
                                                    <label class="m-label m-label--single">
                                                        AssignTo
                                                    </label>
                                                </div>
                                                <div class="m-form__control custom-selecter-btn">
                                                    <select class="form-control m-bootstrap-select m-input m-input--pill"
                                                            id="assign_to" title="Assign To" name="assign_to"
                                                            data-style="btn-redius"
                                                            data-width="100%">
                                                        @foreach($users as $user)
                                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div>

                                        <div class="col-auto">
                                            <div class="m-form__group m-form__group--inline w-220 pill-style">
                                                <div class="m-form__label left">
                                                    <label class="m-label m-label--single">
                                                        AssignFrom
                                                    </label>
                                                </div>
                                                <div class="m-form__control custom-selecter-btn">
                                                    <select class="form-control m-bootstrap-select m-input m-input--pill"
                                                            id="assign_from" title="Assign From" name="assign_from"
                                                            data-style="btn-redius"
                                                            data-width="100%">
                                                        @foreach($users as $user)
                                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div>

                                        <div class="col-auto">
                                            <div class="m-form__group m-form__group--inline w-220 pill-style">
                                                <div class="m-form__label left">
                                                    <label class="m-label m-label--single">
                                                        Status
                                                    </label>
                                                </div>
                                                <div class="m-form__control custom-selecter-btn">
                                                    <select class="form-control m-bootstrap-select m-input m-input--pill"
                                                            id="status" title="Select Status" name="status"
                                                            data-style="btn-redius"
                                                            data-width="100%">
                                                        <option value="New">New</option>
                                                        <option value="In Progress">In Progress</option>
                                                        <option value="Assigned">Assigned</option>
                                                        <option value="Complete">Complete</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div>

                                        <div class="col-auto">
                                            <div class="date_filter">
                                    <span class="m-subheader__daterange m_report_date_filter" id="m_report_date_filter">
                                       <span class="m-subheader__daterange-label">
                                            <span class="m-subheader__daterange-date m--font-brand"></span>
                                           <input type="hidden" name="dateRange" id="statement"
                                                  class="data-range-input">
                                       </span>
                                       <a class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                                            <i class="la la-angle-down"></i>
                                       </a>
                                   </span>
                                            </div>
                                        </div>
                                    </form>


                                    <div class="col-auto">
                                        <button title="Reset Search" data-route="report/support"
                                                class="btn btn-sm btn-outline-primary  m-btn m-btn--outline-2x m-btn--icon m-btn--icon-only m-btn--pill">
                                            <i class="fa fa-undo"></i>
                                        </button>
                                    </div>

                                    <div class="col text-right">
                                        <div class="m-btn-group m-btn-group--pill btn-group" role="group" aria-label="Button group with nested dropdown">
                                            <div class="m-btn-group btn-group" role="group">
                                                <button id="supportExporter" type="button" class="btn btn-warning btn-sm m-btn m-btn--pill-last br-60 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Export as
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="supportExporter" x-placement="bottom-start">
                                                    <button class="c-p dropdown-item supportReportExporter" data-export-type="csv">
                                                        CSV
                                                    </button>

                                                    <button class="c-p dropdown-item supportReportExporter" data-export-type="json">
                                                        JSON
                                                    </button>

                                                    <button class="c-p dropdown-item supportReportExporter" data-export-type="pdf">
                                                        PDF
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--begin: Datatable -->
            <div class="support_datatable" id="auto_column_hide"></div>
            <!--end: Datatable -->
        </div>
    </div>
</div>