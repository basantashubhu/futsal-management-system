<?php

?>
<style>
    .floatingLabel {
        padding: 0 5px !important;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    }
</style>
<div class="modal-dialog modal-custom-small-width" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title fs-modal-header">
                 <i class="la la-plus cust_plus_icon"></i>
                <span>Modify Program Detail</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    &times;
                </span>
            </button>
        </div>
        <!-- Modal Body -->
        <!-- <div class="modal-body"> -->
        <div class="modal-body has-divider no-padding">
            <form class="m-form m-form--label-align-right floatLabelForm" id="addProgramPropertyForm">
                <!--begin::Form-->
                <div class="m-portlet no-margin">
                    <div class="m-portlet__body px-0" style="background: #eee;">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6 field mb-3">
                                <label for="propertyName" class="{{ is_valid('property', $validations) }}">Property</label>
                                <input type="text" name="property" id="propertyName" class="form-control" value="{{ $property->property }}">
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 field mb-3">
                                <label for="propertyValue">Value</label>
                                <input type="text" name="value" id="propertyValue" class="form-control" value="{{ $property->value }}">
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 field">
                                <label for="propertyValue2">Value 2</label>
                                <textarea name="value2" id="propertyValue2" class="form-control" rows="5">{{ $property->value2 }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Form-->
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="float-left btn btn-secondary m-btn--pill" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="float-right btn btn-info m-btn--pill" id="saveProperty" data-target="addProgramPropertyForm">
                Save
            </button>
        </div>
    </div>
</div>

<script>
    $(function (inputs) {
        inputs.each(function () {
            floatLabelInput(this, true);
        });
        inputs.off('focus').on('focus', function () {
            floatLabelInput(this);
        }).off('blur').on('blur', function () {
            floatLabelInput(this, true);
        });
        $('#saveProperty').off('click').on('click', function () {
            let data = inputs.serializeArray().filter(function (elem) {
                return !!elem.value;
            });
            sendAjax({
                url: '/program/properties/{{ $property->id }}/save', method: 'post',
                data, loader: true
            }, function (response) {
                processModal();
                $('#programConfiguration').mDatatable('reload');
            }, formValidation);
        });
    }($('#addProgramPropertyForm :input')));
</script>
