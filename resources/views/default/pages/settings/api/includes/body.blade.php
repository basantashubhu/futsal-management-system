<div class="m-content">
    <div class="m-portlet m-portlet--mobile with-border">
        <div class="m-portlet__body">
            <!--begin: Search Form -->
            <div class="m-form m-form--label-align-right m--margin-top-bottom">
                <div class="row align-items-center">
                    <div class="col-xl-8 order-2 order-xl-1">

                        <div class="m-form m-form--label-align-right m--margin-top-bottom">
                            <div class="global-filter row no-gutters">
                                <div class="col-lg-12">
                                    <div class="m-portlet no-m-i m-portlet--bordered-semi">
                                        <div class="m-portlet__body">
                                            <div class="form-group m-form__group row justify-content-start align-items-center toolbar justify-content-start">
                                                <div class="col-auto">
                                                    <div class="m-form__group m-form__group--inline w-220 pill-style">
                                                        <div class="m-form__label left">
                                                            <label class="m-label m-label--single">
                                                                ID
                                                            </label>
                                                        </div>
                                                        <div class="m-form__control custom-selecter-btn">

                                                            <input class="form-control m-input form-control-sm"
                                                                   type="text" value="" name="ownername"
                                                                   id="APIidFilter">
                                                        </div>
                                                    </div>
                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="m-form__group m-form__group--inline w-220 pill-style">
                                                        <div class="m-form__label left">
                                                            <label class="m-label m-label--single">
                                                                Key
                                                            </label>
                                                        </div>
                                                        <div class="m-form__control custom-selecter-btn">

                                                            <input class="form-control m-input form-control-sm"
                                                                   type="text" value="" name="ownername"
                                                                   id="ApiKeyName">
                                                        </div>
                                                    </div>
                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="m-form__group m-form__group--inline w-220 pill-style">
                                                        <div class="m-form__label left">
                                                            <label class="m-label m-label--single">
                                                                Client
                                                            </label>
                                                        </div>
                                                        <div class="m-form__control custom-selecter-btn">
                                                            <input class="form-control m-input form-control-sm"
                                                                   type="text" value="" name="ownername"
                                                                   id="ApiClientName">
                                                        </div>
                                                    </div>
                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="m-form__group m-form__group--inline w-220 pill-style">
                                                        <div class="m-form__label left">
                                                            <label class="m-label m-label--single">
                                                                Redirect
                                                            </label>
                                                        </div>
                                                        <div class="m-form__control custom-selecter-btn">
                                                            <input class="form-control m-input form-control-sm"
                                                                   type="text" value="" name="ownername"
                                                                   id="ApiRedirectName">
                                                        </div>
                                                    </div>
                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                        <a href="#" data-modal-route="client/api/create"
                           class="btn btn-info m-btn m-btn--custom m-btn--icon m-btn--pill">
        					<span>
        						<i class="la la-plus"></i>
        						<span>
        							Add Key
        						</span>
        					</span>
                        </a>

                        <div class="m-separator m-separator--dashed d-xl-none"></div>
                    </div>
                </div>
            </div>
            <!--end: Search Form -->
            <!--begin: Datatable -->
            <div class="client_api_database" id="auto_column_hide"></div>
            <!--end: Datatable -->
        </div>
    </div>
</div>