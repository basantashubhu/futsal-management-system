<!--end::Body -->
<body class="
    @if(isset($userLayout) && array_key_exists('layout_type', $userLayout) && $userLayout['layout_type']->applied_value == 'fluid')
        m-page--fluid
    @elseif(isset($userLayout) && array_key_exists('layout_type', $userLayout) && $userLayout['layout_type']->applied_value == 'boxed')
        m-page--boxed
    @else
        m-page--fluid
    @endif

@if(isset($userLayout) && array_key_exists('global_page_background', $userLayout) && $userLayout['global_page_background']->applied_value != 'none')
{{ $userLayout['global_page_background']->applied_value }}
@endif
@if(isset($userLayout) && array_key_exists('page_background', $userLayout) && $userLayout['page_background']->applied_value == 'lightgray')
        m-content--skin-light2
    @elseif(isset($userLayout) && array_key_exists('page_background', $userLayout) && $userLayout['page_background']->applied_value == 'light')
        m-content--skin-light
    @else
        m-content--skin-light2
    @endif

@if(isset($userLayout) && $userLayout['desktop_fixed_header']->applied_value == 'on')
        m-header--fixed
    @else
        m-header--static
    @endif

@if(isset($userLayout) && $userLayout['desktop_header_minimize_mode']->applied_value == 'hide')
        m-header--show
    @elseif(isset($userLayout) && $userLayout['desktop_header_minimize_mode']->applied_value == 'none')
@else
        m-header--show
    @endif

@if(isset($userLayout) && $userLayout['mobile_fixed_header']->applied_value == 'on')
        m-header--fixed-mobile
    @endif

@if(isset($userLayout) && $userLayout['fixed_aside']->applied_value == 'on')
        m-aside-left--fixed
     @endif

@if(isset($userLayout) && $userLayout['allow_aside_minimizing']->applied_value == 'on')
        m-brand--minimize m-aside-left--minimize m-scroll-top--shown hideMenuText
     @endif

@if(isset($userLayout) && $userLayout['default_hidden_aside']->applied_value == 'on')
        m-aside-left--hide
     @else
        m-aside-left--enabled
    @endif

@if(isset($userLayout) && $userLayout['fixed_footer']->applied_value == 'on')
        m-footer--fixed
     @endif

        m--skin-  m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default no-pd-i">


