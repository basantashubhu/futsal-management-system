<div class="modal-dialog" role="document" style="max-width: 1000px; margin: 1.75rem auto;">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                <span id='modal_dynamic_title'>Edit Note</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    &times;
                </span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-4">
                    <div class="app-col-seperator m-b-30">
                        <!-- <span class="custom-header std-header app-col-header app-header">Application Information</span> -->
                        <div class="app-col-body">
                            <div class="row m-row--col">
                                @if($client)
                                <div class="col-sm-6 col-md-6 col-lg-12 col-xl-12">
                                    <div class="row lh-26">
                                        <!-- <div class="col-sm-6 col-md-6 col-lg-4 header">Name</div> -->
                                        <div class="col-sm-12 col-md-12 col-lg-12 header">{{$client->fname}} {{$client->mname}} {{$client->lname}}</div>
                                    </div>
                                    @if(isset($client->contact) && !is_null($client->contact->phone) && $client->contact->phone!="")
                                    <div class="row lh-26">
                                        <div class="col-sm-6 col-md-6 col-lg-1 header"><i class="la la-phone"></i></div>
                                        <div class="col-sm-6 col-md-6 col-lg-8">{{isset($client->contact)?$client->contact->phone:""}}</div>
                                    </div>
                                    @endif
                                    @if(isset($client->contact) && !is_null($client->contact->personal_email) && $client->contact->personal_email!="")
                                    <div class="row lh-26">
                                        <div class="col-sm-6 col-md-6 col-lg-1 header"><i class="la la-envelope"></i></div>
                                        <div class="col-sm-6 col-md-6 col-lg-8">{{isset($client->contact)?$client->contact->personal_email:""}}</div>
                                    </div>
                                    @endif
                                    <div class="row lh-26">
                                        <div class="col-sm-6 col-md-6 col-lg-1 header"><i class="la la-map-marker"></i></div>
                                        <div class="col-sm-6 col-md-6 col-lg-8">{{isset($client->address)?$client->address->add1:""}}</div>
                                    </div>
                                    <hr>
                                </div>
                                @else
                                <div class="col-sm-6 col-md-6 col-lg-12 col-xl-12">
                                    <div class="row lh-26">
                                        <div class="col-sm-12 col-md-12 col-lg-12 header">{{$data->cname}}</div>
                                        <div class="col-sm-12 col-md-12 col-lg-12">License Number: {{$data->lic_no}}</div>
                                    </div>
                                    <hr>
                                </div>
                                @endif
                                <div class="col-sm-6 col-md-6 col-lg-12 col-xl-12">
                                    <div class="row lh-26">
                                        <div class="col-sm-12 col-md-12 col-lg-5 header">Application ID</div>
                                        <div class="col-sm-12 col-md-12 col-lg-7">#{{$note->table_id}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="app-col-seperator height-100" >
                        <!-- <span class="custom-header std-header app-col-header app-header">Notes</span> -->
                        <div class="app-col-body">
                            <form id="noteUpdate">
                                <div class="form-group m-form-group row">
                                    <div class="col-sm-8">
                                        <label for="title">Title <span class="required">*</span></label>
                                        <input type="text" name="title" class="m-input form-control form-control-sm" id="title" autocomplete="off" value="{{$note->title}}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="priority">Priority</label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="text" class="form-control m-input form-control-sm" name="priority" id="priority" data-lookup="/lookup/getData/note_priority" autocomplete="off" value="{{$note->priority}}">
                                            <span class="m-input-icon__icon m-input-icon__icon--right">
                                                <span>
                                                    <i class="la la-angle-down"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form-group row">
                                    <div class="col-sm-4">
                                         <label for="start">Start Date</label>
                                            <input type="text" class="form-control m-input form-control-sm m_datepicker_1" name="start" value="{{date('m/d/Y', strtotime($note->start))}}" id="start">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="end">End Date</label>
                                            <input type="text" class="form-control m-input form-control-sm m_datepicker_1" name="end" id="end" value="{{date('m/d/Y', strtotime($note->end))}}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="reminder_timestamp">Reminder</label>
                                            <input type="text" class="form-control m-input form-control-sm m_datepicker_1" name="reminder_timestamp" id="reminder_timestamp" value="{{date('m/d/Y', strtotime($note->reminder_timestamp))}}">
                                    </div>
                                </div>
                                <div class="form-group m-form-group row">
                                    <div class="col-sm-4">
                                        <label for="status">Status</label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="text" class="form-control m-input form-control-sm" name="status" id="status" data-lookup="/lookup/getData/note_status" autocomplete="off" value="{{$note->status}}">
                                            <span class="m-input-icon__icon m-input-icon__icon--right">
                                                <span>
                                                    <i class="la la-angle-down"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="note_type">Type</label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="text" class="form-control m-input form-control-sm" name="note_type" id="note_type" data-lookup="/lookup/getData/note_type" autocomplete="off" value="{{$note->note_type}}">
                                            <span class="m-input-icon__icon m-input-icon__icon--right">
                                                <span>
                                                    <i class="la la-angle-down"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="activity">Activity</label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="text" class="form-control m-input form-control-sm" name="activity" id="activity" data-lookup="/lookup/getData/note_activity" autocomplete="off" value="{{$note->activity}}">
                                            <span class="m-input-icon__icon m-input-icon__icon--right">
                                                <span>
                                                    <i class="la la-angle-down"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form-group row">
                                    <div class="col-sm-12">
                                        <label for="notes">Description <span class="required">*</span></label>
                                        <textarea class="form-control form-control-sm m-input" name="notes" rows="5" id="notes">{{$note->notes}}</textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-modal-route="/note/view/{{$note->id}}">Cancel</button>
            <!-- <button type="button" class="btn btn-danger m-btn--pill float-left" data-modal-route="/note/delete/{{$note->id}}">Delete</button> -->
            <!-- <button type="button" class="btn btn-accent m-btn--pill enable_form float-right" id="enable_form">Edit</button> -->
            <button type="button" class="btn btn-success m-btn--pill float-right" id="submitNote" data-target="noteUpdate">Save</button>
        </div>
    </div>
</div>

<script>
    initIE_ServiceProviderDate("start");
    initIE_ServiceProviderDate("end");
    initIE_ServiceProviderDate("reminder_timestamp");
    BootstrapSelect.init();
    $('#notes').summernote(std.config.editorConfig);
    $(document).off('click', '#submitNote').on('click', '#submitNote', function (e) {
        var form = $(this).attr('data-target');
        var request = {
            url: '/note/noteUpdate/{{$note->id}}',
            method: 'post',
            form: form
        };
        addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function()
            {
                reloadDatatable('.note_datatable');
        removeFormLoader();
            });
        });
    });
    // $('#deleteNote').on('click', function (e) {
    //     var request = {
    //         url: '/note/delete/{{$note->id}}',
    //         method: 'post'
    //     };

    //     ajaxRequest(request, function (response) {
    //         reloadDatatable('.note_datatable');
    //     });
    // });
</script>