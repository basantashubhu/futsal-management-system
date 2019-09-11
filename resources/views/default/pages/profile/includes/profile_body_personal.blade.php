<div class="col-xl-3 col-lg-4">
	<div class="m-portlet m-portlet--full-height  ">
		<div class="m-portlet__body">
			<div class="m-card-profile">
				<div class="m-card-profile__title m--hide">
					Your Profile1
				</div>
				<div class="m-card-profile__pic">
					<div class="m-card-profile__pic-wrapper c-p" style="border: none !important;">
						@if(isset($profile))<img alt="" src="data:image/gif;base64, {{$profile->image}}" data-modal-route="/profile/change_image" class="profile_picture" />
						@else
							<i class="fa fa-user-circle-o fa-lg fa-3x" data-modal-route="/profile/change_image" style="font-size: 4.1rem; color: #000;"></i>
						@endif
					</div>
				</div>
				<div class="m-card-profile__details">
					<span class="m-card-profile__name">
						{{ $current_user->full_name }}
					</span>
					<a href="" class="m-card-profile__email m-link">
						{{ $current_user->email }}
					</a>
					<br>
					<br>
					<a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn m-btn--pill btn-danger m-btn m-btn--custom m-btn--label-brand m-btn--bolder c-p" title="Log Out" data-container="body" data-toggle="m-tooltip" data-placement="bottom" data-original-title="Tooltip title" style="color: #fff;">
                        <span class="m-nav__link-icon">
                            Logout
                        </span>
                    </a>
                    <form id="logout-form" action="/session/logout" method="post" style="display: none;">
                        {{csrf_field()}}
                    </form>
				</div>
			</div>
			<ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">
				<li class="m-nav__separator m-nav__separator--fit"></li>
				<li class="m-nav__section m--hide">
					<span class="m-nav__section-text">
						Section
					</span>
				</li>
				  @if(auth()->user()->role_id==1)
				<li class="m-nav__item">
					<a href="#" class="m-nav__link">
						<i class="m-nav__link-icon flaticon-profile-1"></i>
						<span class="m-nav__link-title">
							<span class="m-nav__link-wrap">
								<span class="m-nav__link-text">
									My Profile
								</span>
								<span class="m-nav__link-badge">
									<span class="m-badge m-badge--success">
										2
									</span>
								</span>
							</span>
						</span>
					</a>
				</li>
				@endif
			</ul>
		</div>
	</div>
</div>