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
                Add New Company
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
                                                                        <input type="text" autocomplete="off" class="form-control m-input" 
                                                                            id="name" 
                                                                            name="name">
                                                                    </div>  
                                                            
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-lg-6 field">
                                                                        <label for="industry"  class="{{ is_valid('industry', $validations) }}">Industry Type</label>
                                                                        <select name="industry" id="industry_id"></select>
                                                                    </div> 
                                                                    <div class="col-lg-6 field">
                                                                        <label for="estd_date"  class="{{ is_valid('estd_date', $validations) }}">Established Date</label>
                                                                        <input type="text" autocomplete="off" class="form-control m-input"
                                                                            id="estd_date"
                                                                            name="estd_date">
                                                                        
                                                                    </div>  

                                                                </div>
                                                                <div class="form-group row"  style="margin-bottom: 0 !important">
                                                                    <div class="col-lg-6 field">
                                                                        <label for="no_of_emp"  class="{{ is_valid('no_of_emp', $validations) }}">No of Employees</label>
                                                                        <input type="number" autocomplete="off" class="form-control m-input" 
                                                                            id="no_of_emp" 
                                                                            name="no_of_emp">
                                                                    </div> 
                                                                    <div class="col-lg-6 field">
                                                                        <label for="url"  class="{{ is_valid('url', $validations) }}">Website </label>
                                                                        <input type="text" autocomplete="off" class="form-control m-input" 
                                                                            id="url" 
                                                                            name="url">
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
                                                                        <input type="text" autocomplete="off" class="form-control m-input" 
                                                                            id="add1" 
                                                                            name="add1">
                                                                    </div>  
                                                                </div>
                                                                <div class="form-group  row">
                                                                    <div class="col-lg-12 field">
                                                                        <label for="add2"  class="{{ is_valid('add2', $validations) }}">Address 2</label>
                                                                        <input type="text" autocomplete="off" class="form-control m-input" 
                                                                            id="add2" 
                                                                            name="add2">
                                                                    </div>  
                                                            
                                                                </div>
                                                                <div class="form-group row">

                                                                    <div class="col-lg-6 field">
                                                                        <label for="city"  class="{{ is_valid('city', $validations) }}">City</label>
                                                                        <select name="city" id="lookup_city"></select>
                                                                    </div> 
                                                                    <div class="col-lg-6 field">
                                                                        <label for="state"  class="{{ is_valid('state', $validations) }}">State</label>
                                                                        <input type="text" autocomplete="off" class="form-control m-input" 
                                                                            id="state" 
                                                                            name="state">
                                                                    </div>  
                                                                </div>
                                                                 <div class="form-group row"> 
                                                                    <div class="col-lg-6 field">
                                                                        <label for="zip"  class="{{ is_valid('zip', $validations) }}">Zip</label>
                                                                        <input type="number" autocomplete="off" class="form-control m-input" 
                                                                            id="zip" 
                                                                            name="zip_code" style="margin-bottom:0">
                                                                    </div> 

                                                                    <div class="col-lg-6 field">
                                                                        <label for="county"  class="{{ is_valid('county', $validations) }}">County</label>
                                                                        <input type="text" autocomplete="off" class="form-control m-input" 
                                                                            id="county" 
                                                                            name="county">
                                                                    </div>   
                                                                </div>
                                                                  <div class="form-group row"> 
                                                                     <div class="col-lg-6 field"  style="margin-bottom: 0 !important">
                                                                        <label for="region"  class="{{ is_valid('region', $validations) }}">Region</label>
                                                                        <input type="text" autocomplete="off" class="form-control m-input" 
                                                                            id="region" 
                                                                            name="region">
                                                                    </div>  

                                                                    <div class="col-lg-6 field"  style="margin-bottom: 0 !important">
                                                                        <label for="district"  class="{{ is_valid('district', $validations) }}">District</label>
                                                                        <input type="text" autocomplete="off" class="form-control m-input" 
                                                                            id="district" 
                                                                            name="district">
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
                                                                        <input type="text" autocomplete="off" class="form-control m-input" 
                                                                            id="email" 
                                                                            name="email">
                                                                    </div>  
                                                            
                                                                </div>
                                                          
                                                                <div class="form-group  row">
                                                                    <div class="col-lg-6 field">
                                                                        <label for="tel_phone" minlength="10" class="{{ is_valid('tel_phone', $validations) }}">Tel Phone</label>
                                                                        <input type="text" autocomplminlengthete="off" class="form-control m-input" 
                                                                            id="tel_phone" 
                                                                            name="tel_phone">
                                                                    </div>  

                                                                    <div class="col-lg-6 field">
                                                                        <label for="alt_phone" minlength="10" class="{{ is_valid('alt_phone', $validations) }}">Alt. Phone</label>
                                                                        <input type="text" autocomplete="off" class="form-control m-input" 
                                                                            id="alt_phone" 
                                                                            name="alt_phone">
                                                                    </div> 
                                                                </div>
                                                                <div class="form-group row" style="margin-bottom: 0 !important">
                                                                    <div class="col-lg-6 field">
                                                                        <label for="fax"  class="{{ is_valid('fax', $validations) }}">Fax</label>
                                                                        <input type="number" autocomplete="off" class="form-control m-input" 
                                                                            id="fax" 
                                                                            name="fax">
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
            <button type="button" class="float-right btn btn-success m-btn--pill" id="addOrganization" data-target="organizationCreate">
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


    var const_i = 1;
    $(document).off('click', '#orgMoreField').on('click', '#orgMoreField', function(e){
        e.preventDefault();
        if(const_i==5){
            return toastr.error("Cannot add more items");
        }   
        var t = `
         <div class="form-group row no-pd-right no-pd-left"> 
            <div class="col-md-12 parentDiv">
                <div class="input-section field">
                    <label for="label">Label</label>
                    <input type="text" name="label[]" class="form-control form-control-sm" data-lookup="lookup/organization/detail" id="countLabel_`+const_i+`" data-id="`+const_i+`">  
                </div>
                <div class="btn-section">
                    <a href="#" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill removeField">
                     <i class="la la-remove"></i>
                    </a>
                </div>
            </div>
        </div>
        `;
        $('#appendFormField').append(t);

        const_i++;
    });

    $(document).off('click', '.removeField').on('click', '.removeField', function(e){
        e.preventDefault();
        $(this).closest('.form-group').remove();
        const_i--;
    });


    /*------------ dynamic float labe with value for add more option --------*/
    $(document).off('click', '.parentDiv .lookup-list-items').on('click', '.parentDiv .lookup-list-items', function(e){
        e.preventDefault();
        $('#organizationCreate :input').each(function() {
            floatLabelInput(this, true);
        });
         var self = $(this);
        var id = self.attr('data-id');
        var parentid = self.closest('.lookup-lists').attr('data-lookup-id');
        var v = self.text();
    
        var parent = $('input[data-value='+id+'][data-ref='+parentid+']').attr("data-id");
    
        $('#countLabel_'+parent).closest('.form-group').find('input[target-id="countLabel_'+parent+'"]').closest('.col-md-12').remove();
        var t = `
            <div class="col-md-12">
                <div class="input-section field">
                    <label for="value">`+v+`</label>
                    <input type="hidden" name="lookup_id[]" data-id="lookup_id_`+parent+`"value="`+id+`">
                    <input type="text" name="value[]" class="form-control form-control-sm" target-id="countLabel_`+parent+`" data-id="`+parent+`" id="value">  
                </div>
                <div class="btn-section">
                    <a href="#" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill removeField">
                        <i class="la la-remove"></i>
                    </a>
                </div>
            </div>
        `;
        var target = $('#countLabel_'+parent).closest('.form-group');
        target.append(t);
        $('#organizationCreate :input').each(function() {
            floatLabelInput(this, true);
        }).on('focus',function(){
            floatLabelInput(this, true);
        });
        var targetInput = $('#countLabel_'+parent).closest('.form-group').find('input[target-id="countLabel_'+parent+'"]');
         $('#countLabel_'+parent).closest('.parentDiv').hide();
    });

    /*----------------- ends dynamic label ---------*/


});
</script>