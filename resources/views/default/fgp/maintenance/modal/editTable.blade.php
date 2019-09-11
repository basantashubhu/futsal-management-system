<style>
.scrollableTable, #viewSection{
    max-height: 400px;
    overflow:auto;
}
.scrollableTable::-webkit-scrollbar, #viewSection::-webkit-scrollbar{
    width: 1px;
}
.scrollableTable::-webkit-scrollbar-track, #viewSection::-webkit-scrollbar-track{
    width: 1px;
}
/* Handle */
.scrollableTable::-webkit-scrollbar-thumb, #viewSection::-webkit-scrollbar-thumb{
    background: #888;
}

/* Handle on hover */
.scrollableTable::-webkit-scrollbar-thumb:hover,#viewSection::-webkit-scrollbar-thumb:hover {
    background: #555;
}
.m-form .m-form__group{
    padding-bottom:0px !important;
}
</style>
<div class="modal-dialog modal-custom-medium-width" role="document">
    <div class="modal-content">
    	<!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title">
                Change Label and Description of Table: {{$table->label}}
            </h5>
            <button type="button" class="close close1" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        
        <div class="modal-body">
        <form id="updateTableForm">
            @if(isset($fields))
            <div class="row">
                <div class="col-sm-12 mainTable">
                    <div class="m-portlet m--margin-bottom-30">
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group row">
                                <div class="col-lg-3">
                                    <label ><strong>Table Name:</strong></label>
                                    <input type="text" name="table_name" class="form-control form-control-sm m-input" value="{{$table->table_name}}" disabled>
                                </div>
                                <div class="col-lg-3">
                                    <label class=""><strong>Label:</strong></label>
                                    <input type="text" name="label" class="form-control form-control-sm m-input" value="{{$table->label}}">
                                </div>
                                <div class="col-lg-6">
                                    <label class=""><strong>Description:</strong></label>
                                    <input type="text" name="description" class="form-control form-control-sm m-input" value="{{$table->description}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 ">
                    <div class="table-responsive scrollableTable">
                        <table class="table table-bordered table-hover bg-white">
                            <thead>
                                <tr>
                                    <th>Field Name</th>
                                    <th>Label</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $d)
                                <tr class="tableField">
                                    <td>
                                        {{$d->field_name}}
                                        <input type="hidden" name="field_id" class="form-control form-control-sm m-input" value="{{$d->id}}">
                                    </td>
                                    <td><input name="field_label" type="text" class="form-control form-control-sm m-input" value="{{$d->label}}"></td>
                                    <td>
                                        <input name="field_description" type="text" class="form-control form-control-sm m-input"  value="{{$d->description}}">
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </form>
        </div>
        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-success m-btn--pill float-right" id="SubmitData">
                Save
            </button>
        </div>
    </div>
</div>
<script>
$(document).off('click', '#SubmitData').on('click', '#SubmitData', function(e){
    e.preventDefault();
    var data = arrangeData(['mainTable', 'tableField']);
    var request = {
        url: 'updateTableFields/{{$table->id}}',
        method: 'post',
        data: data
    }

    ajaxRequest(request, function(response){
        processForm(response, function(){
            var r = $('#SubmitData').closest('.modal').attr('rel');
            if(r==='subModalContainer'){
                $('.close1').click();
                updateLabel('{{$table->id}}');
            }
            reloadDatatable('#table_name');
        });
    });
});
</script>