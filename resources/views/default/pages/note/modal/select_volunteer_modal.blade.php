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
    #volunteerSelectForm .select2-selection.select2-selection--single {
        height: 35px;
    }
</style>
<div class="modal-dialog modal-custom-small-width " role="document" style="width: 600px;">
    <div class="modal-content selectVolunteerDialog">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title">
                Select Volunteer
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    &times;
                </span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider">
            <form class="m-form floatLabelForm" id="volunteerSelectForm" action="javascript:void(0)">
                <!--begin::Form-->
                <div class="m-portlet site_add_form">
                    <div class="m-portlet__body">
                        <label >
                            Volunteer
                        </label>
                        <select class="form-control form-control-sm m-input" name="vol_id" id="volunteer" autocomplete="off">
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
            <button type="button" class="float-right btn btn-success m-btn--pill" id="selectVolunteer">
                Select
            </button>
        </div>
    </div>
</div>

<script>
    /*--------- Volunteer select 2 --------*/
         $('#volunteer').select2({
            placeholder: "Select Volunteer",
            dropdownParent : $('.selectVolunteerDialog'),
            width : "100%",
            ajax : {
                url : 'volunteer/all',
                processResults : function(data){
                    let program = [];
                      $.each(data,function(index, value){
                        program.push({id:value.id, text:value.value});
                      });
                      return {
                        results: program
                      };
                }
            }
        }); 

    $('#selectVolunteer').off('click').on('click', function(e){
        e.preventDefault();
        let id = $('#volunteer').val();
        sendAjax({
                url: 'note/selectedVolunteer/'+ id,
                loader: true
            }, function (response) {
                processModal();
                $("#note_vol_name").text(response.first_name+" "+response.last_name);
                $("#note_vol_email").text(response.volunteer_contact.email);
                $("#note_vol_contact").text(response.volunteer_contact.cell_phone);
                $("#vol_id").val(response.id);
        }, formValidation);
    });  
</script>