<div class="modal-dialog" role="document" style="max-width: 1200px;">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                <span id='modal_dynamic_title'>Add Note</span>
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
                        <div class="app-col-body">
                            <div class="row m-row--col">
                                <div class="col-sm-6 col-md-6 col-lg-12 col-xl-12">
                                    <div class="row lh-26">
                                        <div class="col-sm-12 col-md-12 col-lg-12 header">{{$data->cname}}</div>
                                        <div class="col-sm-12 col-md-12 col-lg-12">License Number: {{$data->lic_no}}</div>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-12 col-xl-12">
                                    <div class="row lh-26">
                                        <div class="col-sm-12 col-md-12 col-lg-5 header">Organization ID</div>
                                        <div class="col-sm-12 col-md-12 col-lg-7">#{{$table_id}}</div>
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
                            <form id="NoteCreate">
                                <div class="form-group m-form-group row">
                                    <div class="col-sm-8">
                                        <label for="title" class="required">Subject</label>
                                        <input type="text" name="title" class="m-input form-control form-control-sm" id="title" autocomplete="off">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="priority">Priority</label>
                                        <select class="form-control m-input form-control-sm" name="priority" id="priority">
                                            @foreach($priority as $s)
                                            <option value="{{$s->value}}">{{$s->value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group m-form-group row">
                                    <div class="col-sm-4">
                                         <label for="m_datepicker_2">Start Date</label>
                                        <input type="text" class="form-control m-input form-control-sm m_datepicker_1" name="start" >
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="m_datepicker_3">End Date</label>
                                        <input type="text" class="form-control m-input form-control-sm m_datepicker_1" name="end">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="m_datetimepicker_2">Reminder</label>
                                        <input type="text" class="form-control m-input form-control-sm m_datepicker_1" name="reminder_timestamp">
                                    </div>
                                </div>
                                <div class="form-group m-form-group row">
                                    <div class="col-sm-4">
                                        <label for="status">Status</label>
                                        <select class="form-control m-input form-control-sm" name="status" id="status">
                                            @foreach($status as $s)
                                            <option value="{{$s->value}}">{{$s->value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="note_type">Type</label>
                                        <select class="form-control m-input form-control-sm" name="note_type" id="note_type">
                                            @foreach($types as $s)
                                            <option value="{{$s->value}}">{{$s->value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="activity">Activity</label>
                                        <select class="form-control m-input form-control-sm" name="activity" id="activity">
                                            @foreach($activity as $s)
                                            <option value="{{$s->value}}">{{$s->value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group m-form-group row">
                                    <div class="col-sm-12">
                                        <label for="notes" class="required">Description</label>
                                        <textarea class="form-control form-control-sm m-input" name="notes" rows="5" id="notes"></textarea>
                                    </div>
                                </div>
                                <input type="hidden" name="table_name" value="{{$table}}">
                                <input type="hidden" name="table_id" value="{{$table_id}}">
                                <input type="hidden" name="segment" value="organization">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-success m-btn--icon m-btn--pill float-right" id="submitNote" data-target="NoteCreate">
                <span>
                    <span>Save</span>
                </span>
            </button>
        </div>
    </div>
</div>

<script>
    BootstrapDatepicker.init();
    BootstrapDatetimepicker.init();
    BootstrapSelect.init();
    $('#notes').summernote(std.config.editorConfig);
   $(document).off('click', '#submitNote').on('click', '#submitNote', function (e) {
        var form = $(this).attr('data-target');
        var request = {
            url: '/note/noteStore',
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
</script>