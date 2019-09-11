<div class="m-content">
    <div class="row">
        <div class="col col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__body">
                    <!--begin: Search Form -->
                    <div class="m-form m-form--label-align-right m--margin-top-bottom">
                        <div class="row align-items-center">
                            <div class="col-xl-6 order-2 order-xl-1">
                                <div class="form-group m-form__group row align-items-center">
                                    <div class="col-md-12">
                                        <div class="m-input-icon m-input-icon--left">
                                            <input type="text" class="form-control m-input" placeholder="Search..."
                                                   id="generalSearch">
                                            <span class="m-input-icon__icon m-input-icon__icon--left">
                                                <span>
                                                    <i class="la la-search"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 order-1 order-xl-2 m--align-right">
                                <a href="#" data-modal-route="rate_plan/add" class="btn m-btn--pill btn-outline-info btn-sm m-btn m-btn--custom no-m-i">
                                    <span>
                                        <i class="la la-plus"></i>
                                        <span>
                                            Add Rate Plan
                                        </span>
                                    </span>
                                </a>

                                <div class="m-separator m-separator--dashed d-xl-none"></div>
                            </div>
                        </div>
                    </div>
                    <!--end: Search Form -->
                    <!--begin: Datatable -->
                    <div class="rate_plan_datatable"></div>
                    <!--end: Datatable -->
                </div>
            </div>
        </div>
        <div class="col col-sm-12 col-md-12 col-lg-8 col-xl-8" id="singleRatePlan">
            @if(isset($rate_plan))
            @include('default.pages.settings.ratePlan.includes.single_rate_plan')
            @endif
        </div>
    </div>
 </div>
