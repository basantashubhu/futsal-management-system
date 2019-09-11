<div class="m-content">
    <div class="row">
        <div class="col col-sm-12 col-md-12 col-lg-3 col-xl-3">
            <div class="m-portlet m-portlet--mobile with-border">
                <div class="m-portlet__body">
                    <!--begin: Search Form -->
                    <div class="m-form m-form--label-align-right m--margin-top-bottom">
                        <div class="form-group m-form__group row justify-content-start align-items-center toolbar justify-content-start">
                            <!-- Advance Filter -->
                            <!-- Advance Filter -->
                            <form class="form width-100" id="siteSettingsFilter">
                                <div class="col-auto">
                                        <select name="section_name" id="ValidationSection" class="form-control m-input"></select>
                                        {{--<div class="input-group-prepend">--}}
                                            {{--<span class="input-group-text"--}}
                                                  {{--style="background-color: #f2f3f8 !important; border-top-left-radius: 20px;border-bottom-left-radius: 20px; height: 27px; border: none !important;">--}}
                                                {{--Section--}}
                                            {{--</span>--}}
                                        {{--</div>--}}
                                        {{----}}
                                        {{--<input type="text" name="section" id="validationSection"--}}
                                                   {{--class="form-control m-input applicationIDFilter"--}}
                                                   {{--style="height: 27px; border-top-right-radius: 20px;border-bottom-right-radius: 20px;" autocomplete="off"--}}
                                                   {{-->--}}
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--end: Search Form -->
                    <!--begin: Datatable -->
                    <div class="tableContainer" id="SiteSectionTable">
                        @foreach($v_sections as $v)
                        <?php $sec = $sections->firstWhere('section', $v->section) ?: $v; ?>
                            <div class="m-widget4 LookupSingleView {{ $sec->id == $section->id ? 'active_row' : '' }}" data-id="{{ $sec->id }}" data-c-route="validation/singleView/{{$sec->section}}">
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">{{ $sec->section }}</span> <br>
                                        <span class="m-widget4__sub font-12">{{ $sec->desc }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!--end: Datatable -->
                </div>
            </div>
        </div>
        <div class="col col-sm-12 col-md-12 col-lg-9 col-xl-9" id="singleValidation">
            {{-- @include('default.pages.settings.validation.includes.singleView') --}}
        </div>
    </div>
</div>