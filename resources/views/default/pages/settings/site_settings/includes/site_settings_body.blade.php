<div class="m-content">
    <div class="m-portlet m-portlet--mobile with-border">
        <div class="m-portlet__body">
            <!--begin: Search Form -->
            <div class="m-form m-form--label-align-right m--margin-top-bottom">
                <div class="global-filter row no-gutters">
                    <div class="col-lg-12">
                        <div class="m-portlet no-m-i m-portlet--bordered-semi">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row justify-content-start align-items-center toolbar justify-content-start">
                                    <form class="form form-inline w-100" id="InvoiceFilterForm">
                                        <div class="col-auto">
                                            <div class="m-form__group m-form__group--inline w-220 pill-style">
                                                <div class="m-form__label left">
                                                    <label class="m-label m-label--single">
                                                        Code
                                                    </label>
                                                </div>
                                                <div class="m-form__control custom-selecter-btn">
                                                    <input class="form-control m-input form-control-sm  btn-redius" type="text" value="" name="code" id="SiteCode" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="m-form__group m-form__group--inline w-220 pill-style">
                                                <div class="m-form__label left">
                                                    <label class="m-label m-label--single">
                                                        Value
                                                    </label>
                                                </div>
                                                <div class="m-form__control custom-selecter-btn">
                                                    <input class="form-control m-input form-control-sm  btn-redius" type="text" value="" name="value" id="SiteValue" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div>
                                        <div class="col-auto">
                                            <button title="Reset Search" data-route="site_settings" class="m-portlet__nav-link btn btn-sm btn-brand  m-btn m-btn--outline-2x m-btn--icon m-btn--icon-only m-btn--pill ">
                                                <i class="fa fa-undo"></i>
                                            </button>
                                        </div>
                                        <div class="col text-right">
                                            <div class="m-btn-group m-btn-group--pill btn-group" role="group" aria-label="Button group with nested dropdown">
                                                <div class="m-btn-group btn-group" role="group">

                                                    <button id="ietableExport" type="button" class="btn btn-warning btn-sm m-btn m-btn--pill-last br-60 dropdown-toggle showInBig" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Export as
                                                    </button>
                                                    <button id="ietableExport" type="button" class="btn btn-warning btn-sm m-btn m-btn--pill-last br-60 dropdown-toggle showInMedium" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="la la-bars"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="ietableExport" x-placement="bottom-start">
                                                        <button class="c-p dropdown-item siteSettingExporter" data-sort-field="code" data-sort-value="desc" data-export-type="csv">
                                                            CSV
                                                        </button>
                                                        <button class="c-p dropdown-item siteSettingExporter" data-sort-field="code" data-sort-value="desc" data-export-type="pdf">
                                                            PDF
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end: Search Form -->
            <!--begin: Datatable -->
            <div class="site_datatable" id="auto_column_hide"></div>
            <!--end: Datatable -->
        </div>
    </div>
</div>