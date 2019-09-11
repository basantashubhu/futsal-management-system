<div class="m-content">
    <div class="m-portlet m-portlet--tabs">
		<div class="m-portlet__head">
			<div class="m-portlet__head-tools">
				<ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
					<li class="nav-item m-tabs__item">
						<a class="nav-link m-tabs__link active" data-toggle="tab" href="#builder_default_setting" role="tab">
							Settings
						</a>
					</li>
					<li class="nav-item m-tabs__item">
						<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_builder_page" role="tab">
							Page
						</a>
					</li>
					<li class="nav-item m-tabs__item">
						<a class="nav-link m-tabs__link " data-toggle="tab" href="#m_builder_header" role="tab">
							Header
						</a>
					</li>
					<li class="nav-item m-tabs__item">
						<a class="nav-link m-tabs__link " data-toggle="tab" href="#m_builder_left_aside" role="tab">
							Left Aside
						</a>
					</li>
					<li class="nav-item m-tabs__item">
						<a class="nav-link m-tabs__link " data-toggle="tab" href="#m_builder_footer" role="tab">
							Footer
						</a>
					</li>
				</ul>
			</div>
		</div>
		<!--begin::Form-->
		<form class="m-form m-form--label-align-right m-form--fit" id="layout_builder_form" action="{{ route('updateLayoutBuilder',['user_id'=> auth()->id()]) }}" method="POST">
			<div class="m-portlet__body">
				<div class="tab-content">
					<!-- Default Setting -->
					<div class="tab-pane  active" id="builder_default_setting">
						<div class="row">
							<div class="offset-lg-4 col-lg-4 col-sm-12 col-md-4"><h5 class="m--font-info">Background Color</h5></div>
						</div>

						<!-- GLobal Background Color -->
						<div class="form-group m-form__group row">
							<label class="col-lg-4 col-form-label">Background Color: </label>
							<div class="col-lg-8 col-xl-4">
								<select class="form-control" name="global_page_background">
									<option value="none" @if($userLayout['global_page_background']->applied_value == "none") selected @endif>Select</option>
									<option value="lightyellow" @if($userLayout['global_page_background']->applied_value == "lightyellow") selected @endif>Light Yellow</option>
									<option value="darkblue" @if($userLayout['global_page_background']->applied_value == "darkblue") selected @endif>Dark Blue</option>
									<option value="lightgray" @if($userLayout['global_page_background']->applied_value == "lightgray") selected @endif>Light Gray</option>
									<option value="classic" @if($userLayout['global_page_background']->applied_value == "classic") selected @endif>Classic View</option>
									<option value="pinky" @if($userLayout['global_page_background']->applied_value == "pinky") selected @endif>Pinky View</option>
								</select>
							</div>
						</div>
						<!-- GLobal Background Color:END -->

						<div class="form-group m-form__group row">
							<label class="col-lg-4 col-form-label">Aside Skin:</label>
							<div class="col-lg-8 col-xl-4">
								<select class="form-control" name="aside_skin">
									<option value="dark" @if($userLayout['aside_skin']->applied_value == "dark") selected="" @endif>Dark</option>
									<option value="light" @if($userLayout['aside_skin']->applied_value == "light") selected="" @endif>Light</option>
								</select>
								<div class="m-form__help">Set left aside skin</div>
							</div>
						</div>
						<div class="m-form__group form-group row">
							<label class="col-lg-4 col-form-label">Page Background:</label>
							<div class="col-lg-8 col-xl-4">
								<div class="input-group">
									<select class="form-control" name="page_background">
										<option value="light" @if($userLayout['page_background']->applied_value == "light") selected="" @endif>White</option>
										<option value="lightgray" @if($userLayout['page_background']->applied_value == "lightgray") selected="" @endif>Light Grey</option>
									</select>
								</div>
							</div>
						</div>
						<div class="m-form__group form-group row">
							<label class="col-lg-4 col-form-label">Dropdown Skin(Desktop):</label>
							<div class="col-lg-8 col-xl-4">
								<select class="form-control" name="dropdown_skin">
									<option value="Light" @if(strtolower($userLayout['dropdown_skin']->applied_value) == "light") selected="" @endif>Light</option>
									<option value="dark" @if($userLayout['dropdown_skin']->applied_value == "dark") selected="" @endif>Dark</option>
								</select>
								<span class="m-form__help">Please select header menu dropdown skin</span>
							</div>
						</div>

						<!-- Menus -->
						<div class="row m-t-40">
							<div class="offset-lg-4 col-lg-4 col-sm-12 col-md-4"><h5 class="m--font-info">Menus</h5></div>
						</div>
						<div class="form-group m-form__group row">
							<label class="col-lg-4 col-form-label">Allow Aside Minimizing:</label>
							<div class="col-lg-8 col-xl-4">
								<span class="m-switch m-switch--icon-check">
									<label>
										<input type="checkbox" name="allow_aside_minimizing" @if($userLayout['allow_aside_minimizing']->applied_value == "on") checked="" @endif value="on">
								        <span></span>
								    </label>
								</span>
								<div class="m-form__help">Allow aside minimizing</div>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<label class="col-lg-4 col-form-label">Default Hidden Aside:</label>
							<div class="col-lg-8 col-xl-4">
								<span class="m-switch m-switch--icon-check">
								    <label>
										<input type="checkbox" name="default_hidden_aside" @if($userLayout['default_hidden_aside']->applied_value == "on") checked="" @endif value="on">
								        <span></span>
								    </label>
								</span>
								<div class="m-form__help">Set aside hidden by default</div>
							</div>
						</div>

						<!-- Menu END -->

						<!-- Modal -->
						<!-- <div class="row m-t-40">
							<div class="offset-md-4 col-md-4"><h5>Modal</h5></div>
						</div>
						<div class="m-form__group form-group row">
							<label class="col-lg-4 col-form-label">Modal Content Options</label>
							<div class="col-lg-8 col-xl-4">
								<select class="form-control" name="dropdown_skin">
									<option value="page">Page</option>
									<option value="dialog">Dialog</option>
								</select>
								<span class="m-form__help">Please select header menu dropdown skin</span>
							</div>
						</div> -->
						<!-- Modal:END -->

					</div>
					<!-- Default Setting:END -->

					<div class="tab-pane" id="m_builder_page">
						<div class="form-group m-form__group row">
							<label class="col-lg-4 col-form-label">Layout Type:</label>
							<div class="col-lg-8 col-xl-4">
								@if(isset($userLayout['layout_type']))
									<select class="form-control" name="layout_type">
										<option value="fluid" @if($userLayout['layout_type']->applied_value == "fluid") selected="" @endif>Fluid</option>
										<option value="boxed" @if($userLayout['layout_type']->applied_value == "boxed") selected="" @endif>Boxed</option>
									</select>
								@endif
								<span class="m-form__help">Select page layout type</span>
							</div>
						</div>
						<!-- <div class="m-form__group form-group row">
							<label class="col-lg-4 col-form-label">Page Background:</label>
							<div class="col-lg-8 col-xl-4">
								<div class="input-group">
									<select class="form-control" name="page_background">
										<option value="light" @if($userLayout['page_background']->applied_value == "light") selected="" @endif>White</option>
										<option value="lightgray" @if($userLayout['page_background']->applied_value == "lightgray") selected="" @endif>Light Grey</option>
									</select>
								</div>
							</div>
						</div> -->

						<!-- <div class="m-form__group form-group row">
							<label class="col-lg-4 col-form-label">Global Background Color :</label>
							<div class="col-lg-8 col-xl-4">
								<div class="input-group">
									<select class="form-control" name="global_color_background">
										<option value="light" @if($userLayout['page_background']->applied_value == "light") selected="" @endif>White</option>
										<option value="lightgray" @if($userLayout['page_background']->applied_value == "lightgray") selected="" @endif>Light Grey</option>
									</select>
									<div class="input-group-append">
										<input type="text" class="chooseColor">
									</div>
								</div>
							</div>
						</div> -->
					</div>
					<div class="tab-pane " id="m_builder_header">
						<div class="form-group m-form__group row">
							<label class="col-lg-4 col-form-label">Desktop Fixed Header:</label>
							<div class="col-lg-8 col-xl-4">
								<span class="m-switch m-switch--icon-check">
									<label>
								        <input type="checkbox" name="desktop_fixed_header" @if($userLayout['desktop_fixed_header']->applied_value == "on") checked="" @endif value="on">
								        <span></span>
								    </label>
								</span>
								<div class="m-form__help">Enable fixed header for desktop mode</div>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<label class="col-lg-4 col-form-label">Desktop Header Minimize Mode:</label>
							<div class="col-lg-8 col-xl-4">
								<select class="form-control" name="desktop_header_minimize_mode">
									<option value="none"  @if($userLayout['desktop_header_minimize_mode']->applied_value == "none") selected="" @endif>None</option>
									<option value="hide" @if($userLayout['desktop_header_minimize_mode']->applied_value == "hide") selected="" @endif>Hide</option>
								</select>
								<div class="m-form__help">Set fixed header minimize mode on scroll for desktop mode</div>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<label class="col-lg-4 col-form-label">Mobile Fixed Header:</label>
							<div class="col-lg-8 col-xl-4">
								<span class="m-switch m-switch--icon-check">
									<label>
										<input type="checkbox" name="mobile_fixed_header" @if($userLayout['mobile_fixed_header']->applied_value == "on") checked="" @endif value="on">
								        <span></span>
								    </label>
								</span>
								<div class="m-form__help">Enable fixed header for mobile mode</div>
							</div>
						</div>


						<div class="m-separator m-separator--dashed"></div>

						<div class="form-group m-form__group row">
							<label class="col-lg-4 col-form-label">Display Header Menu:</label>
							<div class="col-lg-8 col-xl-4">
								<span class="m-switch m-switch--icon-check">
									<label>
										<input type="checkbox" name="display_header_menu" @if($userLayout['display_header_menu']->applied_value == "on") checked="" @endif value="on">
								        <span></span>
								    </label>
								</span>
							</div>
						</div>
						<!-- <div class="m-form__group form-group row">
							<label class="col-lg-4 col-form-label">Dropdown Skin(Desktop):</label>
							<div class="col-lg-8 col-xl-4">
								<select class="form-control" name="dropdown_skin">
									<option value="Light" @if(strtolower($userLayout['dropdown_skin']->applied_value) == "light") selected="" @endif>Light</option>
									<option value="dark" @if($userLayout['dropdown_skin']->applied_value == "dark") selected="" @endif>Dark</option>
								</select>
								<span class="m-form__help">Please select header menu dropdown skin</span>
							</div>
						</div> -->
						<div class="form-group m-form__group row">
							<label class="col-lg-4 col-form-label">Display Submenu Arrow(Desktop):</label>
							<div class="col-lg-8 col-xl-4">
								<span class="m-switch m-switch--icon-check">
									<label>
										<input type="checkbox" name="display_submenu_arrow" @if($userLayout['display_submenu_arrow']->applied_value == "on") checked="" @endif value="on">
								        <span></span>
								    </label>
								</span>
								<div class="m-form__help">Display header menu dropdown arrows on desktop mode</div>
							</div>
						</div>
					</div>
					<div class="tab-pane " id="m_builder_left_aside">
						<!-- <div class="form-group m-form__group row">
							<label class="col-lg-4 col-form-label">Aside Skin:</label>
							<div class="col-lg-8 col-xl-4">
								<select class="form-control" name="aside_skin">
									<option value="dark" @if($userLayout['aside_skin']->applied_value == "dark") selected="" @endif>Dark</option>
									<option value="light" @if($userLayout['aside_skin']->applied_value == "light") selected="" @endif>Light</option>
								</select>
								<div class="m-form__help">Set left aside skin</div>
							</div>
						</div> -->
						<div class="form-group m-form__group row">
							<label class="col-lg-4 col-form-label">Fixed Aside:</label>
							<div class="col-lg-8 col-xl-4">
								<span class="m-switch m-switch--icon-check">
									<label>
										<input type="checkbox" name="fixed_aside" @if($userLayout['fixed_aside']->applied_value == "on") checked="" @endif value="on">
								        <span></span>
								    </label>
								</span>
								<div class="m-form__help">Set fixed aside layout</div>
							</div>
						</div>
						<!-- <div class="form-group m-form__group row">
							<label class="col-lg-4 col-form-label">Allow Aside Minimizing:</label>
							<div class="col-lg-8 col-xl-4">
								<span class="m-switch m-switch--icon-check">
									<label>
										<input type="checkbox" name="allow_aside_minimizing" @if($userLayout['allow_aside_minimizing']->applied_value == "on") checked="" @endif value="on">
								        <span></span>
								    </label>
								</span>
								<div class="m-form__help">Allow aside minimizing</div>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<label class="col-lg-4 col-form-label">Default Hidden Aside:</label>
							<div class="col-lg-8 col-xl-4">
								<span class="m-switch m-switch--icon-check">
								    <label>
										<input type="checkbox" name="default_hidden_aside" @if($userLayout['default_hidden_aside']->applied_value == "on") checked="" @endif value="on">
								        <span></span>
								    </label>
								</span>
								<div class="m-form__help">Set aside hidden by default</div>
							</div>
						</div> -->
					</div>
					<div class="tab-pane " id="m_builder_footer">
						<div class="form-group m-form__group row">
							<label class="col-lg-4 col-form-label">Fixed Footer:</label>
							<div class="col-lg-8 col-xl-4">
								<span class="m-switch m-switch--icon-check">
								    <label>
										<input type="checkbox" name="fixed_footer" @if($userLayout['fixed_footer']->applied_value == "on") checked="" @endif value="on">
								        <span></span>
								    </label>
								</span>
								<div class="m-form__help">Set fixed header</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="m-portlet__foot m-portlet__foot--fit">
				<div class="m-form__actions">
					<div class="row">
						<div class="col-lg-4"></div>
						<div class="col-lg-8 ">

							<button name="builder_reset" data-modal-route="{{ url('layout_builder/resetConfirm') }}"
								data-modal-title="Reset Layout Buiilder Setting ?" data-modal-type="delete" class="btn btn-secondary btn-sm m-btn m-btn--icon m-btn--wide m-btn--custom m-btn--pill">
								<span>
									<i class="la la-recycle"></i>
									<span>Reset to default</span>
								</span>
							</button>

							<button type="submit" name="builder_submit" data-demo="default" class="btn btn-success m-btn--pill m-btn m-btn--icon m-btn--wide btn-sm m-btn--custom m-l-5">
								<span>
									<i class="la la-save"></i>
									<span>Save</span>
								</span>
							</button>

						</div>
					</div>
				</div>
			</div>
		</form>
		<!--end::Form-->
	</div>
</div>