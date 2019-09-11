<style>
    fieldset>.form-group{
            margin-bottom: 20px !important;
    }
    
</style>
<div class="modal-dialog modal-custom-medium-width" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title">
                Update Company
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    &times;
                </span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">

            <div class="m-portlet custom_form_bg">
                <!--begin::Form-->

                <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed floatLabelForm payperiod_form" id="organizationCreate">

                    <div class="m-portlet__body">   
                    
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                     <div class="col-sm-12 col-md-12 col-lg-12">
                                         <div class="row">
                                            <div class="col-md-6 col-lg-6">
                                                <div class="row">
                                                    <div class="col-md-12 col-lg-12">
                                                        <fieldset class="custom_fieldset">
                                                            <legend id="custom_legend">
                                                                Basic Information
                                                            </legend>
                                                          
                                                                <div class="form-group  row">
                                                                    <div class="col-lg-12 field">
                                                                        <label for="name"  class="{{ is_valid('name', $validations) }}">Company Name</label>
                                                                        @if(isset($organization->name))
                                                                        <input type="text" autocomplete="off" class="form-control m-input" 
                                                                            id="name" 
                                                                            value="{{$organization->name}}"
                                                                            name="name">
                                                                        @else
                                                                            <input type="text" autocomplete="off" class="form-control m-input" 
                                                                            id="name" 
                                                                            name="name">
                                                                        @endif
                                                                    </div>  
                                                            
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-lg-6 field">
                                                                        <label for="industry"  class="{{ is_valid('industry', $validations) }}">Industry Type</label>
                                                                        <select name="industry" id="industry_id">
                                                                            @if($organization->industry)
                                                                                <option value="{{$organization->industry}}">{{$organization->industry}}</option>
                                                                            @endif
                                                                        </select>
                                                                    </div> 
                                                                    <div class="col-lg-6 field">
                                                                        <label for="estd_date"  class="{{ is_valid('estd_date', $validations) }}">Established Date</label>
                                                                        @if($organization->estd_date)
                                                                        <input type="text" autocomplete="off" class="form-control m-input"
                                                                            id="estd_date"
                                                                             value="{{(date('Y/m/d',strtotime($organization->estd_date)))?:''}}"
                                                                            name="estd_date">
                                                                        @else
                                                                        <input type="text" autocomplete="off" class="form-control m-input"
                                                                            id="estd_date"
                                                                            name="estd_date">
                                                                        @endif
                                                                        
                                                                    </div>  

                                                                </div>
                                                                <div class="form-group row"  style="margin-bottom: 0 !important">
                                                                    <div class="col-lg-6 field">
                                                                        <label for="no_of_emp"  class="{{ is_valid('no_of_emp', $validations) }}">No of Employees</label>
                                                                         @if($organization->no_of_emp)
                                                                        <input type="number" autocomplete="off" class="form-control m-input" 
                                                                            id="no_of_emp" 
                                                                            value="{{$organization->no_of_emp}}" 
                                                                            name="no_of_emp">
                                                                        @else
                                                                         <input type="number" autocomplete="off" class="form-control m-input" 
                                                                            id="no_of_emp" 
                                                                            name="no_of_emp">
                                                                        @endif
                                                                    </div> 
                                                                    <div class="col-lg-6 field">
                                                                        <label for="url"  class="{{ is_valid('url', $validations) }}">Website </label>
                                                                         @if(isset($organization->contact()->url))
                                                                        <input type="text" autocomplete="off" class="form-control m-input" 
                                                                            id="url" 
                                                                          value="{{$organization->contact()->url}}"
                                                                            name="url">
                                                                        @else
                                                                         <input type="text" autocomplete="off" class="form-control m-input" 
                                                                            id="url" 
                                                                    
                                                                            name="url">
                                                                        @endif
                                                                    </div>

                                                                </div>
                                                               
                                                                        
                                                        
                                                        </fieldset>
                                                        
                                                    </div>
                                                    <div class="col-md-12 col-lg-12 mt15">
                                                        <fieldset class="custom_fieldset">
                                                            <legend id="custom_legend">
                                                                Address Information
                                                            </legend>
                                                          
                                                                <div class="form-group  row">
                                                                    <div class="col-lg-12 field">
                                                                        <label for="add1"  class="{{ is_valid('add1', $validations) }}">Address 1</label>
                                                                        @if($organization->address()->add1)
                                                                        <input type="text" autocomplete="off" class="form-control m-input" id="add1" name="add1"
                                                                            value="{{$organization->address()->add1}}">
                                                                        @else
                                                                        <input type="text" autocomplete="off" class="form-control m-input" id="add1" name="add1">
                                                                        @endif
                                                                    </div>  
                                                                </div>
                                                                <div class="form-group  row">
                                                                    <div class="col-lg-12 field">
                                                                        <label for="add2"  class="{{ is_valid('add2', $validations) }}">Address 2</label>
                                                                          @if($organization->address()->add1)
                                                                        <input type="text" autocomplete="off" class="form-control m-input" id="add2" value="{{$organization->address()->add2}}" name="add2">
                                                                        @else
                                                                        <input type="text" autocomplete="off" class="form-control m-input" id="add2" name="add2">
                                                                        @endif
                                                                    </div>  
                                                            
                                                                </div>
                                                                <div class="form-group row">

                                                                    <div class="col-lg-6 field">
                                                                        <label for="city"  class="{{ is_valid('city', $validations) }}">City</label>
                                                                        <select name="city" id="lookup_city">
                                                                        @if($organization->address()->city)
                                                                           <option value="{{$organization->address()->city}}">
                                                                               {{$organization->address()->city}}
                                                                           </option>
                                                                        @endif
                                                                        </select>
                                                                    </div> 
                                                                    <div class="col-lg-6 field">
                                                                        <label for="state"  class="{{ is_valid('state', $validations) }}">State</label>
                                                                        @if($organization->address()->state)
                                                                        <input type="text" autocomplete="off" class="form-control m-input" 
                                                                            id="state" value="{{$organization->address()->state}}" name="state">
                                                                        @else
                                                                        <input type="text" autocomplete="off" class="form-control m-input" 
                                                                            id="state" name="state">
                                                                        @endif
                                                                    </div>  
                                                                </div>
                                                                 <div class="form-group row"> 
                                                                
                                                                    <div class="col-lg-6 field">
                                                                        <label for="county"  class="{{ is_valid('county', $validations) }}">County</label>
                                                                         @if($organization->address()->county)
                                                                        <input type="text" autocomplete="off" class="form-control m-input" 
                                                                           value="{{$organization->address()->county}}" id="county" name="county">
                                                                        @else
                                                                         <input type="text" autocomplete="off" class="form-control m-input" 
                                                                           id="county" name="county">
                                                                        @endif
                                                                    </div>   
                                                                     <div class="col-lg-6 field"  style="margin-bottom: 0 !important">
                                                                        <label for="region"  class="{{ is_valid('region', $validations) }}">Region</label>
                                                                        @if($organization->address()->region)
                                                                        <input type="text" autocomplete="off" class="form-control m-input" value="{{$organization->address()->region}}" id="region" name="region">
                                                                        @else
                                                                        <input type="text" autocomplete="off" class="form-control m-input" id="region" name="region">
                                                                        @endif
                                                                    </div>  
                                                                </div>
                                                                  <div class="form-group row"> 
                                                                    <div class="col-lg-6 field">
                                                                        <label for="zip"  class="{{ is_valid('zip', $validations) }}">Zip</label>
                                                                        @if($organization->address()->zip_code)
                                                                        <input type="number" autocomplete="off" class="form-control m-input" id="zip" value="{{$organization->address()->zip_code}}" name="zip_code" style="margin-bottom:0">
                                                                        @else
                                                                        <input type="number" autocomplete="off" class="form-control m-input" id="zip" name="zip_code" style="margin-bottom:0">
                                                                        @endif
                                                                    </div> 

                                                                    <div class="col-lg-6 field"  style="margin-bottom: 0 !important">
                                                                        <label for="district"  class="{{ is_valid('district', $validations) }}">District</label>
                                                                         @if($organization->address()->district)
                                                                        <input type="text" autocomplete="off" class="form-control m-input" value="{{$organization->address()->district}}" id="district" name="district">
                                                                        @else
                                                                        <input type="text" autocomplete="off" class="form-control m-input" 
                                                                           id="district" name="district">
                                                                        @endif
                                                                    </div>  
                                                                </div>
                                                                

                                                        </fieldset>
                                                        
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6">
                                                <div class="row">
                                                    <div class="col-md-12 col-lg-12">
                                                        <fieldset class="custom_fieldset">
                                                            <legend id="custom_legend">
                                                                Contact Information 
                                                            </legend>
                                                                <div class="form-group  row">
                                                                    <div class="col-lg-12 field">
                                                                        <label for="email"  class="{{ is_valid('email', $validations) }}">Email</label>
                                                                        @if($organization->contact()->email)
                                                                        <input type="text" autocomplete="off" class="form-control m-input" value="{{$organization->contact()->email}}" id="email" name="email">
                                                                        @else
                                                                        <input type="text" autocomplete="off" class="form-control m-input" id="email" name="email">
                                                                        @endif
                                                                    </div>  
                                                            
                                                                </div>
                                                          
                                                                <div class="form-group  row">
                                                                    <div class="col-lg-6 field">
                                                                        <label for="tel_phone" minlength="10" class="{{ is_valid('tel_phone', $validations) }}">Tel Phone</label>
                                                                        @if($organization->contact()->tel_phone)
                                                                        <input type="text" autocomplminlengthete="off" class="form-control m-input" value="{{$organization->contact()->tel_phone}}" id="tel_phone" name="tel_phone">
                                                                        @else
                                                                         <input type="text" autocomplminlengthete="off" class="form-control m-input" id="tel_phone" name="tel_phone">
                                                                        @endif
                                                                    </div>  

                                                                    <div class="col-lg-6 field">

                                                                        <label for="alt_phone" minlength="10" class="{{ is_valid('alt_phone', $validations) }}">Alt. Phone</label>
                                                                        @if($organization->contact()->alt_phone)
                                                                        <input type="text" value="{{$organization->contact()->alt_phone}}" autocomplete="off" class="form-control m-input" id="alt_phone" name="alt_phone">
                                                                        @else
                                                                        <input type="text" autocomplete="off" class="form-control m-input" id="alt_phone" name="alt_phone">
                                                                        @endif
                                                                    </div> 
                                                                </div>
                                                                <div class="form-group row" style="margin-bottom: 0 !important">
                                                                    <div class="col-lg-6 field">
                                                                        <label for="fax"  class="{{ is_valid('fax', $validations) }}">Fax</label>
                                                                        @if($organization->contact()->fax)
                                                                        <input type="number" autocomplete="off" value="{{$organization->contact()->fax}}" class="form-control m-input" id="fax" name="fax">
                                                                        @else
                                                                        <input type="number" autocomplete="off" class="form-control m-input" id="fax" name="fax">
                                                                        @endif
                                                                    </div>  

                                                                </div>
                                                              
                                                    
                                                        </fieldset>
                                                        
                                                    </div>
                                                    <div class="col-md-12 col-lg-12 mt15">
                                                         <fieldset class="custom_fieldset" class="company">
                                                            <legend id="custom_legend" class="glow-btn">
                                                                <div id="orgMoreField">
                                                                    <span><i class="la la-plus"></i> Add More</span>
                                                                </div>
                                                            </legend>
                                                            <div id="appendFormField"></div>
                                                               
                                                        </fieldset>
                                                        
                                                    </div>
                                                </div>

                                            </div>

                                         </div>
                                     </div>
                                </div>
                            </div>

                        </div>       
               
                    </div>
                
                </form>
                <!--end::Form-->
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="float-left btn btn-secondary m-btn--pill" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="float-right btn btn-success m-btn--pill" id="updateOrganization" data-id="{{$organization->id}}" data-target="organizationCreate">
                Save
            </button>
        </div>
    </div>
</div>
@include('default.fgp.organization.modals.label_float')

<script>

$(function(){


    initIE_ServiceProviderDate('estd_date');
    
    $("#estd_date").datepicker({
        autoclose: true,
        format: 'yyyy/mm/dd',
        todayHighlight: true,
    });


    $(document).off('click','#updateOrganization').on('click','#updateOrganization', function (e) {
        e.preventDefault();
        let form = $(this).attr('data-target');
        let organization = $(this).attr('data-id');
        let request = {
            url: '/fgp/organization/update/'+organization,
            method: 'post',
            form: form
        };

        addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function () {
                if(response.status === 200){
                    removeFormLoader();
                    $('#modalContainer').modal('hide');
                     reloadDatatable('#orgn_data_table');
                }
            });
        });
    });



    /*----------------- ends dynamic label ---------*/


});
</script>