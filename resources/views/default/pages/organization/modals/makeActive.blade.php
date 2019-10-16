<div class="modal-dialog" role="document">
	<div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header" style="background-color: #fff !important; border-color: #fff !important;">
            <h5 class="modal-title" id="exampleModalLabel" style="color: #3f4047 !important;">
                <span id='modal_dynamic_title'>Are you sure want to @if($organization->is_active) deactivate @else activate @endif this?</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #3f4047 !important;">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>

	 	<!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-success m-btn--icon m-btn--pill float-right" id="makeActiveORg"
            data-target="EventCreate"
            data-dismiss="modal">
                <span>
                    <span>Yes</span>
                </span>
            </button>
        </div>
    </div>
</div>
<script>
    $(document).off('click', '#makeActiveORg').on('click', '#makeActiveORg',  function (e) {
        var request = {
            url: '/makeActive/{{$organization->id}}',
            method: 'post',
        };
        addFormLoader();
        ajaxRequest(request, function (response) {
            if('{{$from}}' == 'table'){
                reloadDatatable('#np_datatable');
            }else{
                routes.executeRoute('org/single/{id}',{
                     url : '/org/single/{{$organization->id}}'
                });
            }
            removeFormLoader();
        });
    });
</script>