<div class="col-auto no-pd-right">
    <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-left m-dropdown--align-push"
         data-dropdown-toggle="click" title="Advance Filter" data-dropdown-persistent="true" aria-expanded="true">
        <a href="#" id="supportAdvanceSearch"
           class="m-portlet__nav-link btn btn-sm btn-focus  m-btn m-btn--outline-2x m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
            <i class="la la-plus m--hide"></i>
            <i class="la la-filter"></i>
        </a>
        <div class="m-dropdown__wrapper" style="width: 350px;">
            <span class="m-dropdown__arrow m-dropdown__arrow--left m-dropdown__arrow--adjust"></span>
            <div class="m-dropdown__inner">
                <div class="m-dropdown__body no-pd-i">
                    <div class="m-dropdown__content">
                        <div class="row">
                            <div class="col-12 col-sm-12">
                                <div class="advance-search">
                                    <form class="m-form m-form--fit m-form--label-align-right" id="SupportReportAdvFilter">
                                        <div class="m-portlet__body">
                                            <div class="row">
                                                <div class="col-sm-12 col-lg-12">
                                                    <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                        <label for="example-text-input"
                                                               class="col-form-label">Support Type</label>

                                                            <select class="form-control m-bootstrap-select m-input m-input--pill"
                                                                    id="support_type" title="Select Support Type"
                                                                    data-style="btn-redius" name="support_type"
                                                                    data-width="100%">
                                                                @foreach($support_types as $type)
                                                                    <option value="{{$type->id}}">{{$type->value}}</option>
                                                                @endforeach
                                                            </select>

                                                    </div>
                                                    <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                        <label for="example-text-input"
                                                               class="col-form-label">Support Category</label>

                                                            <select class="form-control m-bootstrap-select m-input m-input--pill"
                                                                    id="support_category" title="Select Support Category"
                                                                    data-style="btn-redius" name="support_category"
                                                                    data-width="100%">
                                                                @foreach($support_categories as $type)
                                                                    <option value="{{$type->id}}">{{$type->value}}</option>
                                                                @endforeach
                                                            </select>

                                                    </div>
                                                    <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                        <label for="example-text-input"
                                                               class="col-form-label">Support Department</label>

                                                            <select class="form-control m-bootstrap-select m-input m-input--pill"
                                                                    id="support_department" title="Select Support Department"
                                                                    data-style="btn-redius" name="support_department"
                                                                    data-width="100%">
                                                                @foreach($support_departments as $type)
                                                                    <option value="{{$type->id}}">{{$type->value}}</option>
                                                                @endforeach
                                                            </select>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="m-form__actions footer-action">
                                            <div class="row row justify-content-between">
                                                <div class="col">
                                                    <label for="supportAdvanceSearch"
                                                           onclick="$('#supportAdvanceSearch').trigger('click')"
                                                           class="cancelBtn btn btn-sm m-btn m-btn--custom m-btn--pill btn-default float-left">
                                                        Cancel
                                                    </label>
                                                </div>
                                                <div class="col text-right">
                                                    <button type="button"
                                                            class="applyBtn btn m-btn btn-sm m-btn--custom m-btn--pill btn-success"
                                                            id="submitAppFilter">
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
</div>