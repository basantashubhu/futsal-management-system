 <div class="tab-pane" id="change_password">
    <form id="changePassword" class="m-form m-form--fit m-form--label-align-right">
        <div class="m-portlet__body">
            <div class="form-group m-form__group row">
                <label for="state" class="col-2 col-form-label">
                    Old Password <span class="required">*</span>
                </label>
                <div class="col-7">
                    <input type="password" class="form-control m-input" id="old_password" name="old_password"
                           autocomplete="off" onblur="checkPassword(this)">
                    <span id="wrong" style="color: red; display: none;">Doesn't Match With Your Old Password!</span>
                    <span id="wrong1" style="color: red; display: none;">Please Enter Old Password!</span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label for="state" class="col-2 col-form-label">
                    New Password <span class="required">*</span>
                </label>
                <div class="col-7">
                    <input type="password" class="form-control m-input" id="password" name="password"
                           autocomplete="off">
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label for="state" class="col-2 col-form-label">
                    Confirm Password <span class="required">*</span>
                </label>
                <div class="col-7">
                    <input type="password" class="form-control m-input" id="password_confirmation"
                           name="password_confirmation" autocomplete="off">
                    <span id="confirmation" style="color: red; display: none;">Password Do Not Match!</span>
                </div>
            </div>
        </div>
        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-7">
                        <button type="reset" class="btn btn-accent m-btn m-btn--pill m-btn--custom" id="submitPass" data-target="changePassword">
                            Save changes
                        </button>
                        &nbsp;&nbsp;
                        <button type="reset" class="btn btn-secondary m-btn m-btn--pill m-btn--custom">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>