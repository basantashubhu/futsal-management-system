<div class="modal-dialog modal-lg custom_disable" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Modify Permission </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider">
            <form id="permissionEdit" class="m-form m-form--label-align-right m-form--group-seperator-dashed">

                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="page_id">
                            Page Name <span class="required">*</span>
                        </label>
                        <select class="form-control m-input" name="page_id" id="page_id">
                            <option value="">Select</option>
                            @foreach($pages as $page)
                                <option value="{{$page->id}}" {{$page->id==$permission->page_id?"selected":""}}>{{$page->page_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="name">
                            Permission Name <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control m-input" id="name" name="name" placeholder="Dashboard All" value="{{$permission->name}}"
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
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">
                Close
            </button>
            <button type="button" class="btn btn-accent m-btn--pill enable_form float-right">Edit</button>
            <button type="button" class="btn btn-success m-btn--pill float-right" id="updatePermission" data-target="permissionEdit" data-id="{{$permission->id}}"  style="display: none;">Save</button>

        </div>
    </div>
</div>

<script>

    $(document).ready(function () {
        var id= '{{$permission->page_id}}';
        var action= '{{$permission->action}}';
        console.log(id, action)
        actionLoad(id,action);

    });

    function actionLoad(id,action="") {
        var request = {
            url: '/pages/getAction/' + id,
            method: 'get'
        };

        action=action.split('|');

        ajaxRequest(request, function (response) {
            var data = response.data;
            var content="";
            for (var index in data) {
                if(action[0]!="" && action.indexOf(data[index])!=-1)
                {
                    content+='<label class="m-checkbox m-checkbox--solid m-checkbox--success text-capitalize">'+
                            '<input type="checkbox" checked name="'+data[index]+'">'+
                            data[index].charAt(0).toUpperCase()+data[index].slice(1)+
                            '<span></span> </label><br />';
                }
                else
                {
                    content+='<label class="m-checkbox m-checkbox--solid m-checkbox--success text-capitalize">'+
                            '<input type="checkbox" name="'+data[index]+'">'+
                            data[index].charAt(0).toUpperCase()+data[index].slice(1)+
                            '<span></span> </label><br />';
                }


            }
            $('#action-holder').html('').html(content);
            if(action[0]!="")
                $('.custom_disable').find(':input').not('button').attr("disabled", true);
        })
    }

    BootstrapSelect.init();
    $(document).off('click', '#updatePermission').on('click', '#updatePermission', function (e) {
        var id=$(this).attr('data-id');
        var request = {
            url: '/permission/update/'+id,
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
        actionLoad(id);
    })
</script>