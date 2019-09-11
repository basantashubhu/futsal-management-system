<div class="m-subheader">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Locations
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
                    <a data-route="view/location" class="m-nav__link c-p">
                        <span class="m-nav__link-text">
                            Locations
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        {{-- <button class="btn btn-info m-btn btn-sm m-btn--custom m-btn--icon m-btn--pill" data-modal-route="/addVolunteer" data-backdrop="static" data-keyboard="false">
            <span>
                <i class="la la-plus"></i>
                <span>
                    Location
                </span>
            </span>
        </button> --}}
        <div>
            <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="click" aria-expanded="true">
                <a href="#" class="m-portlet__nav-link btn btn-lg m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle bg-blue text-white">
                    <i class="la la-plus m--hide"></i>
                    <i class="la la-plus"></i>
                </a>
                <div class="m-dropdown__wrapper">
                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                    <div class="m-dropdown__inner">
                        <div class="m-dropdown__body">
                            <div class="m-dropdown__content">
                                <ul class="m-nav">
                                    <li class="m-nav__section m-nav__section--first m--hide">
                                    <span class="m-nav__section-text">
                                        Quick Actions
                                    </span>
                                    </li>
                                    <li class="m-nav__item m-b-10">
                                        <button href="#" class="c-p btn btn-info m-btn m-btn--custom m-btn--icon m-btn--pill btn-sm full-width-i" data-modal-route="location/add">
                                            <span>
                                                <i class="la la-plus"></i>
                                                <span>
                                                    Add Location
                                                </span>
                                            </span>
                                        </button>
                                    </li>
                                    <!-- <li class="m-nav__item m-b-10">
                                        <button href="#" class="c-p btn btn-info m-btn m-btn--custom m-btn--icon m-btn--pill btn-sm full-width-i" data-route="location/upload">
                                            <span>
                                                <i class="la la-plus"></i>
                                                <span>
                                                    Upload CSV
                                                </span>
                                            </span>
                                        </button>
                                    </li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
