<div class="m-content">
    <div class="m-portlet m-portlet--mobile with-border">
        <div class="m-portlet__body">
            <!--begin: Search Form -->
            <div class="global-filter row no-gutters">
                <div class="col-lg-12">
                    <div class="m-portlet no-m-i m-portlet--bordered-semi">
                        <div class="m-portlet__body">
                            <div class="m-form m-form--label-align-right">
                                <div class="form-group m-form__group row justify-content-start align-items-center toolbar justify-content-start">
                                    <!-- Advance Filter -->
                                    <!-- Advance Filter -->
                                    <form class="form form-inline" id="payPeriodSearch">
                                        <div class="col-auto">
                                            <div class="m-form__group m-form__group--inline w-220 pill-style">
                                                <div class="m-form__label left">
                                                    <label class="m-label m-label--single">
                                                        Name
                                                    </label>
                                                </div>
                                                <div class="m-form__control custom-selecter-btn">
                                                    <input type="text" class="form-control btn-redius form-control-sm" name="name" id="orgname">
                                                </div>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div> 
                                        <div class="col-auto dateRangePicker">
                                            <div class="date_filter">
                                            <span class="m-subheader__daterange"
                                                id="payPeriodDateRangePicker">
                                                <span class="m-subheader__daterange-label">
                                                    <span class="m-subheader__daterange-date m--font-brand"></span>
                                                    <input type="hidden" name="date_range"
                                                        id="ApplicationDateRange">
                                                </span>
                                                <a class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                                                    <i class="la la-angle-down"></i>
                                                </a>
                                            </span>
                                            </div>
                                        </div>
                                        <!-- <div class="col-auto">
                                            <div class="m-form__group m-form__group--inline w-220 pill-style">
                                                <div class="m-form__label left">
                                                    <label class="m-label m-label--single">
                                                        Date
                                                    </label>
                                                </div>
                                                <div class="m-form__control custom-selecter-btn">
                                                    <input type="text" class="form-control btn-redius dpicker" name="section">
                                                </div>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div> -->

                                        <!-- <div class="col-auto">
                                            <div class="m-form__group m-form__group--inline w-220 pill-style">
                                                <div class="m-form__label left">
                                                    <label class="m-label m-label--single">
                                                        Start Date
                                                    </label>
                                                </div>
                                                <div class="m-form__control custom-selecter-btn">
                                                    <input type="text" class="form-control btn-redius" name="section" id="TemplateSection">
                                                </div>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div> -->
                                        <button type="button" class="hidden" id="searchBtn" data-target="payPeriodSearch"></button>
                                    </form>
                                    <div class="col-auto">
                                        <button title="Reset Search" data-route="organizations" class="btn btn-sm btn-outline-primary  m-btn m-btn--outline-2x m-btn--icon m-btn--icon-only m-btn--pill">
                                            <i class="fa fa-undo"></i>
                                        </button>
                                    </div>
                                    <div class="col text-right">
                                        <div class="m-btn-group m-btn-group--pill btn-group"
                                                role="group"
                                                aria-label="Button group with nested dropdown">
                                            <div class="m-btn-group btn-group" role="group">
                                                <button id="ietableExport" type="button"
                                                        class="btn btn-warning btn-sm m-btn m-btn--pill-last br-60 dropdown-toggle showInBig"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                    Export as
                                                </button>
                                                <button id="ietableExport" type="button"
                                                        class="btn btn-warning btn-sm m-btn m-btn--pill-last br-60 dropdown-toggle showInMedium"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                    <i class="la la-bars"></i>
                                                </button>
                                                <div class="dropdown-menu"
                                                        aria-labelledby="ietableExport"
                                                        x-placement="bottom-start">
                                                    <button class="c-p dropdown-item payPeriodExporter" data-sort-field="start_date" data-sort-value="desc" data-export-type="csv">
                                                        CSV
                                                    </button>
                                                    <button class="c-p dropdown-item payPeriodExporter" data-sort-field="start_date" data-sort-value="desc" data-export-type="json">
                                                        JSON
                                                    </button>
                                                    <button class="c-p dropdown-item payPeriodExporter" data-sort-field="start_date" data-sort-value="desc" data-export-type="pdf">
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
            <!--end: Search Form -->
            <!--begin: Datatable -->
            <div class="d_template_datatable m-t-10" id="orgn_data_table"></div>
            <!--end: Datatable -->
        </div>
    </div>
</div>
<script>
// initDatepicker();
// TopDateLoader('#payPeriodDateRangePicker');
</script>