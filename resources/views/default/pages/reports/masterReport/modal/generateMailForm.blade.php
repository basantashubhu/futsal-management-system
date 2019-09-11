<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title">
                Generate Mail List
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
            <form id="mailForm" class="m-form">
                <div class="form-group m-form__group row">
                    <div class="col-lg-4">
                        <label for="code" class="required">
                            Report Name
                        </label>
                        <input type="text" name="report_name" class="form-control m-input form-control-sm" autocomplete="off">
                    </div>
                </div>
                <div class="row m-t-10-i">
                    <div class="col-sm-12">
                        <table class="table table-bordered m-table m-table--head-bg-success generateMailTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Table</th>
                                    <th>Document Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lists as $list)
                                <tr>
                                    <td>
                                        <label class="m-checkbox">
                                            <input type="checkbox" class="checkedToGenerate">
                                            <span></span>
                                        </label>
                                    </td>
                                    <td>{{ucfirst($list->table)}}</td>
                                    <td>{{$list->document_title}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill" data-dismiss="modal">
                Cancel
            </button>
        </div>
    </div>
</div>