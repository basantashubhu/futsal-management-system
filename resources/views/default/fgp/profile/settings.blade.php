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
										<input type="checkbox" class="communicationSettings" data-id="{{$user->id}}"
	                                           @if($user->communicationby('is_email')) checked="checked"
	                                           @endif name="is_email">
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
										<input type="checkbox" class="communicationSettings" data-id="{{$user->id}}"
	                                           @if($user->communicationby('is_mail')) checked="checked"
	                                           @endif name="is_mail">
										<span></span>
									</label>
								</span>
							</span>
	                    </div>
	                </div>
	            </div>
	        </div>
        </div>
    </div>
</div>