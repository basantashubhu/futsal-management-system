<div class="m-portlet m-portlet--mobile active_class_border">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    {{ucfirst($rate_plan->plan_name)}}
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <div class="row">
                <div class="col no-pd-right">

                </div>
                <div class="col-auto">
<!--                     <button type="button" data-modal-route="rate/multiple_add/{{$rate_plan->id}}" class="btn m-btn--pill btn-outline-success btn-sm m-btn m-btn--custom no-m-i" title="Add Rate">
                        <i class="la la-plus"></i> Add Multiple Rate
                    </button> -->
                    <button type="button" data-modal-route="rate/add/{{$rate_plan->id}}" class="btn m-btn--pill btn-outline-info btn-sm m-btn m-btn--custom no-m-i" title="Add Rate">
                        <i class="la la-plus"></i> Add Rate
                    </button>
                    <button type="button" data-modal-route="rate_plan/edit/{{$rate_plan->id}}" class="btn m-btn--pill btn-outline-accent btn-sm m-btn m-btn--custom no-m m-l-5" title="Edit Rate Plan">
                        <i class="la la-edit"></i> Edit Rate Plan
                    </button>
<!--                     <button type="button" class="btn btn-outline-metal btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill no-m-i" title="Prints">
                        <i class="la la-print"></i>
                    </button> -->
                </div>
            </div>
        </div>
    </div>
    <div class="m-portlet__body">
        <!-- Application Detail Summary -->
        <div class="row no-m pd-b-20">
            <div class="col-sm-12 col-md-12 no-pd-i">
                <div class="app-col-seperator height-100">
                    <span class="custom-header std-header app-col-header app-header">Summary</span>
                    <div class="app-col-body">
                        <div class="row m-row--row-separator-xl">
                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <div class="row lh-26">
                                    <div class="col-sm-12 col-md-6 col-lg-5 header">Rate Plan</div>
                                    <div class="col-sm-12 col-md-6 col-lg-7">{{ucfirst($rate_plan->plan_name)}}</div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <div class="row lh-26">
                                    <div class="col-sm-12 col-md-6 col-lg-5 header">Start Date</div>
                                    <div class="col-sm-12 col-md-6 col-lg-7">{{format_date($rate_plan->start_date)}}</div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <div class="row lh-26">
                                    <div class="col-sm-12 col-md-6 col-lg-5 header">End Date</div>
                                    <div class="col-sm-12 col-md-6 col-lg-7">{{format_date($rate_plan->end_date)}}</div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Rates -->
        <div class="row">
            <div class="col">
                <div class="app-col-seperator m-b-30">
                    <div class="app-col-header">
                        <div class="app-header std-header custom-header">Rates</div>
                        <div class="tools">
                            <!--begin: Selected Rows Group Action Form -->
                            <div class="m-form m-form--label-align-right collapse" id="m_datatable_group_action_form">
                                <div class="m-form__group m-form__group--inline">
                                    <div class="m-form__control">
                                        <div class="btn-toolbar">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-accent btn-sm dropdown-toggle" data-toggle="dropdown">
                                                    Select
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <button class="dropdown-item" data-modal-route="application/detail/sandbox/add_treatment_plan/1">
                                                        Procedure
                                                    </button>
                                                    <button class="dropdown-item" data-modal-route="application/detail/sandbox/add_treatment_plan/1">
                                                        Provider
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- &nbsp;&nbsp;&nbsp;
                                            <button class="btn btn-sm btn-success" type="button" data-toggle="modal" data-target="#m_modal_fetch_id">
                                                Fetch Selected Records
                                            </button> -->
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!--end: Selected Rows Group Action Form -->
                        </div>
                    </div>

                    <div class="app-col-body">
                        <div class="rate_datatable" id="auto_column_hide"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Rates End -->
        <div class="row no-m pd-b-20">
            <div class="col-sm-12 col-md-12 no-pd-i">
                <div class="app-col-seperator height-100">
                    <span class="custom-header std-header app-col-header app-header">Description</span>
                    <div class="app-col-body">
                        <div class="row m-row--row-separator-xl">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="row lh-26">
                                    <div class="col-sm-12 col-md-12 col-lg-12">{!! $rate_plan->description !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row no-m pd-b-20">
            <div class="col-sm-12 col-md-12 no-pd-i">
                <div class="app-col-seperator height-100">
                    <span class="custom-header std-header app-col-header app-header">Includes</span>
                    <div class="app-col-body">
                        <div class="row m-row--row-separator-xl">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="row lh-26">
                                    <div class="col-sm-12 col-md-12 col-lg-12">{!! $rate_plan->includes !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!--         <div class="row no-m pd-b-20">
            <div class="col-sm-12 col-md-12 no-pd-i">
                <div class="app-col-seperator height-100">
                    <span class="custom-header std-header app-col-header app-header">Terms</span>
                    <div class="app-col-body">
                        <div class="row m-row--row-separator-xl">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="row lh-26">
                                    <div class="col-sm-12 col-md-12 col-lg-12">{!! $rate_plan->terms !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row no-m pd-b-20">
            <div class="col-sm-12 col-md-12 no-pd-i">
                <div class="app-col-seperator height-100">
                    <span class="custom-header std-header app-col-header app-header">Notes</span>
                    <div class="app-col-body">
                        <div class="row m-row--row-separator-xl">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="row lh-26">
                                    <div class="col-sm-12 col-md-12 col-lg-12">{!! $rate_plan->notes !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>
@include('default.pages.settings.ratePlan.includes.rate_js')