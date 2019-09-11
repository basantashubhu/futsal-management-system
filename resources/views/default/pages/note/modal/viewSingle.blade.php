<div class="modal-dialog" role="document" style="max-width: 1000px; margin: 1.75rem auto;">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                <span id='modal_dynamic_title'>Note Detail</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    &times;
                </span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-8 no-pd-i">
                    <div class="col-sm-12">
                        <div class="app-col-seperator m-b-10">
                            <div class="app-col-body">
                                <div class="row m-row--col-separator-xl">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="row lh-26 no-pd-i">
                                            <div class="col-sm-2 col-md-2 col-lg-4"><strong>Start Date:</strong> {{format_date($note->start)}}</div>
                                            <div class="col-sm-2 col-md-2 col-lg-4"><strong>End Date:</strong> {{format_date($note->end)}}</div>
                                            @if(isset($note->reminder_timestamp))
                                            <div class="col-sm-2 col-md-2 col-lg-4"><strong>Reminder:</strong> {{format_date($note->reminder_timestamp)}}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="row lh-26 no-pd-i">
                                            <div class="col-sm-2 col-md-2 col-lg-4"><strong>Note Type:</strong> {{$note->note_type}}</div>
                                            <div class="col-sm-2 col-md-2 col-lg-4"><strong>Status:</strong> {{$note->status}}</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="row lh-26 no-pd-i">
                                            <div class="col-sm-2 col-md-2 col-lg-4"><strong>Activity:</strong> {{$note->activity}}</div>
                                            <div class="col-sm-2 col-md-2 col-lg-4"><strong>Priority:</strong> {{$note->priority}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="app-col-seperator m-b-10">
                            <div class="app-col-body">
                                <div class="row m-row--col-separator-xl">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="row lh-26">
                                            <div class="col-sm-12 col-md-12 col-lg-12"><strong>Title:</strong> {{$note->title}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="app-col-seperator height-100">
                            <div class="app-col-body">
                                <div class="row m-row--col-separator-xl">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="row lh-26">
                                            <div class="col-sm-12 col-md-12 col-lg-12 header">Description:</div>
                                        </div>
                                        <div class="row lh-26">
                                            <div class="col-sm-12 col-md-12 col-lg-12">{!! $note->note_desc !!}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="app-col-seperator height-100">
                        <div class="app-col-body">
                            <div class="row">
                                <!-- <div class="col-sm-6 col-md-6 col-lg-12 col-xl-12">
                                    <div class="row lh-26">
                                        <div class="col-sm-12 col-md-12 col-lg-5 header">Application ID</div>
                                        <div class="col-sm-12 col-md-12 col-lg-7">#{{$note->table_id}}</div>
                                    </div>
                                    <hr>
                                </div> -->
                                @if($volunteer)
                                    <div class="col-sm-6 col-md-6 col-lg-12 col-xl-12">
                                        <!-- <div class="row lh-26">
                                            <div class="col-sm-12 col-md-12 col-lg-5 header">Name:</div>
                                        </div> -->
                                        <div class="row lh-26">
                                            <div class="col-sm-6 col-md-6 col-lg-1 header">
                                                <i class="la la-user"></i>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-8">{{$volunteer->first_name}} {{$volunteer->middle_name}} {{$volunteer->last_name}}</div>
                                        </div>
                                        <div class="row lh-26">
                                            <div class="col-sm-6 col-md-6 col-lg-1 header">
                                                <i class="la la-map"></i>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-8">
                                                {{isset($volunteer->address()->add1)?$volunteer->address()->add1:""}} {{isset($volunteer->address()->add2)?", ".$volunteer->address()->add2:""}}
                                            </div>
                                        </div>
                                        <div class="row lh-26">
                                            <div class="col-sm-6 col-md-6 col-lg-1 header">
                                                <i class="la la-map-marker"></i>
                                            </div>

                                            <div class="col-sm-6 col-md-6 col-lg-8">
                                                {{isset($volunteer->address()->city)?$volunteer->address()->city:""}} @if(isset($volunteer->address()->state)), {{$volunteer->address()->state}} @endif
                                                @if(isset($volunteer->address()->zip_code)) {{$volunteer->address()->zip_code}} @endif
                                            </div>
                                        </div>
                                        @if(isset($volunteer->contact()->cell_phone) && $volunteer->contact()->cell_phone!="")
                                            <div class="row lh-26">
                                                <div class="col-sm-6 col-md-6 col-lg-1 header"><i
                                                            class="la la-phone"></i></div>
                                                <div class="col-sm-6 col-md-6 col-lg-8">
                                                    <?php
                                                    echo preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "($1) $2-$3", $volunteer->contact()->cell_phone);
                                                    ?>
                                                </div>
                                            </div>
                                        @endif
                                        @if(isset($volunteer->contact()->email) && $volunteer->contact()->email!="")
                                            <div class="row lh-26">
                                                <div class="col-sm-6 col-md-6 col-lg-1 header"><i
                                                            class="la la-envelope"></i></div>
                                                <div class="col-sm-12 col-md-12 col-lg-8">{{$volunteer->contact()->email}}</div>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                                @if(isset($files))
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <hr>
                                    <div class="row lh-26">
                                        <div class="col-sm-12 col-md-12 col-lg-12 header">Files</div>
                                    </div>
                                @foreach($files as $file)
                                    <div class="row lh-26 m-b-10">
                                        <div class="col-sm-10 col-md-10 col-lg-8">{{substr($file->file_name,0,20)}}...</div>
                                        <div class="col-sm-2 col-md-2 col-lg-4">
                                            <button type="button" class="m-btn btn btn-default btn-sm fileView" data-file="{{$file->file_name}}">
                                                <i class="la la-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">Cancel</button>
            @if(!$note->is_completed)
            <!-- <button type="button" class="btn btn-info m-btn--pill float-left" data-dismiss="modal" id="noteDone">Mark Done</button> -->
            @endif
            <button type="button" class="btn btn-accent m-btn--pill float-right"
                    data-modal-route="note/edit/{{$note->id}}" id="enable_form">Edit
            </button>
        </div>
    </div>
</div>
<script>
    $(document).off('click', '.fileView').on('click', '.fileView', function(e){
        e.preventDefault();
        var file = $(this).data('file');
        window.open('viewFile?file='+file);
    });

    $(document).off('click', '#noteDone').on('click', '#noteDone', function(e){
        e.preventDefault();
        var request = {
            url: 'noteDone/{{$note->id}}',
            method: 'get'
        }
        ajaxRequest(request, function(response){
            processForm(response, function(){});
        });
    });
</script>