<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <!-- BEGIN: Header -->
    <header class="m-grid__item m-header" m-minimize="hide" data-minimize-offset="200"
            data-minimize-mobile-offset="200">
        @if(isset($userLayout) && array_key_exists('layout_type', $userLayout) && $userLayout['layout_type']->applied_value == 'fluid')
            <div class="m-container m-container--fluid m-container--full-height">
                @elseif(isset($userLayout) && array_key_exists('layout_type', $userLayout) && $userLayout['layout_type']->applied_value == 'boxed')
                    <div class="m-container m-container--responsive m-container--xxl custom-response-header m-container--full-height">
                        @else
                            <div class="m-container m-container--fluid m-container--full-height">
                                @endif
                                <div class="m-stack m-stack--ver m-stack--desktop">
                                    <!-- BEGIN: Brand -->
                                    <div class="m-stack__item global_background_color @if(isset($userLayout) && array_key_exists('aside_skin', $userLayout) && $userLayout['aside_skin']->applied_value == 'dark')
                                            m-brand--skin-dark
                                                @else
                                            m-brand--skin-light
                                            @endif
                                            m-brand">
                                        <div class="m-stack m-stack--ver m-stack--general">
                                            <a href="#" class="m-brand__icon showAsideText
                            @if(isset($userLayout) && $userLayout['allow_aside_minimizing']->applied_value == 'on')
                                                    show
                                                    @endif
                                                    " title="Click here to expand menu">
                                                <i class="fa fa-list"></i>
                                            </a>

                                            <div class="m-stack__item @if(isset($userLayout) && array_key_exists('aside_skin', $userLayout) && $userLayout['aside_skin']->applied_value == 'dark')
                                                    m-brand--skin-dark
                                                @else
                                                    m-brand--skin-light
                                                    @endif
                                                    m-stack__item--middle m-stack__item--center m-brand__logo">
                                                <a href='#' data-route="profile" class="">
                                                    @if(isset($profile))<img alt=""
                                                                             src="data:image/gif;base64, {{$profile->image}}"
                                                                             class="custom_logo profile_picture"/>
                                                    @else
                                                        <i class="fa fa-user-circle-o headerAvatar"></i>
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="m-stack__item @if(isset($userLayout) && array_key_exists('aside_skin', $userLayout) && $userLayout['aside_skin']->applied_value == 'dark')
                                                    m-brand--skin-dark
                                                @else
                                                    m-brand--skin-light
                                                    @endif
                                                    m-stack__item--middle m-brand__tools">
                                                <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                                                <a href="javascript:;" id="m_aside_left_offcanvas_toggle"
                                                   class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                                                    <span></span>
                                                </a>
                                                <!-- END -->
                                                <!-- BEGIN: Responsive Header Menu Toggler -->
                                                <a id="m_aside_header_menu_mobile_toggle" href="javascript:;"
                                                   class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                                                    <span></span>
                                                </a>
                                                <!-- END -->
                                                <!-- BEGIN: Topbar Toggler -->
                                                <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;"
                                                   class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                                                    <i class="flaticon-more"></i>
                                                </a>
                                                <!-- BEGIN: Topbar Toggler -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END: Brand -->
                                    <div class="m-stack__item @if(isset($userLayout) && array_key_exists('aside_skin', $userLayout) && $userLayout['aside_skin']->applied_value == 'dark')
                                            m-brand--skin-dark
                                                @else
                                            m-brand--skin-light
                                            @endif
                                            m-stack__item--fluid m-header-head global_background_color"
                                         id="m_header_nav">
                                        <!-- BEGIN: Horizontal Menu -->
                                        <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark "
                                                id="m_aside_header_menu_mobile_close_btn">
                                            <i class="la la-close"></i>
                                        </button>
                                        <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light
                        m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark
                        @if(isset($userLayout) && $userLayout['dropdown_skin']->applied_value == 'dark') m-header-menu--submenu-skin-dark @endif">
                                            <ul class="m-menu__nav
                            @if(isset($userLayout) && $userLayout['display_submenu_arrow']->applied_value == 'on') m-menu__nav--submenu-arrow @endif">
                                                <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel header_logo"
                                                    data-menu-submenu-toggle="click" data-redirect="true"
                                                    aria-haspopup="true"
                                                    style="border-right: 1px solid #ddd; padding-right: 30px;">
                                                    <a href="#" class="m-menu__link m-menu__toggle">
                                    <span class="m-menu__link-text" style="width:150px;">
                                        <img class="img-fluid" src="{{ program($programWrapper::mergedOldProperties(), 'logo', 'images/logo.png') }}">
                                    </span>
                                                    </a>
                                                </li>
                                                @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2 || auth()->user()->role_id == 3 || auth()->user()->role_id == 4 || auth()->user()->role_id == 5 || auth()->user()->role_id == 7)
                                                    @foreach(Config('menu.top_nav') as $index => $value)
                                                        <?php
                                                            $accesses = config('menu.access');
                                                            $access = isset($accesses[$index]) ? $accesses[$index] : false;
                                                            if($access && !Auth::user()->checkPermission(...$access)) {
                                                                continue;
                                                            }
                                                        ?>
                                                        @if($index=='Menu' &&  auth()->user()->role->name == 'admin' )
                                                            @continue
                                                        @endif
                                                            <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel
                                    @if(isset($userLayout) && $userLayout['display_header_menu']->applied_value == 'off') hidden @endif"
                                                                data-menu-submenu-toggle="click" data-redirect="true"
                                                                aria-haspopup="true">
                                                                <a href="#" class="m-menu__link m-menu__toggle">
                                        <span class="m-menu__link-text">
                                            {{$index}}
                                        </span>
                                                                    <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                </a>
                                                                @php
                                                                    $dyWidth = ['s-d-l', 'n-s-l', 'b-d-a', 'lkh-d-a'];
                                                                    $widthLen = (count($value) > 4 ? 4 : count($value)) - 1;
                                                                @endphp
                                                                <div class="m-menu__submenu  m-menu__submenu--fixed m-menu__submenu--left {{ $dyWidth[$widthLen] }}"
                                                                     id="submenu-right"
                                                                     style=''>
                                                                    <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                                                    <div class="m-menu__subnav global_background_color">
                                                                        <ul class="m-menu__content">
                                                                            @foreach($value as $key => $val)
                                                                                @if(array_key_exists('access',$val))
                                                                                    @canAccess($val['access'][0],$val['access'][1])
                                                                                    <li class="m-menu__item">
                                                                                        <h3 class="m-menu__heading m-menu__toggle">
                                                                                        <span class="m-menu__link-text">
                                                                                            {{$val['label']}}
                                                                                        </span>
                                                                                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                                        </h3>
                                                                                        @if(array_key_exists('sub-menu', $val))
                                                                                            <ul class="m-menu__inner">
                                                                                                @foreach($val['sub-menu'] as $submenu)
                                                                                                    @if(isset($submenu['access']))
                                                                                                        @canAccess($submenu['access'][0],$submenu['access'][1])
                                                                                                        <li class="m-menu__item "
                                                                                                            data-redirect="true"
                                                                                                            aria-haspopup="true">
                                                                                                            <a data-route="{{$submenu['url']}}"
                                                                                                               class="m-menu__link ">
                                                                                                                <i class="{{$submenu['icon']}}"></i>
                                                                                                                <span class="m-menu__link-text">
                                                                   {{$submenu['name']}}
                                                                </span>
                                                                                                            </a>
                                                                                                        </li>
                                                                                                        @endcanAccess @else
                                                                                                        <li class="m-menu__item "
                                                                                                            data-redirect="true"
                                                                                                            aria-haspopup="true">
                                                                                                            <a data-route="{{$submenu['url']}}"
                                                                                                               class="m-menu__link ">
                                                                                                                <i class="{{$submenu['icon']}}"></i>
                                                                                                                <span class="m-menu__link-text">
                                                                       {{$submenu['name']}}
                                                                    </span>
                                                                                                            </a>
                                                                                                        </li>
                                                                                                    @endif @endforeach
                                                                                            </ul>
                                                                                        @endif
                                                                                    </li>
                                                                                    @endcanAccess @else
                                                                                    <li class="m-menu__item">
                                                                                        <h3 class="m-menu__heading m-menu__toggle">
                                                        <span class="m-menu__link-text">
                                                            {{$val['label']}}
                                                        </span>
                                                                                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                                        </h3> @if(array_key_exists('sub-menu', $val))
                                                                                            <ul class="m-menu__inner">
                                                                                                @foreach($val['sub-menu'] as $submenu) @if(isset($submenu['access'])) @canAccess($submenu['access'][0],$submenu['access'][1])
                                                                                                <li class="m-menu__item "
                                                                                                    data-redirect="true"
                                                                                                    aria-haspopup="true">
                                                                                                    <a data-route="{{$submenu['url']}}"
                                                                                                       class="m-menu__link ">
                                                                                                        <i class="{{$submenu['icon']}}"></i>
                                                                                                        <span class="m-menu__link-text">
                                                                   {{$submenu['name']}}
                                                                </span>
                                                                                                    </a>
                                                                                                </li>
                                                                                                @endcanAccess @endif @endforeach
                                                                                            </ul>
                                                                                        @endif
                                                                                    </li>
                                                                                @endif @endforeach
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </li>

                                                    @endforeach
                                                @endif
                                                @if(auth()->user()->role_id == 4 || auth()->user()->role_id==3 ||auth()->user()->role_id==7 )
                                                    @if(auth()->user()->organization())
                                                        <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel
                                @if(isset($userLayout) && $userLayout['display_header_menu']->applied_value == 'off') hidden @endif"
                                                            data-menu-submenu-toggle="click" data-redirect="true"
                                                            aria-haspopup="true" style=" padding-right: 100px;">
                                                            <a href="#" class="m-menu__link m-menu__toggle"
                                                               style="height: 0%;">
                                        <span class="m-menu__link-text">
                                            <strong>{{ucfirst(auth()->user()->organization()->cname)}}</strong>
                                        </span>
                                                            </a>
                                                            <a href="#" class="m-menu__link m-menu__toggle"
                                                               style="height: 0%;">
                                        <span class="m-menu__link-text" style="font-size: 12px; color: #676c7b;">
                                            {{ucfirst(auth()->user()->organization()->address->add1)}} @if(auth()->user()->organization()->address->add2)
                                                , {{ucfirst(auth()->user()->organization()->address->add2)}} @endif <br>
                                            {{ucfirst(auth()->user()->organization()->address->zip->city)}}
                                            - {{ucfirst(auth()->user()->organization()->address->zip->state)}}
                                            -{{ucfirst(auth()->user()->organization()->address->zip->zip_code)}}
                                        </span>
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endif
                                            </ul>
                                        </div>
                                        <!-- END: Horizontal Menu -->
                                        <!-- BEGIN: Topbar -->
                                        <div id="m_header_topbar"
                                             class="m-topbar  m-stack m-stack--ver m-stack--general">
                                            <div class="m-stack__item @if(isset($userLayout) && array_key_exists('aside_skin', $userLayout) && $userLayout['aside_skin']->applied_value == 'dark')
                                                    m-brand--skin-dark
                                                @else
                                                    m-brand--skin-light
                                                    @endif
                                                    m-topbar__nav-wrapper">
                                                <ul class="m-topbar__nav m-nav m-nav--inline">
                                                    <li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill nav-date-time m-dropdown--mobile-full-width noHideLogout logged_user"
                                                        data-dropdown-toggle="click" data-dropdown-persistent="true">
                                                        <p class="no-m c-p" data-route="profile"
                                                           title="Click here to go profile section">Logged in as <span
                                                                    style="color: #34BFA3;">{{ auth()->user()->member->fullname() }}</span></p>
                                                        <p class="no-m" id="navDateTime"></p>
                                                    </li>
                                                    <!-- Notification -->
                                                    <li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow
                                                m-dropdown--align-center m-dropdown--mobile-full-width noHideLogout"
                                                        data-dropdown-toggle="click" data-dropdown-persistent="true">
                                                        <a href="#" class="m-nav__link m-dropdown__toggle" id="">
                                                            <span class="m-nav__link-badge m-badge m-badge--accent"
                                                                  id="NotificationSpan" style="display: none;">
                                                            </span>
                                                                            <span class="m-nav__link-icon">
                                                                <i class="flaticon-alert-2"></i>
                                                            </span>
                                                        </a>
                                                        <div class="m-dropdown__wrapper">
                                                            <span class="m-dropdown__arrow header_arrow m-dropdown__arrow--center"
                                                                  style="color: #fff"></span>
                                                            <div class="m-dropdown__inner">
                                                                <div class="m-dropdown__body">
                                                                    <div class="m-dropdown__content">
                                                                        <ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand justify-content-between"
                                                                            role="tablist">
                                                                            <!-- @if(auth()->user()->role->id !==6)
                                                                                <li class="nav-item m-tabs__item">
                                                                                    <a class="nav-link m-tabs__link "
                                                                                       data-toggle="tab"
                                                                                       href="#topbar_notifications_notifications"
                                                                                       role="tab">
                                                                                        Reminders
                                                                                    </a>
                                                                                </li>
                                                                            @endif -->
                                                                                <li class="nav-item m-tabs__item" style="flex:1">
                                                                                    <a class="nav-link m-tabs__link active"
                                                                                       data-toggle="tab"
                                                                                       href="#topbar_notifications_events"
                                                                                       role="tab">
                                                                                        Notifications
                                                                                    </a>
                                                                                </li>
                                                                                <li class="nav-item m-tabs__item markAllAsRead">
                                                                                    <a class="nav-link m-tabs__link"
                                                                                       {{-- data-toggle="tab" --}}
                                                                                       href="javascript:;"
                                                                                       role="tab">
                                                                                        Mark All Read
                                                                                    </a>
                                                                                </li>
                                                                        </ul>
                                                                        <div class="tab-content">
                                                                            <div class="tab-pane "
                                                                                 id="topbar_notifications_notifications"
                                                                                 role="tabpanel">
                                                                                <div class="m-scrollable"
                                                                                     data-scrollable="true"
                                                                                     data-max-height="250"
                                                                                     data-mobile-max-height="200">
                                                                                    <div class="m-list-timeline m-list-timeline--skin-light">
                                                                                        <div class="m-list-timeline__items"
                                                                                             id="ReminderSection">
                                                                                            <div class="m-list-timeline__item">
                                                                                                <span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
                                                                                                <span class="m-list-timeline__text">
                                                                                        12 new users registered
                                                                                    </span>
                                                                                                <span class="m-list-timeline__time">
                                                                                        Just now
                                                                                    </span>
                                                                                            </div>
                                                                                            <div class="m-list-timeline__item">
                                                                                                <span class="m-list-timeline__badge"></span>
                                                                                                <span class="m-list-timeline__text">
                                                                                        System shutdown
                                                                                        <span class="m-badge m-badge--success m-badge--wide">
                                                                                            pending
                                                                                        </span>
                                                                                </span>
                                                                                                <span class="m-list-timeline__time">
                                                                                        14 mins
                                                                                    </span>
                                                                                            </div>
                                                                                            <div class="m-list-timeline__item">
                                                                                                <span class="m-list-timeline__badge"></span>
                                                                                                <span class="m-list-timeline__text">
                                                                                        New invoice received
                                                                                    </span>
                                                                                                <span class="m-list-timeline__time">
                                                                                        20 mins
                                                                                    </span>
                                                                                            </div>
                                                                                            <div class="m-list-timeline__item">
                                                                                                <span class="m-list-timeline__badge"></span>
                                                                                                <span class="m-list-timeline__text">
                                                                                        DB overloaded 80%
                                                                                        <span class="m-badge m-badge--info m-badge--wide">
                                                                                            settled
                                                                                        </span>
                                                                                </span>
                                                                                                <span class="m-list-timeline__time">
                                                                                        1 hr
                                                                                    </span>
                                                                                            </div>
                                                                                            <div class="m-list-timeline__item">
                                                                                                <span class="m-list-timeline__badge"></span>
                                                                                                <span class="m-list-timeline__text">
                                                                                        System error -
                                                                                        <a href="#" class="m-link">
                                                                                            Check
                                                                                        </a>
                                                                                    </span>
                                                                                                <span class="m-list-timeline__time">
                                                                                        2 hrs
                                                                                    </span>
                                                                                            </div>
                                                                                            <div class="m-list-timeline__item m-list-timeline__item--read">
                                                                                                <span class="m-list-timeline__badge"></span>
                                                                                                <span href=""
                                                                                                      class="m-list-timeline__text">
                                                                                        New order received
                                                                                        <span class="m-badge m-badge--danger m-badge--wide">
                                                                                            urgent
                                                                                        </span>
                                                                                </span>
                                                                                                <span class="m-list-timeline__time">
                                                                                        7 hrs
                                                                                    </span>
                                                                                            </div>
                                                                                            <div class="m-list-timeline__item m-list-timeline__item--read">
                                                                                                <span class="m-list-timeline__badge"></span>
                                                                                                <span class="m-list-timeline__text">
                                                                                        Production server down
                                                                                    </span>
                                                                                                <span class="m-list-timeline__time">
                                                                                        3 hrs
                                                                                    </span>
                                                                                            </div>
                                                                                            <div class="m-list-timeline__item">
                                                                                                <span class="m-list-timeline__badge"></span>
                                                                                                <span class="m-list-timeline__text">
                                                                                        Production server up
                                                                                    </span>
                                                                                                <span class="m-list-timeline__time">
                                                                                        5 hrs
                                                                                    </span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="tab-pane active"
                                                                                 id="topbar_notifications_events"
                                                                                 role="tabpanel">
                                                                                <div class="m-scrollable"
                                                                                     m-scrollabledata-scrollable="true"
                                                                                     data-max-height="250"
                                                                                     data-mobile-max-height="200">
                                                                                    <div class="m-list-timeline m-list-timeline--skin-light">
                                                                                        <div class="m-list-timeline__items"
                                                                                             id="CustomNotification_events"
                                                                                             style="height: 250px; overflow-y: scroll">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <!--
                                                    <li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow
                                                m-dropdown--align-center m-dropdown--mobile-full-width noHideLogout">
                                                        <a href="#" data-route="emailSection" class="m-nav__link m-dropdown__toggle" id="">
                                                            <span class="m-nav__link-badge m-badge m-badge--accent"
                                                                  id="NotificationSpan" style="display: none;">
                                                            </span>
                                                                            <span class="m-nav__link-icon">
                                                                <i class="  flaticon-symbol"></i>
                                                            </span>
                                                        </a>
                                                    </li>
                                                -->
                                                    <li class="m-nav__item m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width
                                        m-dropdown--skin-light  m-list-search m-list-search--skin-light noHideLogout"
                                                        data-dropdown-toggle="click" data-dropdown-persistent="true"
                                                        id="m_quicksearch" data-search-type="dropdown">
                                                        <a onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                                           class="m-nav__link m-dropdown__toggle c-p" title="Log Out">
                                        <span class="m-nav__link-icon">
                                            <i class="m-menu__link-icon flaticon-logout"></i>
                                        </span>
                                                        </a>
                                                        <form id="logout-form" action="/session/logout" method="post"
                                                              style="display: none;">
                                                            {{csrf_field()}}
                                                        </form>
                                                    </li>
                                                    <!-- Quick Sidebat -->
                                                <!-- @if(auth()->user()->role_id != 4)
                                                    <li id="m_quick_sidebar_toggle1" class="m-nav__item">
                                                            <a href="#" class="m-nav__link m-dropdown__toggle">
                                                            <span class="m-nav__link-icon">
                                                                <i class="flaticon-menu-button"></i>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    @endif -->
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- END: Topbar -->
                                    </div>
                                </div>
                            </div>
    </header>
    <!-- END: Header -->

