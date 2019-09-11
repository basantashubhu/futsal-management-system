<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Add Rate
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    &times;
                </span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
            <form class="m-form m-form--label-align-right multipleField" id="RateCreate">
                <table>
                    <thead>
                        <th>Rate Type</th>
                        <th>Treatment Type</th>
                        <th>Animal Type</th>
                        <th>Sex</th>
                        <th>Cost</th>
                        <th width="70"></th>
                    </thead>
                    <tbody>

                        <tr>
                            <td>
                                <div class="input-group date">
                                    <input type="text" class="form-control m-input form-control-sm" name="rate_type_id[]" data-lookup="getRateTypes">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-eye glyphicon-th"></i>
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="input-group date">
                                    <input type="text" class="form-control m-input form-control-sm" name="treatment_id[]" data-lookup="getTreatments">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-eye glyphicon-th"></i>
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="input-group date">
                                    <input type="text" class="form-control m-input form-control-sm" name="animal_type[]">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-eye glyphicon-th"></i>
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="m-input-icon m-input-icon--right">
                                    <input type="text" class="form-control m-input form-control-sm" name="sex[]" data-lookup="/lookup/getData/sex" autocomplete="off">
                                    <span class="m-input-icon__icon m-input-icon__icon--right">
                                        <span>
                                            <i class="la la-angle-down"></i>
                                        </span>
                                    </span>
                                </div>
                            </td>
                            <td>
                                <input type="text" class="form-control m-input form-control-sm" name="cost[]">
                            </td>
                            <td>
                                <button id="addFields" type="button" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air"
                                onclick="addTableFields($(this))"><i class="la la-plus"></i></button>
                                <button type="button" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air remove" onclick="addTableFields($(this), 'remove')" style="display: none;"><i class="la la-remove"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-success m-btn--pill float-right" id="submitRate"
                    data-target="RateCreate">
                Save
            </button>
        </div>
    </div>
</div>

<script>
BootstrapDatetimepicker.init();
BootstrapSelect.init();
$('#submitRate').on('click', function (e) {
    e.preventDefault();
    var request = {
        url: '/rate/multiStore/{{$id}}',
        method: 'post',
        form: $(this).attr('data-target')
    };
    console.log(request);

    ajaxRequest(request, function (response) {

        processForm(response, function () {
            reloadDatatable('.rate_datatable');
        });

    });
});
</script>