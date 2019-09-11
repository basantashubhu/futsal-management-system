<div class="m-list-settings">
    @if(auth()->user()->role_id == 1 || auth()->user()->role->name == 'admin')
        <div class="m-list-settings__group">
            <div class="m-list-settings__heading">
                Site
            </div>

            <div class="m-list-settings__item">
			<span class="m-list-settings__item-label">
				Application Citizen Modal
			</span>
                <span class="m-list-settings__item-control">
			    <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
    			    <label>
        			    <input type="checkbox" id="applicationMode" name="applicationMode"
                               data-code="application_citizen_add_mode" rel="changeMode"
                               @if(modal_add_mode('application_citizen_add_mode')) checked=""
                               @endif value="on">
        	            <span></span>
    	            </label>
			    </span>
		    </span>
            </div>
            <div class="m-list-settings__item">
            <span class="m-list-settings__item-label">
                Application NP Modal
            </span>
                <span class="m-list-settings__item-control">
                <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                    <label>
                        <input type="checkbox" id="applicationNPMode" name="applicationNPMode"
                               data-code="application_np_add_mode" rel="changeMode"
                               @if(modal_add_mode('application_np_add_mode')) checked=""
                               @endif value="on">
                        <span></span>
                    </label>
                </span>
            </span>
            </div>
            <div class="m-list-settings__item">
                <span class="m-list-settings__item-label">
                    Provider Modal
                </span>
                    <span class="m-list-settings__item-control">
                    <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                        <label>
                            <input type="checkbox" id="providerMode" name="providerMode" data-code="provider_add_mode"
                                   rel="changeMode"
                                   @if(modal_add_mode('provider_add_mode')) checked=""
                                   @endif value="on">
                            <span></span>
                        </label>
                    </span>
                </span>
            </div>
            <div class="m-list-settings__item">
                <span class="m-list-settings__item-label">
                    Copay Reminder
                </span>
                    <span class="m-list-settings__item-control">
                    <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                        <label>
                            <input type="checkbox" id="copay_reminder" name="copay_reminder" data-code="copay_reminder"
                                   rel="changeNotification"
                                   @if(getSiteSettings('copay_reminder') && getSiteSettings('copay_reminder') == 'True') checked=""
                                   @endif value="on">
                            <span></span>
                        </label>
                    </span>
                </span>
            </div>
        </div>
    @endif
    <div class="m-list-settings__group">
        <div class="m-list-settings__heading">
            Notification
        </div>

        <div class="m-list-settings__item">
            <span class="m-list-settings__item-label">
            New Application
            </span>
            <span class="m-list-settings__item-control">
                <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                    <label>
                        <input type="checkbox" id="new_application" name="new_application"
                               data-code="new_application" rel="changeNotification"
                               @if(getSiteSettings('new_application') && getSiteSettings('new_application') == 'True') checked=""
                               @endif value="on">
                        <span></span>
                    </label>
                </span>
            </span>
        </div>
        <div class="m-list-settings__item">
            <span class="m-list-settings__item-label">
            Application Status Change
            </span>
            <span class="m-list-settings__item-control">
                <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                    <label>
                        <input type="checkbox" id="application_status_change" name="application_status_change"
                               data-code="application_status_change" rel="changeNotification"
                               @if(getSiteSettings('application_status_change') && getSiteSettings('application_status_change') == 'True') checked=""
                               @endif value="on">
                        <span></span>
                    </label>
                </span>
            </span>
        </div>
        <div class="m-list-settings__item">
            <span class="m-list-settings__item-label">
                Invoice Status Change
            </span>
                <span class="m-list-settings__item-control">
                <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                    <label>
                        <input type="checkbox" id="invoice_status_change" name="invoice_status_change" data-code="invoice_status_change"
                               rel="changeNotification"
                               @if(getSiteSettings('invoice_status_change') && getSiteSettings('invoice_status_change') == 'True') checked=""
                               @endif value="on">
                        <span></span>
                    </label>
                </span>
            </span>
        </div>
        <div class="m-list-settings__item">
            <span class="m-list-settings__item-label">
            New Client Registration
            </span>
            <span class="m-list-settings__item-control">
                <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                    <label>
                        <input type="checkbox" id="new_client_registered" name="new_client_registered"
                               data-code="new_client_registered" rel="changeNotification"
                               @if(getSiteSettings('new_client_registered') && getSiteSettings('new_client_registered') == 'True') checked=""
                               @endif value="on">
                        <span></span>
                    </label>
                </span>
            </span>
        </div>
    </div>
    <div class="m-list-settings__group">
        <div class="m-list-settings__heading">
            Invoice
        </div>
        <div class="m-list-settings__item">
            <span class="m-list-settings__item-label">
            Enable Batch Invoice
            </span>
            <span class="m-list-settings__item-control">
                <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                    <label>
                        <input type="checkbox" id="batch_invoice_show" name="batch_invoice_show"
                               data-code="batch_invoice_show" rel="changeNotification"
                               @if(getSiteSettings('batch_invoice_show') && getSiteSettings('batch_invoice_show') == 'True') checked=""
                               @endif value="on">
                        <span></span>
                    </label>
                </span>
            </span>
        </div>
        <div class="m-list-settings__item">
            <span class="m-list-settings__item-label">
            Invoice Payment Selection
            </span>
            <span class="m-list-settings__item-control">
                <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                    <label>
                        <input type="checkbox" id="invoice_payment_selection_all" name="invoice_payment_selection_all"
                               data-code="invoice_payment_selection_all" rel="changeNotification"
                               @if(getSiteSettings('invoice_payment_selection_all') && getSiteSettings('invoice_payment_selection_all') == 'True') checked=""
                               @endif value="on">
                        <span></span>
                    </label>
                </span>
            </span>
        </div>
    </div>

</div>
