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
                                    <!-- <div class="col-auto no-pd-right">
                                        <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-left m-dropdown--align-push"
                                            data-dropdown-toggle="click" title="Advance Filter" data-dropdown-persistent="true"
                                            aria-expanded="true">
                                            <a href="#" id="showApplicationAdvanceSearchDashboard"
                                            class="m-portlet__nav-link btn btn-sm btn-brand  m-btn m-btn--outline-2x m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle closeClass" @if(!empty($advData)) style="border:1px solid red;" @endif>
                                                <i class="la la-plus m--hide"></i>
                                                <i class="la la-filter"></i>
                                            </a>
                                            <div class="m-dropdown__wrapper" style="width: 600px;">
                                                <span class="m-dropdown__arrow m-dropdown__arrow--left m-dropdown__arrow--adjust"></span>
                                                <div class="m-dropdown__inner">
                                                    <div class="m-dropdown__body no-pd-i">
                                                        <div class="m-dropdown__content">
                                                            <div class="row">
                                                                <div class="col-12 col-sm-12">
                                                                    <div class="advance-search">
                                                                        <form class="m-form m-form--fit m-form--label-align-right"
                                                                            id="volunteersAdvancedFilter">
                                                                            <div class="m-portlet__body">
                                                                                <div class="row">
                                                                                    <div class="col-sm-12 col-lg-6">
                                                                                        <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                                                            <label for="example-text-input"
                                                                                                class="col-form-label">Name</label>
                                                                                            <input class="form-control m-input form-control-sm advanceSearch"
                                                                                                type="text" value="" name="vol_name" id="volName" autocomplete="off">
                                                                                        </div>
                                                                                        <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                                                            <label for="example-text-input"
                                                                                                class="col-form-label">Cell Phone</label>
                                                                                            <input class="form-control m-input form-control-sm advanceSearch"
                                                                                                type="text" value="" name="cellPhone" id="cellPhone" autocomplete="off">
                                                                                        </div>
                                                                                        <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                                                            <label for="example-email-input"
                                                                                                class="col-form-label">Email</label>
                                                                                            <input class="form-control m-input form-control-sm"
                                                                                                type="text" value=""  name="email" id="email" autocomplete="off">
                                                                                        </div>
                                                                                        <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                                                            <label for="example-search-input"
                                                                                                class="col-form-label">SSN</label>
                                                                                            <input class="form-control m-input form-control-sm advanceSearch"
                                                                                                type="text" value="" name="ssn" id="ssnFilter" autocomplete="off">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-12 col-lg-6">
                                                                                        <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                                                            <label for="example-text-input"
                                                                                                class="col-form-label">Primary Address</label>
                                                                                            <input class="form-control m-input form-control-sm"
                                                                                                type="text" value="" name="add1" id="add1" autocomplete="off">
                                                                                        </div>
                                                                                        <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                                                            <label for="example-text-input"
                                                                                                class="col-form-label">City</label>
                                                                                            <input class="form-control m-input form-control-sm"
                                                                                                type="text" value="" name="city" id="city" autocomplete="off">
                                                                                        </div>
                                                                                        <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                                                            <label for="example-text-input"
                                                                                                class="col-form-label">Zip</label>
                                                                                            <input class="form-control m-input form-control-sm"
                                                                                                type="text" value="" name="zip_code" id="zipCode" autocomplete="off">
                                                                                        </div>
                                                                                        <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                                                            <label for="example-email-input"
                                                                                                class="col-form-label">Supervisor</label>
                                                                                            <select class="form-control m-bootstrap-select m-input selectpicker"
                                                                                                    id="serviceProviderFilter"
                                                                                                    multiple data-width="250px" title="Select Supervisor" data-selected-text-format="count > 3" name="supervisor[]">
                                                                                                @if(!empty($supervisors))
                                                                                                    @foreach($supervisors as $supervisor)
                                                                                                        <option value="{{ $supervisor->id }}">
                                                                                                            {{ucfirst( $supervisor->name)}}
                                                                                                        </option>
                                                                                                    @endforeach
                                                                                                @endif
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="m-form__actions footer-action">
                                                                                <div class="row row justify-content-between">
                                                                                    <div class="col">
                                                                                        <label for="showApplicationAdvanceSearch" onclick="$('#showApplicationAdvanceSearchDashboard').trigger('click')"
                                                                                            class="cancelBtn btn btn-sm m-btn m-btn--custom m-btn--pill btn-default float-left">
                                                                                            Cancel
                                                                                        </label>
                                                                                        <label for="showApplicationAdvanceSearch"
                                                                                            class="btn btn-sm m-btn m-btn--custom m-btn--pill btn-default float-left m-l-5 clearBtn clearBtn1" data-target="volunteersAdvancedFilter" data-close="showApplicationAdvanceSearchDashboard">
                                                                                                    Clear
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="col">
                                                                                    </div>
                                                                                    <div class="col text-right">
                                                                                        <button type="button" for="advancedFormBtn"
                                                                                                class="applyBtn1 btn m-btn btn-sm m-btn--custom m-btn--pill btn-success advancedFormBtn" data-target="volunteersAdvancedFilter" data-close="showApplicationAdvanceSearchDashboard">
                                                                                            Apply
                                                                                        </button>
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
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- Advance Filter -->
                                    <form class="form form-inline" id="stipendFilter">
                                        <div class="col-auto">
                                            <div class="m-form__group m-form__group--inline w-220 pill-style">
                                                <div class="m-form__label left">
                                                    <label class="m-label m-label--single">
                                                        City
                                                    </label>
                                                </div>
                                                <div class="m-form__control custom-selecter-btn">
                                                    <input type="text" class="form-control form-control-sm btn-redius" name="city_name" id="city_name">
                                                </div>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="m-form__group m-form__group--inline w-220 pill-style">
                                                <div class="m-form__label left">
                                                    <label class="m-label m-label--single">
                                                        Zip
                                                    </label>
                                                </div>
                                                <div class="m-form__control custom-selecter-btn">
                                                    <input type="text" class="form-control form-control-sm btn-redius" name="zip_code" id="zip_code">
                                                </div>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div>

                                        <button class="hidden" id="quickFormBtn" data-target="stipendFilter"></button>
                                    </form>


                                    <div class="col-auto">
                                        <button title="Reset Search" data-route="location/city" class="btn btn-sm btn-outline-primary  m-btn m-btn--outline-2x m-btn--icon m-btn--icon-only m-btn--pill">
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
            <div class="m_datatable m-t-20" id="location_city_data_table"></div>
            <!--end: Datatable -->
        </div>
    </div>
</div>