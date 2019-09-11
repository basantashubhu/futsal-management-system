<div class="m-section m-section--last">
    <div class="m-section__content">
        <!--begin::Preview-->
        <div class="m-role" data-code-preview="true" data-code-html="true" data-code-js="false">
            <div class="m-role__preview std-divider">
                <ul class="m-nav" id="roleManagementMenu">
                    <li class="m-nav__item m-nav__item--active">
                        <a data-event-route="pages" class="m-nav__link c-p">
                            <i class="m-nav__link-icon flaticon-suitcase"></i>
                            <span class="m-nav__link-text">
                                Page
                            </span>
                        </a>
                    </li>
                    <li class="m-nav__item">
                        <a data-event-route='role' class="m-nav__link c-p">
                            <i class="m-nav__link-icon flaticon-lock"></i>
                            <span class="m-nav__link-title">
                                <span class="m-nav__link-wrap">
                                    <span class="m-nav__link-text">
                                        Role
                                    </span>
                                </span>
                            </span>
                        </a>
                    </li>
                    <li class="m-nav__item">
                        <a data-event-route='permission' class="m-nav__link c-p">
                            <i class="m-nav__link-icon flaticon-interface-7"></i>
                            <span class="m-nav__link-text">
                                Permission
                            </span>
                        </a>
                    </li>
                    <li class="m-nav__item">
                        <a data-event-route='rolePermission' class="m-nav__link c-p">
                            <i class="m-nav__link-icon flaticon-user-ok"></i>
                            <span class="m-nav__link-title">
                                <span class="m-nav__link-wrap">
                                    <span class="m-nav__link-text">
                                        Role Permission
                                    </span>
                                </span>
                            </span>
                        </a>
                    </li>

                    <li class="m-nav__item">
                        <a data-event-route="userPermission" class="m-nav__link c-p">
                            <i class="m-nav__link-icon flaticon-user-settings"></i>
                            <span class="m-nav__link-text">
                                User Permission
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!--end::Preview-->
    </div>
</div>

<script>
    
    $(function ( items ) {
      
        items.off('click').on('click', function (e) {

            e.preventDefault();

            const itemIndex = items.index(this);

            localStorage.setItem('roleManagementMenu', itemIndex);

            loadCurrentItem(this.querySelector('a'));

            activeCurrentItem(items, itemIndex)

        });

        const itemIndex = localStorage.getItem('roleManagementMenu') || 0;

        activeCurrentItem(items, itemIndex);
        
        let eventRoute = items.eq(itemIndex).find('a:first').attr('data-event-route');

        if('#' + eventRoute !== location.hash) {
            loadCurrentItem({
                dataset: { eventRoute }
            });
        }

    }( $('#roleManagementMenu .m-nav__item') ));

    function activeCurrentItem(items, itemIndex) {

        items.removeClass('m-nav__item--active');

        items.eq(itemIndex).addClass('m-nav__item--active');

    }

    function loadCurrentItem({dataset}) {

        if (!dataset || !dataset.eventRoute) return;

        sendAjax(dataset.eventRoute, resp => {

            $('#role_permission_container').html(resp);

            location.hash = dataset.eventRoute;

        });
    }
</script>