<div class="modal-dialog" role="document">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                <span id='modal_dynamic_title'>Reason for Disapprove.</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row no-m no-pd-i">
                <div class="col-sm-12 col-md-12">
                    <div class="app-col-body">
                        <div class="row m-row--row-separator-xl">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="row lh-26">
                                    <div class="col-sm-12 col-md-6 col-lg-12">{{$organization->comments}}</div>
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
<!--             <button type="button" class="btn btn-accent m-btn--icon m-btn--pill float-right" data-dismiss="modal">
                <span>
                    <span>Ok</span>
                </span>
            </button> -->
        </div>
    </div>
</div>