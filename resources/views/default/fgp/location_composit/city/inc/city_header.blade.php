<div class="m-subheader">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                City
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
                    <a href="" class="m-nav__link">
                        <span class="m-nav__link-text">
                            Tables
                        </span>
                    </a>
                </li>
                <li class="m-nav__separator">
                    -
                </li>
                <li class="m-nav__item">
                    <a data-route="location/city" class="m-nav__link c-p">
                        <span class="m-nav__link-text">
                            Cities
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="btn btn-info m-btn btn-sm m-btn--custom m-btn--icon m-btn--pill" data-modal-route="/location/city/add" data-backdrop="static" data-keyboard="false">
            <span>
                <i class="la la-plus"></i>
                <span>
                   New City
                </span>
            </span>
        </button>
        <!-- @include('default.pages.email_template.includes.quick_action') -->
    </div>
</div>
