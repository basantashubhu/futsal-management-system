
<div class="m-content ">
    <div class="m-portlet m-portlet--mobile with-border">
        <div class="m-portlet__body">
            <!--begin: Search Form -->
            <div class="m-form m-form--label-align-right m--margin-top-bottom">
                <div class="form-group m-form__group row justify-content-start align-items-center toolbar justify-content-start">
                    <!-- Advance Filter -->
                    <!-- Advance Filter -->
                    <form class="form form-inline" id="usersLogs">
                        <div class="col-auto">
                            <div class="input-group m-input-group" style="border-radius: 20px !important;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"
                                          style="background-color: #f2f3f8 !important; border-top-left-radius: 20px;border-bottom-left-radius: 20px; height: 27px; border: none !important;">
                                        Name
                                    </span>
                                </div>
                                    <input type="text"
                                           name="name" id="UserName"
                                           class="form-control m-input applicationIDFilter"
                                           style="height: 27px; border-top-right-radius: 20px;border-bottom-right-radius: 20px;"
                                           >
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="input-group m-input-group" style="border-radius: 20px !important;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"
                                          style="background-color: #f2f3f8 !important; border-top-left-radius: 20px;border-bottom-left-radius: 20px; height: 27px; border: none !important;">
                                        Fingerprint
                                    </span>
                                </div>
                                    <input type="text"
                                           name="fingerprint" id="LogFingerprint"
                                           class="form-control m-input applicationIDFilter"
                                           style="height: 27px; border-top-right-radius: 20px;border-bottom-right-radius: 20px;"
                                           >
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="input-group m-input-group" style="border-radius: 20px !important;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"
                                          style="background-color: #f2f3f8 !important; border-top-left-radius: 20px;border-bottom-left-radius: 20px; height: 27px; border: none !important;">
                                        Browser
                                    </span>
                                </div>
                                    <input type="text"
                                           name="browser" id="LogBrowser"
                                           class="form-control m-input applicationIDFilter"
                                           style="height: 27px; border-top-right-radius: 20px;border-bottom-right-radius: 20px;"
                                           >
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="input-group m-input-group" style="border-radius: 20px !important;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"
                                          style="background-color: #f2f3f8 !important; border-top-left-radius: 20px;border-bottom-left-radius: 20px; height: 27px; border: none !important;">
                                        OS
                                    </span>
                                </div>
                                    <input type="text"
                                           name="os" id="LogOs"
                                           class="form-control m-input applicationIDFilter"
                                           style="height: 27px; border-top-right-radius: 20px;border-bottom-right-radius: 20px;"
                                           >
                            </div>
                        </div>
                        <button class="hidden" id="searchUsersLogForm" data-target="usersLogs"></button>
                    </form>


                    <div class="col-auto">
                        <button title="Reset Search" data-route="#userlogs" class="btn btn-sm btn-outline-primary  m-btn m-btn--outline-2x m-btn--icon m-btn--icon-only m-btn--pill">
                            <i class="fa fa-undo"></i>
                        </button>
                    </div>
                    {{--<div class="col text-right">
                        <div class="m-btn-group m-btn-group--pill btn-group" role="group" aria-label="Button group with nested dropdown">
                            <div class="m-btn-group btn-group" role="group">
                                <button id="ietableExport" type="button" class="btn btn-warning btn-sm m-btn m-btn--pill-last br-60 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Export as
                                </button>
                                <div class="dropdown-menu" aria-labelledby="ietableExport" x-placement="bottom-start">
                                    --}}{{--<button class="c-p dropdown-item ietable-export" data-export-type="excel">
                                        Excel
                                    </button>
                                    <button class="c-p dropdown-item ietable-export" data-export-type="doc">
                                        Doc
                                    </button>--}}{{--
                                    <button class="c-p dropdown-item server-petexporter" data-export-type="csv">
                                        CSV
                                    </button>
                                    <button class="c-p dropdown-item server-petexporter" data-export-type="txt">
                                        Text
                                    </button>
                                    <button class="c-p dropdown-item server-petexporter" data-export-type="json">
                                        JSON
                                    </button>
                                    <button class="c-p dropdown-item server-petexporter" data-export-type="pdf">
                                        PDF
                                    </button>
                                    <button class="c-p dropdown-item" id="sendEmail" data-modal-route="sendEmailGlobal?table=pets">
                                        Send Email
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>--}}
                </div>
            </div>
            <!--end: Search Form -->
            <!--begin: Datatable -->
            <div class="m_datatable" id="auto_column_hide"></div>
            <!--end: Datatable -->
        </div>
    </div>
</div>