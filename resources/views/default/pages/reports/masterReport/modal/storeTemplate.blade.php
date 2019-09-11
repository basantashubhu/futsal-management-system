<div class="modal-dialog modal-md" role="document">

    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title">
                {{ucfirst($target)}} Template
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider">
            <form id="template" class="m-form m-form--label-align-right m-form--group-seperator-dashed">
                <div class="form-group np-pd-left no-pd-bottom m-form__group row">

                    <div class="col-sm-12">
                        <label for="example-text-input" class="col-form-label">Name</label>
                        <input class="form-control m-input form-control-sm m-input--air" type="text" value="" name="report_name"
                               id="report_name">
                        <input type="hidden" name="section" id="section" value="{{$target}}">
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-success m-btn--pill submitReportTemplate" id="submitReportTemplate"
                    data-target="template" data-dismiss="modal">
                Save
            </button>
        </div>
    </div>
</div>
<script>
$('.submitReportTemplate').off('click').on('click',function () {
    var data=document.templateData;
    var name=$('#report_name').val();
    var section=$('#section').val();

    var request={
        url:'/reports/template/save',
        method:'post',
        data:{key_val:data,section:section,report_name:name}
    };
    ajaxRequest(request,function (response) {
        processForm(response,function () {
            document.templateData=null;
        });
    });
})
</script>