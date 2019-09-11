<div class="m-subheader">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title ucfirst">
				{{ucfirst($client->fullname())}}
			</h3>
			<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__separator">
                    -
                </li>
                <li class="m-nav__item m-nav__item--home">
                    <a href="javascript:void(0)" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__separator">
                    -
                </li>
                <li class="m-nav__item">
                    <a href="javascript:void(0)" data-route="user" class="m-nav__link">
                        <span class="m-nav__link-text">
                            User Controls
                        </span>
                    </a>
                </li>
                <li class="m-nav__separator">
                    -
                </li>
                <li class="m-nav__item">
                    <a href="javascript:void(0)" data-route="userProfile/{{ $client->user_id }}" class="m-nav__link">
                        <span class="m-nav__link-text">
                            {{ $client->fullname() }}
                        </span>
                    </a>
                </li>
            </ul>
		</div>
		<div class="applicationQuickActions">
			<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" title="Back">
				<a class="m-portlet__nav-link btn btn-sm redirect-back btn-secondary c-p  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
					<i class="la la-plus m--hide"></i>
					<i class="la la-arrow-left"></i>
				</a>
			</div>
		</div>
	</div>
</div>