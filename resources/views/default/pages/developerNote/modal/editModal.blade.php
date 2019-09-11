<?php

?>
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title">
                Modify Note
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
                    <div class="col-md-6 field mb-4">
                        <select name="is_done" id="note_status" title="Status">
                            <option value="1" @if($note->is_done) selected @endif>Done</option>
                            <option value="0" @unless($note->is_done) selected @endif>Pending</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <textarea name="text" id="DNoteText" cols="30" rows="10">{!! $note->text !!}</textarea>
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
                Update
            </button>
        </div>
    </div>
</div>

<script>
    $(function (Form) {
        $('#note_status').select2({
            dropdownParent: Form, width: '100%', placeholder: 'Status',
            minimumResultsForSearch: -1
        });

        $('#DNoteText').summernote({
            height: 300
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