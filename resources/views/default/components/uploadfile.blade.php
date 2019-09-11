<div class="modal-dialog modal-lg" role="document" style="max-width: 1200px;">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Upload Files
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="modal-body no-pd-i">
            <!--Begin::Main Portlet-->
            <div class="m-portlet no-m-bottom no-bs-i">
                <form class="m-form m-form--fit m-form--label-align-right">
                    <div class="m-portlet__body">
                        <form method="post" id="fileUpload" enctype="multipart/form-data">

                            <div class="fallback">
                                <input name="file" type="file" multiple/>
                            </div>
                        </form>

                    </div>
                </form>
            </div>
            <!--end: Form Wizard-->
        </div>
        <!--End::Main Portlet-->


        <!-- Modal Footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary m-btn--pill" data-dismiss="modal">
                Close
            </button>
            <button type="button" class="btn btn-success m-btn--pill" id="Submitfile" data-target="fileUpload">
                upload
            </button>
        </div>
    </div>
</div>
<script>
    $('#Submitfile').on('click', function (e) {
        e.preventDefault();
        var request = {
            url: '/upload/file',
            method: 'post',
            form: $(this).attr('data-target')
        };

        ajaxRequest(request, function (response) {

            /*processForm(response, function () {
                reloadDatatable('.m_datatable');
            });*/

        });
    });
</script>
