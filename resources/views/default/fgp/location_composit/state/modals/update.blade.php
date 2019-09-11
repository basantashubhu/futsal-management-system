<style>
    input[type="number"]{
        margin-bottom: 15px;
    }
    .no-bx-shadow{
        box-shadow: none !important;
        background:#eeeeee;
        margin-bottom: 0 !important;
    }
    .form_container_custom{
        background: #eeeeee !important; 
       
    }

</style>

<div class="modal-dialog modal-custom-small-width" role="document">
    <div class="modal-content mp0">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title fs-modal-header">
                 <i class="la la-edit cust_plus_icon"></i>
                <span>Update State</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    &times;
                </span>
            </button>
        </div>
        <!-- Modal Body -->
        <!-- <div class="modal-body"> -->
        <div class="modal-body mp0">
            <form class="m-form m-form--label-align-right floatLabelForm" id="UpdateState">
                <!--begin::Form-->
                <div class="m-portlet no-bx-shadow">
                    <div class="m-portlet__body form_container_custom">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">

                                    <div class="form-group  row mp0">

                                        <div class="col-lg-6 field">
                                            <label for="state_name" class="{{ is_valid('state_name', $validations) }}">State Name</label>
                                            <input type="text" 
                                                name="state_name" 
                                                id="state_name" 
                                                value="{{($state->state_name)?:''}}"
                                                class="form-control m-input site"
                                                rel="siteEmail">
                                          
                                        </div>
                                         <div class="col-lg-5 col-md-5 field">
                                            <label for="state_code" class="{{ is_valid('state_code', $validations) }}">State Code</label>
                                            <input type="text" 
                                                name="state_code" 
                                                id="state_code" 
                                                value="{{($state->state_code)?:''}}"
                                                class="form-control m-input site">
                                        </div>
                                        <div class="col-lg-1 col-md-2 field">
                                             <div class="m-input-icon ">
                                                    <a href="#" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill" id="addRow">
                                                       <i class="la la-plus"></i>
                                                    </a>
                                                </div>
                                        </div>
                                       
                                    </div>
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
            <button type="button" class="float-right btn btn-info m-btn--pill" id="btnUpdateState" data-id="{{$state->id}}" data-target="UpdateState">
                Save
            </button>
        </div>
    </div>
</div>

<script>

/*-------------- float label for input field -----------*/
$('.floatLabelForm').off('focus', 'input:text, input:password, textarea, input[type="number"],input[type="email"], select').on('focus', 'input:text, input:password, input[type="number"], textarea, select', function (e) {
        floatLabelInput(this);
    }).on('blur','input:text, input:password, textarea, input[type="number"] , input[type="email"], select',function(e){
        var self = this;
        $(this).closest('.field').css('position','relative');
        if(!self.value.length)
        {
            $(self).closest('.field').find('label').first().attr('style','');
        }
    });

    $('.floatLabelForm').find('input:text, input:password, input[type="number"], input[type="email"], textarea, select').each(function (i, elem) {
        floatLabelInput(this, true);
    });

$(function(){
    /*-------- submit form ----------*/
    $(document).off('click','#btnUpdateState').on('click','#btnUpdateState', function (e) {
        var form = $(this).attr('data-target');
        let state = $(this).attr('data-id');
        var request = {
            url: '/location/state/update/'+state,
            method: 'post',
            form: form
        };
        addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function () {
                if(response.status === 200){
                  removeFormLoader();
                  $('#modalContainer').modal('hide');
                  reloadDatatable('#location_state_data_table');

                }
            });
        });
    });


});


</script>