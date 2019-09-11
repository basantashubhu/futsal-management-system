<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Available City
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="m-section__content">
                        <form class="m-b-20 row">
                            <div class="col-sm-6 input-group m-input-group--inline w-220 pill-style">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background-color: #f2f3f8 !important; border-top-left-radius: 20px;border-bottom-left-radius: 20px; height: 27px; border: none !important;">
                                        City
                                    </span>
                                </div>
                                <input type="text" class="form-control m-input" aria-describedby="basic-addon1" style="height: 27px; border-top-right-radius: 20px;border-bottom-right-radius: 20px;" id="sp_vetFilter" autocomplete="off">
                            </div>
                        </form>
                        <div class="show_vet_datatable">
                            <table class="table m-table m-table--head-bg-success">
                                <thead>
                                    <tr>
                                        <th>
                                            City
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($city as $c)
                                    <tr>
                                        <td>
                                            {{$c->city}}
                                        </td>
                                        <td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary m-btn--pill" data-dismiss="modal">
                Cancel
            </button>
        </div>
    </div>
</div>
<script>


</script>