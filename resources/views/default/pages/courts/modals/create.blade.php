<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title">
                <span class='h2'>Add Note</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    &times;
                </span>
            </button>
        </div>


        <!-- Modal Body -->
        <div class="modal-body">
            <form action="javascript:;" id="courtCreateForm">
                @csrf

                <div class="row no-padding">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="courtname">Court Name</label>
                            <input type="text" name="name" class="form-control m-input" id="courtname">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-md-10">
                                <label for="courtorg_id">Organization</label>
                                <select name="organization_id" id="courtorg_id" class="form-control">

                                </select>
                            </div>
                            <div class="col-auto pt-25">
                                <button type="button" class="btn m-btn btn-sm btn-info"
                                    data-sub-modal-route="organizations/create"
                                    data-sub-modal-callback="selectOrganization" title="Add new organization">
                                    <i class="la la-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>


        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-success m-btn--icon m-btn--pill float-right" id="submitNote"
                data-target="courtCreateForm">
                <span>
                    <span>Save</span>
                </span>
            </button>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        $('#courtorg_id').select2({
            width: '100%',
            placeholder: 'Choose',
            dropdownParent: $('#courtCreateForm'),
            ajax: {
                url: 'organizations/select2',
                processResults(results) {
                    return {
                        results
                    };
                }
            }
        });
    });

</script>
