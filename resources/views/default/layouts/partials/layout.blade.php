
<form class="m-form m-form--label-align-right m-form--fit" id="layout_builder_form"
      action="{{ route('updateLayoutBuilder',['user_id'=> auth()->id()]) }}" method="POST">
        @csrf
    <div class="m-list-settings m-t-10">
        <div class="m-list-settings__group">
            <div class="m-list-settings__heading">
                Layout Preference
            </div>
            <div class="m-list-settings__item">
				<span class="m-list-settings__item-label">
                    Background Color:
				</span>
                <span class="m-list-settings__item-control">
                    <select class="form-control" name="global_page_background">
                        <option value="none"
                                @if($userLayout['global_page_background']->applied_value == "none") selected @endif>
                            Default
                        </option>
                        <option value="lightyellow"
                                @if($userLayout['global_page_background']->applied_value == "lightyellow") selected @endif>
                            Light Yellow
                        </option>
                        <option value="darkblue"
                                @if($userLayout['global_page_background']->applied_value == "darkblue") selected @endif>
                            Dark Blue
                        </option>
                        <option value="lightgray"
                                @if($userLayout['global_page_background']->applied_value == "lightgray") selected @endif>
                            Light Gray
                        </option>
                        <option value="classic"
                                @if($userLayout['global_page_background']->applied_value == "classic") selected @endif>
                            Classic View
                        </option>
                        <option value="pinky"
                                @if($userLayout['global_page_background']->applied_value == "pinky") selected @endif>
                            Pink View
                        </option>
                    </select>
                </span>
            </div>


            <div class="m-list-settings__item">
				<span class="m-list-settings__item-label">
					Allow Aside Minimizing
				</span>
                <span class="m-list-settings__item-control">
					<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
					   <label>
        					<input type="checkbox" name="allow_aside_minimizing"
                                   @if($userLayout['allow_aside_minimizing']->applied_value == "on") checked=""
                                   @endif value="on">
        			        <span></span>
			            </label>
                    </span>
                </span>
            </div>
            <div class="m-list-settings__item">
				<span class="m-list-settings__item-label">
					Default Hidden Aside:
				</span>
                <span class="m-list-settings__item-control">
					<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
						<label>
							<input type="checkbox" name="default_hidden_aside"
                                   @if($userLayout['default_hidden_aside']->applied_value == "on") checked=""
                                   @endif value="on">
								<span></span>
						</label>
					</span>
				</span>
            </div>            
            <div class="m-list-settings__item">
				<span class="m-list-settings__item-label">
                    Font Size:
				</span>
                <span class="m-list-settings__item-control">
                    <select class="form-control" name="global_font_size">
                        @if(isset($userLayout['global_font_size']))
                            @if($userLayout['global_font_size']->applied_value == "default")
                                <option value="default" selected>Default</option>
                            @else 
                                <option value="default">Default</option>
                            @endif
                            @foreach (range(13,17) as $fontSize)
                                <option value="{{$fontSize}}" 
                                    @if($userLayout['global_font_size']->applied_value == $fontSize) selected @endif
                                >{{$fontSize . " px"}}</option>
                            @endforeach
                        @else
                            <option value="default" selected>Default</option>

                            @foreach (range(13,17) as $fontSize)
                                <option value="{{$fontSize}}">{{$fontSize . " px"}}</option>
                            @endforeach

                        @endif
                        
                    </select>
                </span>
            </div>
        </div>
    </div>
    <div class="m-list-settings m-t-10">
        {{--<div class="m-list-settings__group  m-t-10">
            <div class="m-list-settings__heading">
                Portlet Header Background
            </div>
            <div class="m-list-settings__item">
                <span class="m-list-settings__item-label">
                    Application:
                </span>
                <span>
                    <input type="color" class="form-control m-input" name="app_color" value="#378dd8">
                </span>
            </div>
        </div>--}}
        <div class="m-form__actions">
            <div class="row">
                <div class="col-lg-12 ">
                    <button name="builder_reset" data-modal-route="{{ url('layout_builder/resetConfirm') }}"
                            data-modal-title="Reset Layout Buiilder Setting ?" data-modal-type="delete"
                            class="btn btn-secondary btn-sm m-btn m-btn--icon m-btn--wide m-btn--custom m-btn--pill"
                            style="float: left">
                                <span>
                                    <i class="la la-recycle"></i>
                                    <span>Reset to default</span>
                                </span>
                    </button>

                    <button type="submit" name="builder_submit" data-demo="default"
                            class="btn btn-success m-btn--pill m-btn m-btn--icon m-btn--wide btn-sm m-btn--custom m-l-5"
                            style="float: right">
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