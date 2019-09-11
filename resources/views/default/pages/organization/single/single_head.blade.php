<div class="m-subheader">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                {{$organization->cname}}
            </h3>
			<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="#" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__separator">
                    -
                </li>
                <li class="m-nav__item">
                    <a href="#" data-route="organization" class="m-nav__link">
                        <span class="m-nav__link-text">
                            {{$organization->type}}
                        </span>
                    </a>
                </li>
                <li class="m-nav__separator">
                    -
                </li>
                <li class="m-nav__item">
                    <a data-route="org/single/{{$organization->id}}" class="m-nav__link">
                        <span class="m-nav__link-text">
                            {{$organization->cname}}
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        @include('default.pages.organization.single.quick_action')
    </div>
</div>