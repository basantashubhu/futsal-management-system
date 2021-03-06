@include('default.pages.schedules.includes.head')

<div class="m-content">
    <div class="m-portlet m-portlet--mobile provider-border-color">
        <div class="m-portlet__body" style="padding-bottom: 30px; padding: 20px">
            <!--begin: Search Form -->
            <div class="m-form m-form--label-align-right m--margin-top-bottom">
                <div class="row align-items-center">
                    <div class="col-xl-8 order-2 order-xl-1">
                        <div class="form-group m-form__group row align-items-center">
                            <div class="col-md-4">
                                <div class="m-input-icon m-input-icon--left">
                                    <input type="text" class="form-control m-input"
                                        id="dateSchedule">
                                    <span class="m-input-icon__icon m-input-icon__icon--left">
                                        <span>
                                            <i class="la la-search"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                            <button data-modal-route="addNP"
                                class="btn btn-info m-btn m-btn--custom m-btn--icon m-btn--pill">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>
                                        Add Application
                                    </span>
                                </span>
                            </button>
                            <div class="m-separator m-separator--dashed d-xl-none"></div>
                        </div> --}}
                </div>
            </div>
            <!--end: Search Form -->
            <!--begin: Datatable -->
            <div class="m_datatable" id="schedule_datatable"></div>
            <!--end: Datatable -->
        </div>
    </div>
</div>

@include('default.pages.schedules.includes.script')