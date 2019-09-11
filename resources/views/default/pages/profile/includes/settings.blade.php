<div class="tab-pane " id="user_settings">
    <div class="m-portlet__body">
        <div class="row">
        	<div class="offset-lg-3 col-lg-6 col-sm-12 col-md-6">
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
										<input type="checkbox" class="communicationSettings" data-id="{{auth()->id()}}"
	                                           @if(auth()->user()->communicationby('is_email')) checked="checked"
	                                           @endif name="is_email">
										<span></span>
									</label>
								</span>
							</span>
	                    </div>

	                    <!-- <div class="m-list-settings__item">
							<span class="m-list-settings__item-label">
								Phone Alerts
							</span>
	                        <span class="m-list-settings__item-control">
								<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
									<label>
										<input type="checkbox" class="communicationSettings" data-id="{{auth()->id()}}"
	                                           @if(auth()->user()->communicationby('is_phone')) checked="checked"
	                                           @endif name="is_phone">
										<span></span>
									</label>
								</span>
							</span>
	                    </div> -->
	                    <div class="m-list-settings__item">
							<span class="m-list-settings__item-label">
								Postal Mail
							</span>
	                        <span class="m-list-settings__item-control">
								<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
									<label>
										<input type="checkbox" class="communicationSettings" data-id="{{auth()->id()}}"
	                                           @if(auth()->user()->communicationby('is_mail')) checked="checked"
	                                           @endif name="is_mail">
										<span></span>
									</label>
								</span>
							</span>
	                    </div>
	                    <!-- <div class="m-list-settings__item">
							<span class="m-list-settings__item-label">
								SMS Alerts
							</span>
	                        <span class="m-list-settings__item-control">
								<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
									<label>
										<input type="checkbox" class="communicationSettings" data-id="{{auth()->id()}}"
	                                           @if(auth()->user()->communicationby('is_sms')) checked="checked"
	                                           @endif name="is_sms">
										<span></span>
									</label>
								</span>
							</span>
	                    </div> -->

	                </div>
	                <!-- <div class="m-list-settings__group">
	                    <div class="m-list-settings__heading">
	                        Notification Settings
	                    </div>
	                    <div class="m-list-settings__item">
							<span class="m-list-settings__item-label">
								Fiscal Approved
							</span>
	                        <span class="m-list-settings__item-control">
								<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
									<label>
										<input type="checkbox" class="notificationSettings" data-id="{{auth()->id()}}"
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
	                                           name="application_process" value="true" data-id="{{auth()->id()}}"

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
	                                           name="application_rejected" value="true" data-id="{{auth()->id()}}"
	                                           @if(  checkSettings('application_rejected') ) checked="checked" @endif
	                                    >
										<span></span>
									</label>
								</span>
	               	 		</span>
	                    </div>
	                </div> -->
	            </div>
	        </div>
        </div>
    </div>
</div>