<div class="modal-dialog modal-md" role="document">
	<div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                <span id='modal_dynamic_title'>Associated Vet</span>
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
                    <div class="app-col-seperator m-b-30">
                        <div class="app-col-body">
                            <div class="row m-row--col">
                                <div class="col-sm-6 col-md-6 col-lg-12 col-xl-12">
                                    <div class="row lh-26">
                                        <div class="col-sm-12 col-md-12 col-lg-12 header">{{$client->fname}} {{$client->mname}} {{$client->lname}}</div>
                                        <div class="col-sm-12 col-md-12 col-lg-12">License Number: {{$client->vet_lic}}</div>
                                    </div>
                                    @if(! $client->is_imported)
                                    <div class="row lh-26">
                                        <div class="col-sm-12 col-md-12 col-lg-12"><i class="la la-map-marker m-r-10"></i>{{$client->address->add1}} @if($client->add2) , {{$client->add2}} @endif</div>
                                        @if($client->contact->cell_phone)<div class="col-sm-12 col-md-12 col-lg-12"><i class="la la-phone m-r-10"></i>{{$client->contact->cell_phone}}</div>@endif
                                        @if($client->contact->personal_email)<div class="col-sm-12 col-md-12 col-lg-12"><i class="la la-envelope m-r-10"></i>{{$client->contact->personal_email}}</div>@endif
                                    </div>
                                    @endif
                                    <hr>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-12 col-xl-12">
                                    <div class="row lh-26">
                                        <div class="col-sm-12 col-md-12 col-lg-5 header">Organization ID</div>
                                        <div class="col-sm-12 col-md-12 col-lg-7">#43</div>
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
<!--             <button type="button" class="btn btn-danger m-btn--pill float-left" data-dismiss="modal" id="deleteVet">Delete</button>
            <button type="button" class="btn btn-accent m-btn--icon m-btn--pill float-right" data-sub-modal-route="/veterinarian/edit/{{$client->id}}">
                <span>
                    <span>Edit</span>
                </span>
            </button> -->
        </div>
    </div>
</div>
<script>
    $('#deleteVet').on('click', function(){
        var request = {
            url: '/client/delete/{{$client->id}}',
            method: 'post'
        };

        ajaxRequest(request, function (response) {
            reloadDatatable('#org_vet_datatable');
        });
    })
</script>