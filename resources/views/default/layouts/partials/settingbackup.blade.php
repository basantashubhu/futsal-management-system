<div class="m-list-settings">
    <div class="m-list-settings__group">
        <div class="m-list-settings__heading">
            Communication Preference
        </div>
        <div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										Email Notifications
									</span>
            <span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox"  class="communicationSettings"
                                                       @if(auth()->user()->communicationby('is_email')) checked="checked"
                                                       @endif name="is_email">
												<span></span>
											</label>
										</span>
									</span>
        </div>

        <div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										Phone Alerts
									</span>
            <span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" class="communicationSettings"
                                                       @if(auth()->user()->communicationby('is_phone')) checked="checked"
                                                       @endif name="is_phone">
												<span></span>
											</label>
										</span>
									</span>
        </div>
        <div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										Postal Mail
									</span>
            <span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox"  class="communicationSettings"
                                                       @if(auth()->user()->communicationby('is_mail')) checked="checked"
                                                       @endif name="is_mail">
												<span></span>
											</label>
										</span>
									</span>
        </div>
        <div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										SMS Alerts
									</span>
            <span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox"  class="communicationSettings"
                                                       @if(auth()->user()->communicationby('is_sms')) checked="checked"
                                                       @endif name="is_sms">
												<span></span>
											</label>
										</span>
									</span>
        </div>

    </div>
    <div class="m-list-settings__group">
        <div class="m-list-settings__heading">
            Notification Settings
        </div>
        <div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										Application Approved
									</span>
            <span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" class="notificationSettings"
                                                       name="application_approve" value="true"
                                                       @if(  checkSettings('application_approve') ) checked="checked" @endif>
												<span></span>
											</label>
										</span>
									</span>
        </div>
        <div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										Application Processed
									</span>
            <span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" class="notificationSettings"
                                                       name="application_process" value="true"

                                                       @if(  checkSettings('application_process') ) checked="checked" @endif
                                                >
												<span></span>
											</label>
										</span>
									</span>
        </div>
        <div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										Application Rejected
									</span>
            <span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" class="notificationSettings"
                                                       name="application_rejected" value="true"
                                                       @if(  checkSettings('application_rejected') ) checked="checked" @endif
                                                >
												<span></span>
											</label>
										</span>
                            </span>
        </div>
    </div>
</div>