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
                                    <form class="form form-inline" id="InvoiceFilterForm">

                                        <div class="col-auto">
                                            <div class="m-form__group m-form__group--inline w-220 pill-style">
                                                <div class="m-form__label left">
                                                    <label class="m-label m-label--single">
                                                        TableName
                                                    </label>
                                                </div>
                                                <div class="m-form__control custom-selecter-btn">
                                                    <input class="form-control m-input form-control-sm btn-redius" type="text" value="" name="tablename" id="TableName" >
                                                </div>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div>

                                        <div class="col-auto">
                                            <div class="m-form__group m-form__group--inline w-220 pill-style">
                                                <div class="m-form__label left">
                                                    <label class="m-label m-label--single">
                                                        Tableid
                                                    </label>
                                                </div>
                                                <div class="m-form__control custom-selecter-btn">
                                                    <input class="form-control m-input form-control-sm btn-redius" type="text" value="" name="tableid" id="TableId">
                                                </div>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div>

                                        <div class="col-auto">
                                            <div class="m-form__group m-form__group--inline w-220 pill-style">
                                                <div class="m-form__label left">
                                                    <label class="m-label m-label--single">
                                                        Activity
                                                    </label>
                                                </div>
                                                <div class="m-form__control custom-selecter-btn">
                                                    <input class="form-control m-input form-control-sm btn-redius" type="text" value="" name="activity" id="Activity">
                                                </div>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div>
                                        <div class="col-auto">
                                            <button title="Reset Search" data-route="note"
                                                    class="m-portlet__nav-link btn btn-sm btn-outline-primary  m-btn m-btn--outline-2x m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
                                                <i class="fa fa-undo"></i>
                                            </button>
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
            <div class="note_datatable" id="organization_datatable"></div>
            <!--end: Datatable -->
        </div>
    </div>
</div>


<div class="m-widget1">
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title" style="font-size: 20px;">
                                        Total Notes
                                    </h3>
                                </div>
                                <div class="col m--align-right">
                                    <span class="m-widget1__number m--font-brand">
                                        {{ $total_notes = $notes->count() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title">
                                        Completed Notes
                                    </h3>
                                    <!-- <span class="m-widget1__desc">
                                        Weekly Customer Orders
                                    </span> -->
                                </div>
                                <div class="col m--align-right">
                                    <span class="m-widget1__number">
                                        {{ $completed_notes = $notes->where('is_completed', 1)->count() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title">
                                        Pending Notes
                                    </h3>
                                    <!-- <span class="m-widget1__desc">
                                        Weekly Customer Orders
                                    </span> -->
                                </div>
                                <div class="col m--align-right">
                                    <span class="m-widget1__number">
                                        {{ $total_notes - $completed_notes }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title">
                                        Onprocess Notes
                                    </h3>
                                    <!-- <span class="m-widget1__desc">
                                        Weekly Customer Orders
                                    </span> -->
                                </div>
                                <div class="col m--align-right">
                                    <span class="m-widget1__number">
                                        {{ $on_process_notes = $notes->where('status', 'On Process')->count() }}
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>