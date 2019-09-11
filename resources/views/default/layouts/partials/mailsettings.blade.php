<div class="m-list-settings">
    @if(auth()->user()->role_id == 1 || auth()->user()->role->name == 'admin')
        <div class="m-list-settings__group">
            <div class="m-list-settings__heading">
              Email Settings
            </div>
            <div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										Email Queue
									</span>
                <span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
										<label>
										<input type="checkbox" rel ="mailChange" data-code ="email_mode" name="clientCredential"
                                               @if(email_mode())checked="" @endif value="on">
								        <span></span>
								            </label>
                                        </span>
                </span>
            </div>

            <div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										Send Client Credentials
									</span>
                <span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
										<label>
										<input type="checkbox"   rel="mailChange" data-code="EmailQueue-Clients"
                                               @if(client_credential_sent_mode())checked="" @endif value="on">
								        <span></span>
								            </label>
                                        </span>
                </span>
            </div>

            <div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										Application Review
									</span>
                <span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
										<label>
										<input type="checkbox"   rel="mailChange" data-code="mail_application_review"
                                               @if(email_app_review__mode())checked="" @endif value="on">
								        <span></span>
								            </label>
                                        </span>
                </span>
            </div>

            <div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										Application Approved
									</span>
                <span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
										<label>
										<input type="checkbox"  rel="mailChange" data-code = "mail_application_approved"
                                               @if(email_app_approved__mode())checked="" @endif value="on">
								        <span></span>
								            </label>
                                        </span>
                </span>
            </div>
        </div>
    @endif
</div>
