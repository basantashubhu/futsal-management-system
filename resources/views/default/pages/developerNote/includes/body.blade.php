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
                                    <form id="developerQuickSearch" class="form-inline">
                                        <div class="col-auto">
                                            <div class="m-form__group m-form__group--inline w-220 pill-style">
                                                <div class="m-form__label left">
                                                    <label class="m-label m-label--single">
                                                        Status
                                                    </label>
                                                </div>
                                                <div class="m-form__control custom-selecter-btn">
                                                    <select class="form-control m-bootstrap-select m-input m-input--air m-input--pill" id="developerNoteStatusFilter"
                                                            multiple data-width="200px" title="Select Status" data-style="btn-redius" data-selected-text-format="count > 3" name="status">
                                                        <option value="" disabled="">Select Status</option>
                                                        <option value="1" >Completed</option>
                                                        <option value="0" >Pending</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div>
                                    </form>
                                    <div class="col text-right">
                                        <div class="m-btn-group m-btn-group--pill btn-group" role="group" aria-label="Button group with nested dropdown">
                                            <div class="m-btn-group btn-group" role="group">
                                                <button type="button" class="btn btn-warning btn-sm m-btn m-btn--pill-last br-60 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Export as
                                                </button>
                                                <div class="dropdown-menu" x-placement="bottom-start">
                                                    <!-- <button class="c-p dropdown-item developernote-exporter" data-export-type="excel">
                                                        Excel
                                                    </button>
                                                    <button class="c-p dropdown-item developernote-exporter" data-export-type="doc">
                                                        Doc
                                                    </button> -->
                                                    <button class="c-p dropdown-item developernote-exporter" data-export-type="csv">
                                                        CSV
                                                    </button>
                                                    <button class="c-p dropdown-item developernote-exporter" data-export-type="txt">
                                                        Text
                                                    </button>
                                                    <button class="c-p dropdown-item developernote-exporter" data-export-type="json">
                                                        JSON
                                                    </button>
                                                    <button class="c-p dropdown-item developernote-exporter" data-export-type="pdf">
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
            <div class="m_datatable" id="developernoteTable"></div>
            <!--end: Datatable -->
        </div>
    </div>
</div>
