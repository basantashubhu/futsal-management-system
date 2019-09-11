<div class="modal-dialog" role="document">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header" style="background-color: #fff !important; border-color: #fff !important;">
            <h5 class="modal-title" id="exampleModalLabel" style="color: #3f4047 !important;">
                <span>Are you sure want to this solves the issue?</span>
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
            <button type="button" class="btn btn-success m-btn--icon m-btn--pill float-right" id="deleteSupport"
                    data-target="EventCreate"
                    data-dismiss="modal">
                <span>
                    <i class="la la-check"></i>
                    <span>Yes</span>
                </span>
            </button>
        </div>
    </div>
</div>
<script>
    $('#deleteSupport').on('click', function (e) {
        var request = {
            url: '/comment/bestanswer/{{$id}}/{{$comment->id}}',
            method: 'post',
        };

        ajaxRequest(request, function (response) {
            if('{{$from}}' == 'url'){
                location.reload();
            }else{
                routes.executeRoute('support/viewSingle/{id}', {
                    url : 'support/viewSingle/{{$id}}'
                });
            }
        });
    });
</script>