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
              <i class="la la-edit cust_plus_icon"></i>
                <span>Update Location</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    &times;
                </span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider">         
            <form id="LocationUpdate" class="m-form m-form--label-align-right floatLabelForm pd-t-15 pd-b-15">
               <div class="form-group row" style="display: flex; align-items: center">
                   <div class="col-lg-2 field m-t-10">
                       <label class="" for="zip_code">Zip Code</label>
                       <input type="number" class="form-control form-control-sm m-input ucfirst" name="zip_code[]" id="zip_code" autocomplete="off" value="{{$location->zip_code}}">
                   </div>
                   <div class="col-lg-2 field m-t-10">
                       <label class="" for="state">State</label>
                       <input type="text" class="form-control form-control-sm m-input ucfirst" name="state[]" id="state" autocomplete="off" value="{{$location->state}}">
                   </div>
                   <div class="col-lg-2 field m-t-10">
                       <label class="" for="county">County</label>
                       <input type="text" class="form-control form-control-sm m-input ucfirst" name="county[]" id="county" autocomplete="off" value="{{$location->county}}">
                   </div>
                   <div class="col-lg-2 field m-t-10">
                       <label class="" for="district">District</label>
                       <input type="text" class="form-control form-control-sm m-input ucfirst" name="district[]" id="district" autocomplete="off" value="{{$location->district}}">
                   </div>
                   <div class="col-lg-4 field m-t-10">
                       <label class="" for="city">City</label>
                       <input type="text" class="form-control form-control-sm m-input ucfirst" name="city[]" id="city" autocomplete="off" value="{{$location->city}}">
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
            <button type="button" class="float-right btn btn-success m-btn--pill" id="updateLocation" data-location-id="{{$location->id}}" data-target="LocationUpdate">
                Save
            </button>
        </div>
    </div>
</div>

<script>  


    $(document).off('click', '#updateLocation').on('click', '#updateLocation', function(e){

        e.preventDefault();

        let location_id = $(this).attr('data-location-id');

        var form = $(this).attr('data-target');


        let can_proceed = true;

        $('#LocationUpdate').find('input').each(function(i, input){

          if( $(input).val() === '' || $(input).val() === "undefined" ){

            can_proceed = false;

            $(this).css('border-color', '#b12775');

          }

        });

        if(! can_proceed) return;

        var request = {
            url: '/locations?location_id='+location_id,
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

