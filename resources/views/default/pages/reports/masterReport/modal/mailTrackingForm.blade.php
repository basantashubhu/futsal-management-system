<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                <span id='modal_dynamic_title'>Tracking Process</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    &times;
                </span>
            </button>
        </div>
        <div class="modal-body has-divider">
            <form id="trackProcess" class="m-form">
                <input type="hidden" name="file_id[]" id="ids" value="">
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="sent_method" class="required">
                            Send Method
                        </label>
                            <input type="text" class="form-control m-input" data-lookup="/lookup/getData/sent_method" id="sent_method" name="sent_method" autocomplete="off" @if(isset($track->sent_method)) value="{{$track->sent_method}}" disabled @else value="USPS" @endif>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="sent_tracking_no">
                            Send Tracking No
                        </label>
                        <input type="text" class="form-control m-input" id="sent_tracking_no" name="sent_tracking_no" autocomplete="off" @if(isset($track->sent_tracking_no)) value="{{$track->sent_tracking_no}}" disabled @endif>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="sent_date" class="required">
                            Send Date
                        </label>
                        <input type="text" class="form-control m-input custom_datepicker" id="sent_date" name="sent_date" autocomplete="off" @if(isset($track->sent_date)) value="{{date('m/d/Y', strtotime($track->sent_date))}}" disabled @else value="{{date('m/d/Y')}}"  @endif >
                    </div>
                </div>
            </form>
        </div>
        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">Cancel</button>
            @if(isset($track->id))
            @else
            <button type="button" class="btn btn-success m-btn--pill float-right" id="submitTrackMerge" data-target="trackProcess">
                Save
            </button>
            @endif
        </div>
    </div>
</div>
<script>
$('.custom_datepicker').datepicker({
    autoclose : true,
    todayHighlight: true,
});
$(document).off('click', '#submitTrackMerge').on('click', '#submitTrackMerge', function(e){
    e.preventDefault();
    var request = {
        url: 'reportMailSent/{{$id}}',
        method: 'post',
        form: $(this).data('target')
    };

    ajaxRequest(request, function(response){
        processForm(response, function(){
            reloadDatatable('#repostTablem');
            reloadDatatable('#post_mail_datatable');
        })
    })
});
$(document).off('click', '#updateTrackMerge').on('click', '#updateTrackMerge', function(e){
    e.preventDefault();
    var id = $(this).attr('data-id');
    var request = {
        url: 'updateMailSent/'+id,
        method: 'post',
        form: $(this).data('target')
    };

    ajaxRequest(request, function(response){
        processForm(response, function(){
            reloadDatatable('#repostTablem');
            reloadDatatable('#post_mail_datatable');
        })
    })
});
</script>