<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <!-- Modal Header -->

        <!-- Modal Body -->
        <div class="modal-body ">
            <div class="row">
                <div class="col-4 col-sm-3">
                    <div class="m-portlet">
                        <div class="m-portlet__body bg-form-box p-a-1-i">
                            <button type="button" class="btn btn-accent btn-xs m-btn m-btn--custom m-b-10">
                                Load Template
                            </button>
                            <button type="button" class="btn btn-accent btn-xs m-btn m-btn--custom m-b-10">
                                Save Template
                            </button>

                            <button type="button" class="btn btn-accent btn-xs m-btn m-btn--custom m-b-10">
                                clear
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-8 col-sm-9">
                    <form class="m-form m-form--label-align-right" id="advanceSearch">
                        <div class="m-portlet">
                            <div class="m-portlet__body bg-form-box">
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">
                                        Status
                                    </label>
                                    <div class="col-10">
                                        <select class="form-control m-bootstrap-select" id="m_form_status">
                                            <option value="">
                                                All
                                            </option>
                                            <option value="1">
                                                Pending
                                            </option>
                                            <option value="2">
                                                Delivered
                                            </option>
                                            <option value="3">
                                                Canceled
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">
                                        Status
                                    </label>
                                    <div class="col-10">
                                        <select class="form-control m-bootstrap-select" id="m_form_status">
                                            <option value="">
                                                All
                                            </option>
                                            <option value="1">
                                                Pending
                                            </option>
                                            <option value="2">
                                                Delivered
                                            </option>
                                            <option value="3">
                                                Canceled
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <!-- Modal Footer -->
        <div class="modal-footer" style="display: inline-block;">
            <button type="button" class="btn btn-secondary m-btn--pill" data-dismiss="modal" style="float: left;">
                Cancel
            </button>
            <button type="button" class="btn btn-success m-btn--pill float-right" id="submitOrganization"
                    data-target="organizationCreate">
                Save
            </button>
        </div>
    </div>
</div>
<script>
    $('select').selectpicker();
</script>