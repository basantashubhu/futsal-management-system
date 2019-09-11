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
                                    <form class="form form-inline" id="stipendFilter">
                                        <div class="col-auto">
                                            <div class="m-form__group m-form__group--inline w-220 pill-style">
                                                <div class="m-form__label left">
                                                    <label class="m-label m-label--single">
                                                        Name
                                                    </label>
                                                </div>
                                                <div class="m-form__control custom-selecter-btn">
                                                    <input type="text" class="form-control form-control-sm btn-redius" name="item_name" id="itemName">
                                                </div>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="m-form__group m-form__group--inline w-220 pill-style">
                                                <div class="m-form__label left">
                                                    <label class="m-label m-label--single">
                                                        Code
                                                    </label>
                                                </div>
                                                <div class="m-form__control custom-selecter-btn">
                                                    <input type="text" class="form-control form-control-sm btn-redius" name="item_code" id="itemCode">
                                                </div>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div>

                                        
                                        <button class="hidden" id="quickFormBtn" data-target="stipendFilter"></button>
                                    </form>


                                    <div class="col-auto">
                                        <button title="Reset Search" data-route="location/district" class="btn btn-sm btn-outline-primary  m-btn m-btn--outline-2x m-btn--icon m-btn--icon-only m-btn--pill">
                                            <i class="fa fa-undo"></i>
                                        </button>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end: Search Form -->
            <!--begin: Datatable -->
            <div class="m_datatable m-t-20" id="district_data_table"></div>
            <!--end: Datatable -->
        </div>
    </div>
</div>