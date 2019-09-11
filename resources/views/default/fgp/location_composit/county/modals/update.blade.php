<div class="modal-dialog modal-custom-small-width" role="document">
    <div class="modal-content mp0">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title fs-modal-header">
                <i class="la la-edit cust_plus_icon"></i>
                <span>Update County</span>
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
            <form class="m-form m-form--label-align-right floatLabelForm" id="updateCounty">
                <!--begin::Form-->
                <div class="m-portlet no-bx-shadow">
                    <div class="m-portlet__body no-pd-i form_container_custom" style=" padding:10px !important;">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">

                                    <div class="form-group  row mp0" style="margin-top: 10px !important">
                                       <div class="col-lg-4 field">
                                            <label for="region_id" class="{{ is_valid('region_id', $validations) }}">Region Name</label>
                                            <select name="region_id" id="region_id">
                                                @if($county->gerion)
                                                <option value="{{$county->region_id}}" selected>{{($county->region->region_name)?:""}}</option>
                                                @endif;
                                            </select>
                                        </div>
                                        

                                        <div class="col-lg-4 field">
                                            <label for="county_name" class="{{ is_valid('county_name', $validations) }}">County Name</label>
                                            <input type="text" 
                                                name="county_name" 
                                                  value="{{($county->county_name)?:''}}"
                                                id="county_name" 
                                                class="form-control m-input site"
                                                rel="siteEmail">
                                          
                                        </div>
                                         <div class="col-lg-3 col-md-5 field">
                                            <label for="county_code" class="{{ is_valid('county_code', $validations) }}">County Code</label>
                                            <input type="text" 
                                              value="{{($county->county_code)?:''}}"
                                                name="county_code" 
                                                id="county_code" 
                                                class="form-control m-input site">
                                        </div>
                                        <div class="col-lg-1 col-md-2 field" style="padding-left: 13px;">
                                             <div class="m-input-icon ">
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
            <button type="button" class="float-right btn btn-info m-btn--pill" id="btnUpdateCounty"data-id="{{$county->id}}" data-target="updateCounty">
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


     /*================== Region Name Select To ============*/
    $('#region_id').select2({
        width : "100%",
        dropdownParent: $('#modalContainer'),
        height: "100%",
        ajax : {
            url : 'location/region/name',
            processResults : function(data){
                data = data.map(x => ({id:x.id, text: x.text||x.value}));
                return {
                    results : data
                }
            }
        }
    });
    
    /*-------- submit form ----------*/
    $(document).off('click','#btnUpdateCounty').on('click','#btnUpdateCounty', function (e) {
        var form = $(this).attr('data-target');
        let county = $(this).attr('data-id');
        var request = {
            url: '/location/county/update/'+county,
            method: 'post',
            form: form
        };
        addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function () {
                if(response.status === 200){
                  removeFormLoader();
                  $('#modalContainer').modal('hide');
                  reloadDatatable('#location_county_data_table');
                }
            });
        });
    });


});


</script>