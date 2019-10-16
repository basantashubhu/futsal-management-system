 <!-- begin::Body -->
 <style type="text/css">
 	.my-scrollabar::-webkit-scrollbar-track
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        background-color: #fff;
    }

    .my-scrollabar::-webkit-scrollbar
    {
        width: 4px;
        background-color: #F5F5F5;
    }

    .my-scrollabar::-webkit-scrollbar-thumb
    {
        background-color: #113a5d;
    }
    .scrollbar-custom-new
    {
        height: 920px;
        background: #113a5d;
        overflow-y: auto;
    }

 </style>
		<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
			<!-- BEGIN: Left Aside -->
			<button class="m-aside-left-close m-aside-left-close--skin-dark" id="m_aside_left_close_btn">
				<i class="la la-close"></i>
			</button>
			<div id="m_aside_left" class="m-grid__item	m-aside-left global_background_color
			@if(isset($userLayout) && array_key_exists('aside_skin', $userLayout) && $userLayout['aside_skin']->applied_value == 'dark')
			m-aside-left--skin-dark
			@else
			m-aside-left--skin-light
			@endif">
				<!-- BEGIN: Aside Menu -->
				<div id="m_ver_menu"
					class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark m-aside-menu--dropdown my-scrollabar scrollbar-custom-new">
						<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow">
							<li class="m-menu__item  m-menu__item--submenu m-menu__item--open m-menu__item--expanded" aria-haspopup="true"  data-menu-submenu-toggle="hover" title="Dashboard">
								<a data-route='dashboard' class="m-menu__link ">
									<span class="m-menu__item-here"></span>
									<i class="m-menu__link-icon flaticon-line-graph"></i>
									<span class="m-menu__link-text">
										Dashboard
									</span>
								</a>
							</li>
								
							<li class="m-menu__item  m-menu__item--submenu m-menu__item--open" aria-haspopup="true" 
							 data-menu-submenu-toggle="hover" title="Courts">
								<a  href="#" data-route="courts" class="m-menu__link m-menu__toggle">
									<span class="m-menu__item-here"></span>
									<i class="m-menu__link-icon flaticon-location"></i>
									<span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
												Courts
											</span>
										</span>
									</span>
									<i class="m-menu__ver-arrow la la-angle-right"></i>
								</a>
							</li>

							<li class="m-menu__item  m-menu__item--submenu m-menu__item--open" aria-haspopup="true"  
							data-menu-submenu-toggle="hover" title="Organizations">
								<a  href="#" data-route="organizations" class="m-menu__link m-menu__toggle">
									<span class="m-menu__item-here"></span>
									<i class="m-menu__link-icon flaticon-suitcase"></i>
									<span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
												Organizations
											</span>
										</span>
									</span>
									<i class="m-menu__ver-arrow la la-angle-right"></i>
								</a>
							</li>
							
							<li class="m-menu__item  m-menu__item--submenu m-menu__item--open" aria-haspopup="true"  data-menu-submenu-toggle="hover" title="Calendar">
								<a  href="#" data-route="calendarSchedules" class="m-menu__link m-menu__toggle">
									<span class="m-menu__item-here"></span>
									<i class="m-menu__link-icon flaticon-calendar"></i>
									<span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
												Calendar
											</span>
										</span>
									</span>
									<i class="m-menu__ver-arrow la la-angle-right"></i>
								</a>
							</li>
						

							<li class="m-menu__item  m-menu__item--submenu m-menu__item--open" aria-haspopup="true"  data-menu-submenu-toggle="hover" title="Notes">
								<a  href="#" data-route="note" class="m-menu__link m-menu__toggle">
									<span class="m-menu__item-here"></span>
									<i class="m-menu__link-icon flaticon-interface-2"></i>
									<span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
												Notes
											</span>
										</span>
									</span>
									<i class="m-menu__ver-arrow la la-angle-right"></i>
								</a>
							</li>
							<li class="m-menu__item  m-menu__item--submenu m-menu__item--open" aria-haspopup="true"  data-menu-submenu-toggle="hover">
								<a  href="#" data-route="support" class="m-menu__link m-menu__toggle">
									<span class="m-menu__item-here"></span>
									<i class="m-menu__link-icon la la-bug"></i>
									<span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
												Support
											</span>
										</span>
									</span>
									<i class="m-menu__ver-arrow la la-angle-right"></i>
								</a>
							</li>
						</ul>

				</div>
			</div>

<!-- Main Content Holder -->
<div class="m-grid__item m-grid__item--fluid m-wrapper global_background_color"  id="contentHolder">


