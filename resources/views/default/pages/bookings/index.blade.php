<!-- BEGIN: Subheader -->
<div class="m-subheader">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Bookings
            </h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="javascript:;" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__separator">
                    -
                </li>
                <li class="m-nav__item">
                    <a href="#" data-route="bookings" class="m-nav__link">
                        <span class="m-nav__link-text">
                            Bookings
                        </span>
                    </a>
                </li>
            </ul>
        </div>

        <button type="button" class="btn m-btn btn-primary m-btn--pill"
            data-modal-route="bookings/new" data-modal-callback="reloadCourts">
            <i class="la la-plus"></i> Book New
        </button>
    </div>
</div>
<!-- END: Subheader -->


<div class="m-content">
    <div class="m_calendar_time_Changable" id="m_portlet" style="background-color: #f2f3f8">
        <div class="m-portlet__body">
            <div class="ts-tab-holder m-portlet m-portlet--mobile with-border"
                style="padding-bottom: 30px; padding: 20px">
            </div>
        </div>
    </div>
</div>