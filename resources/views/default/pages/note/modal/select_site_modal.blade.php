<?php

?>
<style>
    body .bootstrap-select.btn-group > .btn-redius {
        background-color: #fff;
        border: 1px solid #d0d0d0;
        border-top-right-radius: 0.25rem!important;
        border-bottom-right-radius: 0.25rem !important;
    }

    /* width */
    ::-webkit-scrollbar {
        width: 3px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #888;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
    #StipendPeriodSelectForm .select2-selection.select2-selection--single {
        height: 35px;
    }
</style>
<div class="modal-dialog modal-custom-small-width" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title">
                Select Site
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    &times;
                </span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider">
            <form class="m-form floatLabelForm" id="StipendPeriodSelectForm" action="javascript:void(0)">
                <!--begin::Form-->
                <div class="m-portlet site_add_form">
                    <div class="m-portlet__body">
                        <label class="" for="last_name">Site</label>
                        <select class="form-control form-control-sm m-input" name="site_id" id="site" autocomplete="off">
                        </select>
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
            <button type="button" class="float-right btn btn-success m-btn--pill" id="selectSite">
                Select
            </button>
        </div>
    </div>
</div>

<script>
    /*--------- category select 2 --------*/
    $('#site').select2({
        width : "100%", placeoder: 'Choose', dropdownParent: $('#StipendPeriodSelectForm')
    });
    
    sendAjax('sites/fetchAll', function(data) {
        const options = data.map(x => `<option value="${x.id}">${x.value}</option>`);
        $('#site').html(options).change();
    });

    $('#selectSite').off('click').on('click', function(e){
        e.preventDefault();
        let id = $('#site').val();
        sendAjax({
                url: 'note/selectedSite/'+ id,
                loader: true
            }, function (response) {
                processModal();
                $("#note_site_name").text(response.site_name);
                $("#note_site_email").text(response.site_contact.email);
                $("#note_site_addr").text(response.address.add1);
                $("#site_id").val(response.id);
        }, formValidation);

    });  

    // $("#tabelTimeSheet").slideUp('slow');
    //         $("#TimeSheetAssignForm").slideDown('slow');
    //         // $('#dynamicTimeSheet').html(response.data);
    //         // $('#addTimesheet').hide('slow');
    //         // $('.timesheet_back').show('slow');
</script>