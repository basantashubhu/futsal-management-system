<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Create New Permission </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider">
            <form id="pageCreate" class="m-form m-form--label-align-right m-form--group-seperator-dashed">

                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="zip_code">
                            Page Name <span class="required">*</span>
                        </label>
                        <select class="form-control m-input" name="page_id" id="page_id">
                            <option value="">Select</option>
                            @foreach($pages as $page)
                                <option value="{{$page->id}}">{{$page->page_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="zip_code">
                            Permission Name <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control m-input" id="name" name="name" placeholder="Dashboard All"
                               autocomplete="off">
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="state">
                            Action <span class="required">*</span>
                        </label>
                        <div id="action-holder">

                        </div>
                        {{--<input type="text" class="form-control m-input" id="action" name="action" placeholder="multiple action separate By |" autocomplete="off">--}}
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-success m-btn--pill float-right" id="submitPermission" data-target="pageCreate">
                Save
            </button>
        </div>
    </div>
</div>

<script>

    $(function () {
        $('#page_id').selectpicker();
    });

    $(document).off('click', '#submitPermission').on('click', '#submitPermission', function (e) {
        var request = {
            url: '/permission/add',
            method: 'post',
            form: $(this).attr('data-target')
        };
        addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function () {
                reloadDatatable('.m_datatable');
                removeFormLoader();
            });
        });

    });


    $('#page_id').on('change', function (e) {
        var id = $(this).val();
        var request = {
            url: '/pages/getAction/' + id,
            method: 'get'
        };

        ajaxRequest(request, function (response) {
            var data = response.data;
            var content="";
            for (var action in data) {
                content+='<label class="m-checkbox m-checkbox--solid m-checkbox--success text-capitalize">'+
                        '<input type="checkbox" name="'+data[action]+'">'+
                            data[action].charAt(0).toUpperCase()+data[action].slice(1)+
                        '<span></span> </label><br />';
            }
            $('#action-holder').html(content);
        })
    })
</script>