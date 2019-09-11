<?php

?>
<div class="col-auto no-pd-right">
    <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-left m-dropdown--align-push"
        data-dropdown-toggle="click" title="Advance Filter" data-dropdown-persistent="true" aria-expanded="true">
        <a href="#" id="noteAdvanceFilterSearch"
            class="m-portlet__nav-link btn btn-sm btn-brand  m-btn mt-3 mb-3 m-btn--outline-2x m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle closeClass"
            @if(!empty($advData)) style="border:1px solid red;" @endif>
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
                                    <form class="m-form m-form--fit m-form--label-align-right" id="noteAdvancedForm">
                                        <div class="m-portlet__body">
                                            <div class="row">
                                                <div class="col-sm-12 col-lg-6">
                                                    <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                        <label for="User" class="col-form-label">User</label>
                                                        <select
                                                            class="form-control m-input form-control-sm advanceSearch"
                                                            name="user" id="User" title="Choose"></select>
                                                    </div>
                                                    <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                        <label for="Title" class="col-form-label">Title</label>
                                                        <input class="form-control m-input form-control-sm" type="text"
                                                            name="title" id="Title" autocomplete="off" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-lg-6">
                                                    <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                        <label for="example-text-input" class="col-form-label">Cell
                                                            Phone</label>
                                                        <input class="form-control m-input form-control-sm" type="text"
                                                            value="" name="vol_cell" id="sitePhone"
                                                            autocomplete="off" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-form__actions footer-action">
                                            <div class="row row justify-content-between">
                                                <div class="col">
                                                    <label for="showApplicationAdvanceSearch"
                                                        class="cancelBtn btn btn-sm m-btn m-btn--custom m-btn--pill btn-default float-left"
                                                        onclick="$('#noteAdvanceFilterSearch').trigger('click')">
                                                        Cancel
                                                    </label>
                                                    <button type="reset"
                                                        class="btn btn-sm m-btn m-btn--custom m-btn--pill btn-default float-left m-l-5 "
                                                        data-target="noteAdvancedForm">
                                                        Clear
                                                    </button>
                                                </div>
                                                <div class="col"></div>
                                                <div class="col text-right">
                                                    <button type="button"
                                                        class="applyBtn1 btn m-btn btn-sm m-btn--custom m-btn--pill btn-success btnNoteAdvSearch"
                                                        data-target="noteAdvancedForm" data-close
                                                        onclick="$('#noteAdvanceFilterSearch').trigger('click')">
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

<script>
    $(function(Form) {
        $('.bsSelect').select2({
            width: '100%', placeholder: 'Choose',
            dropdownParent: Form, allowClear: true,
        });
        Form.on('click', '[type="reset"]', function(e) {
            Form.find('select').val(null).change();
        });
    }( $('#noteAdvancedForm') ));
</script>