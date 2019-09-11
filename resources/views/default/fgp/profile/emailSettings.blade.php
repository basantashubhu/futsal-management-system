 <div class="tab-pane" id="emailSettings">
    <form id="emailSettingsForm" class="m-form m-form--fit m-form--label-align-right">
        <div class="m-portlet__body">
            <div class="form-group m-form__group row">
                <label for="email" class="col-2 col-form-label">
                    Email <span class="required">*</span>
                </label>
                <div class="col-7">
                    <input type="text" class="form-control m-input" id="email" name="email" value="@if(isset($email)) {{$email->email}} @endif"
                           autocomplete="off">
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label for="email_from" class="col-2 col-form-label">
                    Email From <span class="required">*</span>
                </label>
                <div class="col-7">
                    <input type="text" class="form-control m-input" id="email_from" value="@if(isset($email)) {{$email->email_from}} @endif"
                           name="email_from" autocomplete="off">
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label for="server" class="col-2 col-form-label">
                    Server <span class="required">*</span>
                </label>
                <div class="col-7">
                    <input type="text" class="form-control m-input" id="server" value="@if(isset($email)) {{$email->server}} @endif"
                           name="serverName" autocomplete="off">
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label for="password" class="col-2 col-form-label">
                    Password <span class="required">*</span>
                </label>
                <div class="col-7">
                    <input type="password" class="form-control m-input" id="password" value="@if(isset($email)) {{$email->password}} @endif"
                           name="password" autocomplete="off">
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label for="mail_type" class="col-2 col-form-label">
                    Mail Type <span class="required">*</span>
                </label>
                <div class="col-7">
                    <select name="mail_type" class="form-control m-input">
                        <?php $mail_types = ['pop3' => 'POP3', 'imap' => 'IMAP', 'exchange_server' => 'Exchange Server']; ?>
                        @foreach($mail_types as $key => $v)
                        <option value="{{ $key }}" @if(isset($email) && $email->mail_type == $key) selected @endif>{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label for="is_auth_required" class="col-2 col-form-label">
                    Auth <span class="required">*</span>
                </label>
                <div class="col-7">
                    <div class="m-checkbox-list">
                        <label class="m-checkbox m-l-15-i">
                            <input type="checkbox" name="is_auth_required" id="is_auth_required" class="isChecked" @if(isset($email)) @if($email->is_auth_required) value="1" checked @else value="0" @endif @endif>
                            <span></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label for="is_ssl" class="col-2 col-form-label">
                    IS SSL <span class="required">*</span>
                </label>
                <div class="col-7">
                    <div class="m-checkbox-list">
                        <label class="m-checkbox m-l-15-i">
                            <input type="checkbox" name="is_ssl" id="is_ssl" class="isChecked" @if(isset($email)) @if($email->is_ssl) value="1" checked @else value="0" @endif @endif>
                            <span></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label for="is_tls" class="col-2 col-form-label">
                    IS TLS <span class="required">*</span>
                </label>
                <div class="col-7">
                    <div class="m-checkbox-list">
                        <label class="m-checkbox m-l-15-i">
                            <input type="checkbox" name="is_tls" id="is_tls" class="isChecked" @if(isset($email)) @if($email->is_tls) value="1" checked @else value="0" @endif @endif>
                            <span></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row hidden">
                <label for="is_tls" class="col-2 col-form-label">
                    
                </label>
                <div class="col-3">
                    <a href="javascript:;">Two Step Verification</a>
                </div>
                <div class="col-3">
                    <a href="javascript:;">App Password</a>
                </div>
            </div>
        </div>
        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-7">
                        <button type="reset" class="btn btn-accent m-btn m-btn--pill m-btn--custom" id="submitEmailForm" data-target="emailSettingsForm">
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
<script>
$(document).off('click', '.isChecked').on('click', '.isChecked', function(){
    // e.preventDefault();
    var self = $(this);
    if(self.prop('checked')){
        self.attr('data-checked', true);
        self.val('1');
    }else{
        self.attr('data-checked', false);
        self.val('0');
        self.removeAttr('checked');
    }
});
$(document).off('click', '#submitEmailForm').on('click', '#submitEmailForm', function(e){
    var request={
        url: 'emailSettings/store/{{$client->user_id}}',
        method: 'post',
        form: $(this).attr('data-target')
    }
    addFormLoader();
    ajaxRequest(request, function(response){
        processForm(response, function () {
            removeFormLoader();
            routes.executeRoute('userProfile/{id}', {
                url: 'userProfile/{{$client->id}}'
            });
        });
    });
});
</script>