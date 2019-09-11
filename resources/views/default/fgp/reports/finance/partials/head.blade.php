<div class="m-subheader">
        <div class="d-flex align-items-center">
            <div class="mr-auto" id="appHead">
                <h3 class="m-subheader__title float-left application-title-color">
                    Fiscal
                </h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="javascript:void(0)" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a data-route="fgp_reports/finance/{{ $view }}" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Reports
                            </span>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a data-route="fgp_reports/finance/{{ $view }}" class="m-nav__link">
                            <span class="m-nav__link-text">
                                <?php $label = explode('_', $view)[0]; ?>
                                {{ $label == 'period' ? ucwords("stipend $label") : ucwords($label) }}
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            
        </div>
    </div>
    