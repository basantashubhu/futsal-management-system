<div class="modal-dialog modal-md" role="document">

    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title">
                {{ucfirst($section)}} Template
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider">
            <div class="row m-t-10-i">
                <div class="col-sm-12">
                    <table class="table table-bordered m-table m-table--border-info dataTemplate text-center max-h-400">
                        <tr>
                            <th>Name</th>
                        </tr>
                        @foreach($templates as $temp)
                            <tr data-id="{{$temp->id}}">
                                <td>
                                    {{$temp->report_name}}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

            </div>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-success m-btn--pill loadReportTemp" id="loadReportTemp" data-dismiss="modal">
                Load
            </button>
        </div>
    </div>
</div>
<script>


</script>