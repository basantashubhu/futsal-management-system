<div class="m-subheader">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title dashboard-title-color m-subheader__title--separator" data-route='dashboard'>
                Dashboard
            </h3>
        </div>
        @if(auth()->user()->role->name =='superAdmin' || auth()->user()->role->name =='admin')
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
                                        @if(siteSettingsValue('application_citizen_add_mode') == "Modal")
                                        <button href="#" class="openModal btn btn-info m-btn m-btn--custom m-btn--icon m-btn--pill btn-sm full-width-i"  data-modal-id="applicationCreateModal" data-callback="loadCitizanModalJs">
                                            <span>
                                                <i class="la la-plus"></i>
                                                <span>
                                                    Add Citizen Application
                                                </span>
                                            </span>
                                        </button>
                                        @else
                                        <button href="#" class="c-p btn btn-info m-btn m-btn--custom m-btn--icon m-btn--pill btn-sm full-width-i" data-route="applicationAddCitizen">
                                            <span>
                                                <i class="la la-plus"></i>
                                                <span>
                                                    Add Citizen Application
                                                </span>
                                            </span>
                                        </button>
                                        @endif
                                    </li>
                                    <li class="m-nav__item m-b-10">
                                        @if(siteSettingsValue('application_np_add_mode') == "Modal")
                                        <button href="#" class="openModal btn btn-info m-btn m-btn--custom m-btn--icon m-btn--pill btn-sm full-width-i" data-modal-id="applicationNpCreateModal" data-callback="loadNpModalJs">
                                            <span>
                                                <i class="la la-plus"></i>
                                                <span>
                                                    Add Non Profit Application
                                                </span>
                                            </span>
                                        </button>
                                        @else
                                        <button href="#" class="c-p btn btn-info m-btn m-btn--custom m-btn--icon m-btn--pill btn-sm" data-route="applicationAddNP full-width-i">
                                            <span>
                                                <i class="la la-plus"></i>
                                                <span>
                                                    Add Non Profit Application
                                                </span>
                                            </span>
                                        </button>
                                        @endif
                                    </li>
                                    <li class="m-nav__item">
                                        <button href="#" data-modal-route="addNp?type=SP" class="btn btn-info m-btn m-btn--custom m-btn--icon m-btn--pill btn-sm full-width-i provider-modal-color">
                                            <span>
                                                <i class="la la-plus"></i>
                                                <span>
                                                    Add Service Provider
                                                </span>
                                            </span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>