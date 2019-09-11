<div class="modal-dialog modal-custom-medium-width" role="document">
    <div class="modal-content mp0">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title fs-modal-header">
                <i class="la la-plus cust_plus_icon"></i>
                <span>Add New City</span>
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
            <form class="m-form m-form--label-align-right floatLabelForm" id="newCityCreate">
                <!--begin::Form-->
                <div class="m-portlet no-bx-shadow">
                    <div class="m-portlet__body form_container_custom">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">

                                    <div class="form-group  row mp0">
                                        <div class="col-lg-3 field">
                                            <label for="region_id" class="{{ is_valid('district_id', $validations) }}">District Name</label>
                                            <select name="district_id" id="district_id">
                                        
                                            </select>
                                        </div>

                                        <div class="col-lg-3 field">
                                            <label for="city_name" class="{{ is_valid('city_name', $validations) }}">City Name</label>
                                            <input type="text" 
                                                name="city_name" 
                                                 
                                                id="city_name" 
                                                class="form-control m-input site"
                                                rel="siteEmail">
                                          
                                        </div>
                                         <div class="col-lg-3 col-md-5 field">
                                            <label for="city_code" class="{{ is_valid('city_code', $validations) }}">City Code</label>
                                            <input type="text" 
                                                name="city_code" 
                                               
                                                id="city_code" 
                                                class="form-control m-input site">
                                        </div> 

                                        <div class="col-lg-2 col-md-5 field">
                                            <label for="zip_code" class="{{ is_valid('zip_code', $validations) }}">Zip Code</label>
                                            <input type="number" 
                                                name="zip_code" 
                                                id="zip_code" 
                                                class="form-control m-input site">
                                        </div>
                                        <div class="col-lg-1 col-md-2 field">
                                             <div class="m-input-icon text-center">
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
            <button type="button" class="float-right btn btn-info m-btn--pill" id="btnSaveCity" data-target="newCityCreate">
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
    $('#district_id').select2({
        width : "100%",
        dropdownParent: $('#modalContainer'),
        height: "100%",
        ajax : {
            url : 'location/district/name',
            processResults : function(data){
                return {
                    results : data
                }
            }
        }
    }).on("change", function() {
        $(this).closest('.field').find('label').first().css({'position':'absolute','top':'-7px','left':'30px','background' : 'white','color':'#3780b7','padding':'0 1px','z-index':'9', 'transition': '0.3s'});
    });
    
    /*-------- submit form ----------*/
    $(document).off('click','#btnSaveCity').on('click','#btnSaveCity', function (e) {
        var form = $(this).attr('data-target');
        var request = {
            url: '/location/city/store',
            method: 'post',
            form: form
        };
        addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function () {
                if(response.status === 200){
                  removeFormLoader();
                  $('#modalContainer').modal('hide');
                  reloadDatatable('#location_city_data_table');
                }
            });
        });
    });


});


</script>