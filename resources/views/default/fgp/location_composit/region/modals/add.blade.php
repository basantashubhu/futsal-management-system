<div class="modal-dialog modal-custom-small-width" role="document">
    <div class="modal-content mp0">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title fs-modal-header">
                <i class="la la-plus cust_plus_icon"></i>
                <span>Add New Region</span>
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
            <form class="m-form m-form--label-align-right floatLabelForm" id="newRegionCreate">
                <!--begin::Form-->
                <div class="m-portlet no-bx-shadow">
                    <div class="m-portlet__body no-pd-i form_container_custom">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">

                                    <div class="form-group  row mp0" style="margin-top: 10px !important">
                                        <div class="col-lg-4 field">
                                            <label for="state_id" class="{{ is_valid('state_id', $validations) }}">State Name</label>
                                            <select name="state_id" id="state_id" style="height: 31px;">
                                               
                                            </select>
                                        </div>

                                        <div class="col-lg-4 field">
                                            <label for="region_name" class="{{ is_valid('region_name', $validations) }}">Region Name</label>
                                            <input type="text" 
                                                name="region_name" 
                                                id="region_name" 
                                                class="form-control m-input site"
                                               >
                                          
                                        </div>
                                         <div class="col-lg-3 col-md-5 field">
                                            <label for="region_code" class="{{ is_valid('region_code', $validations) }}">Region Code</label>
                                            <input type="text" 
                                                name="region_code" 
                                                id="region_code" 
                                                class="form-control m-input site">
                                        </div>
                                        <div class="col-lg-1 col-md-1 field">
                                             <div class="m-input-icon">
                                                    <a href="#" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill" id="addRow" >
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
            <button type="button" class="float-right btn btn-info m-btn--pill" id="saveNewRegion" data-target="newRegionCreate">
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
    /*================== State Name Select To ============*/
    $('#state_id').select2({
        width : "100%",
        dropdownParent: $('#modalContainer'),
        ajax : {
            url : 'location/state/name',
            processResults : function(data){
                data = data.map(x => ({id: x.id, text: x.text || x.value}));
                return {
                    results : data
                }
            }
        }
    }).on("change", function() {
        $(this).closest('.field').find('label').first().css({'position':'absolute','top':'-7px','left':'30px','background' : 'white','color':'#3780b7','padding':'0 1px','z-index':'9', 'transition': '0.3s'});
    });
    
    /*-------- submit form ----------*/
    $(document).off('click','#saveNewRegion').on('click','#saveNewRegion', function (e) {
        var form = $(this).attr('data-target');
        var request = {
            url: '/location/region/store',
            method: 'post',
            form: form
        };
        addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function () {
                if(response.status === 200){
                  removeFormLoader();
                  $('#modalContainer').modal('hide');
                  reloadDatatable('#location_region_data_table');

                }
            });
        });
    });


});


</script>