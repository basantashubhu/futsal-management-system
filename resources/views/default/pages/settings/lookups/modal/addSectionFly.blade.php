<?php

?>
<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Create New Section
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider">
            <form id="SectionCreateFly" class="m-form">
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="SectionName" data-container="body" data-toggle="m-tooltip" data-placement="bottom" title data-original-title="Sequence Number" title="Sequence Number">
                            Section
                        </label>
                        <input type="text" class="form-control m-input" value="{{ request()->section_name }}" id="SectionName" name="section_name" autocomplete="off">
                    </div>
                    <div class="col-lg-12 mt15">
                        <label for="SectionDesc" data-container="body" data-toggle="m-tooltip" data-placement="bottom" title data-original-title="Sequence Number" title="Sequence Number">
                            Description
                        </label>
                        <textarea name="section_desc" id="SectionDesc" class="form-control" cols="30" rows="5"></textarea>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-success m-btn--pill float-right" id="submitSectionFly">
                Save
            </button>
        </div>
    </div>
</div>

<script>
    $(function () {
        $(document).off('click', '#submitSectionFly').on('click', '#submitSectionFly', function (e) {
            addFormLoader();
            let data = {};
            for (entry of new FormData(document.getElementById('SectionCreateFly'))) {
                data[entry[0]] = entry[1];
            }
            ajaxRequest({
                url: '/lookup/section/save', method: 'post', data
            },function (response) {
                processForm(response, function() {
                    reloadDatatable('.lookup_val_datatable_1');
                    // reloadDatatable('.lookup_val_datatable_'+v);
                    removeFormLoader();
                });

            });

        });
    });
</script>
