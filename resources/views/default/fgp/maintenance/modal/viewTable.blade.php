<style>
.scrollableTable, #viewSection{
    max-height: 300px;
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
                {{$table->label}}
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        
        <div class="modal-body">
            @if(isset($fields))
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive scrollableTable">
                        <table class="table table-bordered table-hover bg-white">
                            <thead>
                                <tr>
                                    <?php $l=0; ?>
                                    @foreach($fields as $field)
                                    <th>{{$labels[$l]}}</th>
                                    <?php $l++; ?>
                                    @endforeach
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $da)
                                <tr class="showDetailRow" data-id="{{$da['id']}}">
                                    @foreach($fields as $field)
                                        <td>{{str_limit($da[$field],20)}}</td>
                                    @endforeach
                                    <td>
                                        <a href="#" class="btn btn-outline-primary m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill showDetailRow" data-id="{{$da['id']}}">
                                            <i class="la la-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
            @if($firstItem)
            <div class="row">
                <div class="col-sm-12">
                    <div class="m-portlet">
                        <form id="updateTable" class="m-form m-t-30 bg-white">
                            <div class="m-portlet__body" id="viewSection">
                                <?php $p=0; ?>
                                @foreach($firstItem as $k=>$v)
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">{{$labels[$p]}}:</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="{{$k}}" class="form-control m-input" value="{{$v}}">
                                    </div>
                                </div>
                                <?php $p++; ?>
                                @endforeach
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-danger m-btn--pill float-left" id="deleteSelectedData" data-sub-modal-route="deleteSelectedData/{{$table->table_name}}/@if($firstItem){{$firstItem->id}}@endif" data-callback-modal="deleteTableData">
                Delete
            </button>
            <button type="button" class="btn btn-success m-btn--pill float-right" id="updateSelectedData" data-target="updateTable" data-id="@if($firstItem){{$firstItem->id}}@endif">
                Save
            </button>
            <button type="button" class="btn btn-info m-btn--pill float-right" id="editLabel" data-sub-modal-route="editTable/{{$table->id}}" data-callback-modal="updateLabel">
                Edit Label
            </button>
        </div>
    </div>
</div>
<script>
$(document).off('click', '.showDetailRow').on('click', '.showDetailRow', function(e){
    e.preventDefault();
    var id = $(this).attr("data-id");
    var request = {
        url: 'singleRowDetail/{{$table->table_name}}/'+id,
        method:'get'
    }
    ajaxRequest(request, function(response){
        $('#deleteSelectedData').attr('data-sub-modal-route', "deleteSelectedData/{{$table->table_name}}/"+id);
        $('#updateSelectedData').attr('data-id',id);
        $('#viewSection').html(response.data);
    });
});
function updateLabel(id){
    var request = {
        url: 'singleRowDetail/{{$table->table_name}}/'+id,
        method:'get'
    }
    ajaxRequest(request, function(response){
        $('#viewSection').html(response.data);
    });
}

$(document).off('click', '#updateSelectedData').on('click', '#updateSelectedData', function(e){
    e.preventDefault();
    var id = $(this).attr('data-id');
    var request = {
        url: 'updateTableData/{{$table->table_name}}/'+id,
        method: 'post',
        form: $(this).attr('data-target')
    }
    addFormLoader();
    ajaxRequest(request, function(response){
        processForm(response, function(){
            removeFormLoader();
        });
    });
});
function deleteTableData(id){
    var n = $('.scrollableTable').find('tr[data-id='+id+']').next();
    if(n.length > 0){
        $('.scrollableTable').find('tr[data-id='+id+']').next().find('td:last-child').find('a').click();
    }else{
        $('.scrollableTable').find('tr[data-id='+id+']').prev().find('td:last-child').find('a').click();
    }
    $('.scrollableTable').find('tr[data-id='+id+']').hide();
}
</script>