<!-- begin::Quick Sidebar -->
<div id="m_quick_sidebar" class="m-quick-sidebar m-quick-sidebar--tabbed m-quick-sidebar--skin-light">
    <div class="m-quick-sidebar__content m--hide">
				<span id="m_quick_sidebar_close" class="m-quick-sidebar__close">
					<i class="la la-close"></i>
				</span>
        <ul id="m_quick_sidebar_tabs" class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_quick_sidebar_tabs_messenger"
                   role="tab">
                    To Do
                </a>
            </li>
            {{-- <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_quick_sidebar_tabs_settings" role="tab">
                    Settings
                </a>
            </li>
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_quick_sidebar_tabs_mail_settings" role="tab">
                    Email Settings
                </a>
            </li> --}}
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_quick_sidebar_tabs_layout_settings" role="tab">
                    Layouts
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active m-scrollable" id="m_quick_sidebar_tabs_messenger" role="tabpanel">
                @include('default.layouts.partials.todo')
            </div>
            <div class="tab-pane  m-scrollable" id="m_quick_sidebar_tabs_settings" role="tabpanel">
                @include('default.layouts.partials.settings')
            </div>
            <div class="tab-pane  m-scrollable" id="m_quick_sidebar_tabs_mail_settings" role="tabpanel">
                @include('default.layouts.partials.mailsettings')
            </div>
            <div class="tab-pane  m-scrollable" id="m_quick_sidebar_tabs_layout_settings" role="tabpanel">
                @include('default.layouts.partials.layout')
            </div>
        </div>
    </div>
</div>
<!-- end::Quick Sidebar -->
<!-- begin::Scroll Top -->
<div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500"
     data-scroll-speed="300">
    <i class="la la-arrow-up"></i>
</div>
<!-- end::Scroll Top -->
<!-- begin::Quick Nav -->
    <ul class="m-nav-sticky" style="margin-top: 30px;">

    @canAccess('Support', 'view')

        <li class="m-nav-sticky__item" data-toggle="m-tooltip" title="Support" data-placement="left">
            <a href="#" rel="developerConsole">
                <i class="la la-code-fork"></i>
            </a>
        </li>
        
    @endcanAccess


        <li class="m-nav-sticky__item" id="m_quick_sidebar_toggle" data-toggle="m-tooltip" title="Settings" data-placement="left">
            <a href="#">
                <i class="la la-cog"></i>
            </a>
        </li>
        <div id="dashboardItems">
        </div>
    </ul>
