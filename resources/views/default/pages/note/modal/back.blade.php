<div class="modal-dialog" role="document" style="max-width: 1000px; margin: 1.75rem auto;">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                <span id='modal_dynamic_title'>Application Note</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    &times;
                </span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-6">
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
                                                <div class="col-sm-6 col-md-6 col-lg-1 header"><i
                                                            class="la la-phone"></i></div>
                                                <div class="col-sm-6 col-md-6 col-lg-8">{{isset($client->contact)?$client->contact->phone:""}}</div>
                                            </div>
                                        @endif
                                        @if(isset($client->contact) && !is_null($client->contact->personal_email) && $client->contact->personal_email!="")
                                            <div class="row lh-26">
                                                <div class="col-sm-6 col-md-6 col-lg-1 header"><i
                                                            class="la la-envelope"></i></div>
                                                <div class="col-sm-6 col-md-6 col-lg-8">{{isset($client->contact)?$client->contact->personal_email:""}}</div>
                                            </div>
                                        @endif
                                        <div class="row lh-26">
                                            <div class="col-sm-6 col-md-6 col-lg-1 header"><i
                                                        class="la la-map-marker"></i></div>
                                            <div class="col-sm-6 col-md-6 col-lg-8">{{isset($client->address)?$client->address->add1:""}}</div>
                                        </div>
                                        <hr>
                                    </div>
                                @else
                                    <div class="col-sm-6 col-md-6 col-lg-12 col-xl-12">
                                        <div class="row lh-26">
                                            <div class="col-sm-12 col-md-12 col-lg-12 header">{{$data->cname}}</div>
                                            <div class="col-sm-12 col-md-12 col-lg-12">License
                                                Number: {{$data->lic_no}}</div>
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
                                <div class="col-sm-6 col-md-6 col-lg-12 col-xl-12">
                                    <div class="row lh-26">
                                        <div class="col-sm-12 col-md-12 col-lg-5 header">File</div>
                                        <div class="col-sm-12 col-md-12 col-lg-7">#{{$note->table_id}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="app-col-seperator height-100 m-b-30">
                        <div class="app-col-body">
                            <div class="row m-row--col-separator-xl">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="row lh-26">
                                        <div class="col-sm-6 col-md-6 col-lg-4 header">Segment</div>
                                        <div class="col-sm-6 col-md-6 col-lg-8">{{$note->segment}}</div>
                                    </div>
                                    <div class="row lh-26">
                                        <div class="col-sm-6 col-md-6 col-lg-4 header">Title</div>
                                        <div class="col-sm-6 col-md-6 col-lg-8">{{$note->title}}</div>
                                    </div>
                                    <div class="row lh-26">
                                        <div class="col-sm-6 col-md-6 col-lg-4 header">Note Type</div>
                                        <div class="col-sm-6 col-md-6 col-lg-8">{{$note->note_type}}</div>
                                    </div>
                                    <div class="row lh-26">
                                        <div class="col-sm-6 col-md-6 col-lg-4 header">Status</div>
                                        <div class="col-sm-6 col-md-6 col-lg-8">{{$note->status}}</div>
                                    </div>
                                    <div class="row lh-26">
                                        <div class="col-sm-6 col-md-6 col-lg-4 header">Priority</div>
                                        <div class="col-sm-6 col-md-6 col-lg-8">{{$note->priority}}</div>
                                    </div>
                                    <div class="row lh-26">
                                        <div class="col-sm-6 col-md-6 col-lg-4 header">Activity</div>
                                        <div class="col-sm-6 col-md-6 col-lg-8">{{$note->activity}}</div>
                                    </div>
                                    <div class="row lh-26">
                                        <div class="col-sm-6 col-md-6 col-lg-4 header">Start Date</div>
                                        <div class="col-sm-6 col-md-6 col-lg-8">{{format_date($note->start)}}</div>
                                    </div>
                                    <div class="row lh-26">
                                        <div class="col-sm-6 col-md-6 col-lg-4 header">End Date</div>
                                        <div class="col-sm-6 col-md-6 col-lg-8">{{format_date($note->end)}}</div>
                                    </div>
                                    <div class="row lh-26">
                                        <div class="col-sm-6 col-md-6 col-lg-4 header">Reminder Date</div>
                                        <div class="col-sm-6 col-md-6 col-lg-8">{{format_date($note->reminder_timestamp)}}</div>
                                    </div>
                                    <br>
                                    <div class="row lh-26">
                                        <div class="col-sm-6 col-md-6 col-lg-12 header">Notes</div>
                                    </div>
                                    <div class="row lh-26">
                                        <div class="col-sm-6 col-md-6 col-lg-12">{{$note->notes}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-accent m-btn--pill float-right"
                    data-modal-route="note/edit/{{$note->id}}" id="enable_form">Edit
            </button>
        </div>
    </div>
</div>