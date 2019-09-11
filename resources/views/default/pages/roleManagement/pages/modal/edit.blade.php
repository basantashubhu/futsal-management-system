<div class="modal-dialog custom_disable modal-lg" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                EditPage
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider">
            <form id="pageEdit" class="m-form m-form--label-align-right m-form--group-seperator-dashed">
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="zip_code">
                            Page Name <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control m-input" id="page_name" name="page_name" placeholder="dashboard" autocomplete="off" value="{{$page->page_name}}">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="state">
                            Action <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control m-input" id="action" name="action" placeholder="multiple action separate By |" autocomplete="off" value="{{$page->action}}">
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary m-btn--pill" data-dismiss="modal">
                Close
            </button>
            <button type="button" class="btn btn-accent m-btn--pill enable_form">Edit</button>
            <button type="button" class="btn btn-success m-btn--pill" id="submitPage" data-target="pageEdit" data-id="{{$page->id}}"  style="display: none;">Save</button>
        </div>
    </div>
</div>

<script>
    BootstrapDatetimepicker.init();
    BootstrapSelect.init();
    $('.custom_disable').find(':input').not('button').attr("disabled", true);

    $(document).off('click', '#submitPage').on('click', '#submitPage', function (e) {
        var id=$(this).attr('data-id');
        var request = {
            url: '/pages/update/'+id,
            method: 'post',
            form: $(this).attr('data-target')
        };
addFormLoader();

        ajaxRequest(request,function (response) {
            processForm(response, function() {
                reloadDatatable('.m_datatable');
removeFormLoader();
            });
        });

    });
</script>