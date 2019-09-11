<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header order-0">
            <h3 class="modal-title">Volunteer Transfer</h3>
            <button type="button" class="close mt-5" data-dismiss="modal">
            </button>
        </div>
        <div class="modal-footer order-2 justify-center">
                <button type="button" class="btn m-btn btn-success m-btn--icon m-btn--pill" id="TransferProceed">
                    Transfer
                </button>
        </div>
        <div class="modal-body order-1">
            <form action="javascript:;" id="VolTransferForm">
                <div class="form-group">
                    <label for="Supervisor">Supervisor</label>
                    <select name="supervisor_id" class="form-control" id="Supervisor">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('#Supervisor').select2({
            width: '100%', placeholder: 'Choose', dropdownParent: $('#VolTransferForm'),
            ajax: {
                url: '/lookup/reporting_mgr', delay: 500,
                processResults(results) {
                    results = results.filter(({text}) => text.toLowerCase().indexOf('supervisor') > -1);
                    return {results};
                }
            }
        });
    });
</script>