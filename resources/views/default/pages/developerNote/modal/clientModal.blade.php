<?php

?>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title">
                Assign Note
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>

        <div class="modal-body">
            <form action="/developer-note/update/{{ $note->id }}" method="post" class="floatLabelForm" id="DNoteEdit">
                <div class="row">
                    <div class="col-md-12">
                        <select name="user_id" id="devPerson">
                        </select>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="float-left btn btn-secondary m-btn--pill" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="float-right btn btn-info m-btn--pill" onclick="$('#DNoteEdit').submit();">
                Assign
            </button>
        </div>
    </div>
</div>

<script>
    $(function (Form) {
        $('#devPerson').select2({
            dropdownParent: $('#DNoteEdit'),
            width: '100%', placeholder: 'User',
            ajax: { delay: 500, url: '/user/userList',
                processResults: results => ({results})
            }
        });
        Form.off('submit').on('submit', function (e) {
            e.preventDefault();
            sendAjax({
                url: Form.attr('action'), method: 'post',
                data: Form.serializeArray()
            }, r => {
                processModal();
                toastr.success('Note updated successfully.');
                reloadDatatable('#developernoteTable');
            }, function (err) {
                formValidation(err, true);
            });
        });
    }( $('#DNoteEdit') ));
</script>