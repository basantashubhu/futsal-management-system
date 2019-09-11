<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                <span id='modal_dynamic_title'>Procedure</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    &times;
                </span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="app-col-seperator height-100 m-b-30">
                        <div class="app-col-body">
                            <div class="row m-row--col-separator-xl">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="row lh-26">
                                        <div class="col-sm-6 col-md-6 col-lg-4 header">Name</div>
                                        <div class="col-sm-6 col-md-6 col-lg-8">{{$treatment->treatment_name}}</div>
                                    </div>
                                    <div class="row lh-26">
                                        <div class="col-sm-6 col-md-6 col-lg-4 header">Type</div>
                                        <div class="col-sm-6 col-md-6 col-lg-8">{{$treatment->treatment_type}}</div>
                                    </div>
                                    <div class="row lh-26">
                                        <div class="col-sm-6 col-md-6 col-lg-4 header">Is Must</div>
                                        <div class="col-sm-6 col-md-6 col-lg-8">
                                            @if($treatment->is_must)
                                            <button class="btn btn-sm m-btn--pill btn-success c-p">Yes</button>
                                            @else
                                            <button class="btn btn-sm m-btn--pill btn-warning c-p">No</button>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row lh-26">
                                        <div class="col-sm-6 col-md-6 col-lg-12 header">Description</div>
                                    </div>
                                    <div class="row lh-26">
                                        <div class="col-sm-6 col-md-6 col-lg-12">{{$treatment->description}}</div>
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
        </div>
    </div>
</div>
