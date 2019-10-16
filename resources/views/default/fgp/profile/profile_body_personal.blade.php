<div class="col-xl-3 col-lg-4">
	<div class="m-portlet m-portlet--full-height  ">
		<div class="m-portlet__body">
			<div class="m-card-profile">
				<div class="m-card-profile__title m--hide">
					Your Profile
				</div>
				<div class="m-card-profile__pic">
					<div class="m-card-profile__pic-wrapper c-p" style="border: none !important;">
						@if(isset($profile))<img alt="" src="data:image/gif;base64, {{$profile->image}}" data-modal-route="/profile/change_image/user/{{$client->id}}" class="profile_picture" />
						@else
							<i class="fa fa-user-circle-o fa-lg fa-3x" data-modal-route="/profile/change_image/user/{{$client->id}}" style="font-size: 4.1rem; color: #000;"></i>
						@endif
					</div>
				</div>
				<div class="m-card-profile__details">
					<span class="m-card-profile__name">
						{{ ucfirst($client->first_name) }} {{ ucfirst($client->last_name) }}
					</span>
					<a href="javascript:void(0)" class="m-card-profile__email m-link">
						{{ $user->email }}
					</a>
					<br>
					@if($contact && $contact->cell_phone)
						<a href="javascript:;"><i class="fa fa-phone"></i>&nbsp; {{ format_cell($contact->cell_phone) }}</a>
						<br>
					@endif
				</div>
			</div>
			<ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">
				<li class="m-nav__separator m-nav__separator--fit"></li>
				<li class="m-nav__section m--hide">
					<span class="m-nav__section-text">
						Section
					</span>
				</li>
			</ul>
			@if(isset($address))
			<div>
				<h5 class="card-title">Address</h5>
				<p class="card-text">
					{{$address->add1}}
					{{$address->state}} {{$address->region}} {{$address->county}} - {{$address->city}}
				</p>
			</div>
			@endif
		</div>
	</div>
</div>