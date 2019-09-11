<style>
/* #volunteerCreate .m-portlet__body{
    padding: 0px !important;
} */
#appendForm .form-group:first-child .parentDiv{
    margin-top: 10px;
}
#appendForm .form-group:not(:last-child) {
    border-bottom: 1px dotted #ccc;
    padding-bottom: 15px;
}
</style>
<div class="modal-dialog modal-custom-width" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title fs-modal-header">
                 <i class="la la-plus cust_plus_icon"></i>
                <span>Add New Location</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    &times;
                </span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider">         
            <form id="LocationCreate" class="m-form m-form--label-align-right floatLabelForm pd-t-15 pd-b-15">
               <div class="form-group row" style="display: flex; align-items: center">
                   <div class="col-lg-2 field m-t-10">
                       <label class="" for="zip_code">Zip Code</label>
                       <input type="number" class="form-control form-control-sm m-input ucfirst" name="zip_code[]" id="zip_code" autocomplete="off" required data-lookup="zip_code/getData/zip_code">
                   </div>
                   <div class="col-lg-2 field m-t-10">
                       <label class="" for="state">State</label>
                       <input type="text" class="form-control form-control-sm m-input ucfirst" name="state[]" id="state" autocomplete="off" data-lookup="zip_code/getData/state">
                   </div>
                   <div class="col-lg-2 field m-t-10">
                       <label class="" for="county">County</label>
                       <input type="text" class="form-control form-control-sm m-input ucfirst" name="county[]" id="county" autocomplete="off" data-lookup="zip_code/getData/county">
                   </div>
                   <div class="col-lg-2 field m-t-10">
                       <label class="" for="district">District</label>
                       <input type="text" class="form-control form-control-sm m-input ucfirst" name="district[]" id="district" autocomplete="off" data-lookup="zip_code/getData/district">
                   </div>
                   <div class="col-lg-4 field m-t-10">
                       <label class="" for="city">City</label>
                       <div class="input-section">
                            <input type="text" class="form-control form-control-sm m-input ucfirst" name="city[]" id="city" autocomplete="off">
                       </div>
                       <div class="btn-section">
                            <a href="#" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill" id="addlocationRow" style="width:20px !important;height:20px !important;margin-top:5px;">
                                <i class="la la-plus"></i>
                            </a>
                       </div>
                   </div>
               </div>        
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="float-left btn btn-secondary m-btn--pill" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="hidden btnsubModal"></button>
            <button type="button" class="float-right btn btn-success m-btn--pill" id="saveLocation" data-target="LocationCreate">
                Save
            </button>
        </div>
    </div>
</div>

<script>    

    $(document).off('click', '#addlocationRow').on('click', '#addlocationRow', function(e){

        e.preventDefault();

        let previous_form = $('#LocationCreate').serializeArray();        

        var t = `

            <div class="form-group row added-input" style="display: flex; align-items: center">
                <div class="col-lg-2 field m-t-10">
                    <label class="" for="zip_code">Zip Code</label>
                    <input type="number" class="form-control form-control-sm m-input ucfirst" name="zip_code[]" id="zip_code" autocomplete="off" value=${previous_form[0].value}>
                </div>
                <div class="col-lg-2 field m-t-10">
                    <label class="" for="state">State</label>
                    <input type="text" class="form-control form-control-sm m-input ucfirst" name="state[]" id="state" autocomplete="off" value=${previous_form[1].value}>
                </div>
                <div class="col-lg-2 field m-t-10">
                    <label class="" for="county">County</label>
                    <input type="text" class="form-control form-control-sm m-input ucfirst" name="county[]" id="county" autocomplete="off" value=${previous_form[2].value}>
                </div>
                <div class="col-lg-2 field m-t-10">
                    <label class="" for="district">District</label>
                    <input type="text" class="form-control form-control-sm m-input ucfirst" name="district[]" id="district" autocomplete="off" value=${previous_form[3].value}>
                </div>
                <div class="col-lg-4 field m-t-10">
                    <label class="" for="city">City</label>
                    <div class="input-section">
                            <input type="text" class="form-control form-control-sm m-input ucfirst" name="city[]" id="city" autocomplete="off"">
                       </div>
                       <div class="btn-section">
                            <a href="#" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill removeField" style="width:20px !important;height:20px !important;margin-top:5px;">
                                <i class="la la-remove"></i>
                            </a>
                       </div>
                </div>
            </div>

        `;     
        $('#LocationCreate').append(t);

        $('.added-input input').focus();

    });

    $(document).off('click', '.removeField').on('click', '.removeField', function(e){
        e.preventDefault();
        $(this).closest('.form-group').remove();
    });

    $(document).off('click', '#saveLocation').on('click', '#saveLocation', function(e){

        e.preventDefault();

        var form = $(this).attr('data-target');

        let can_proceed = true;

        $('#LocationCreate').find('input').each(function(i, input){

          if( $(input).val() === '' || $(input).val() === "undefined" ){

            can_proceed = false;

            $(this).css('border-color', '#b12775');

          }

        });

        if(! can_proceed) return;

        var request = {
            url: '/locations',
            method: 'post',
            form: form
        };

        addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function () {
                if(response.status === 200){
                  removeFormLoader();
                  reloadDatatable('#location_data_table');
                  $(document).find('#modalContainer').modal('hide');
                }
            });
        });

    });

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

</script>

