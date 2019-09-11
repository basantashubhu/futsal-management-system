<div class="m-content">
    <div class="row">
        <div class="col col-sm-12 col-md-12 col-lg-3 col-xl-3">
            <div class="m-portlet m-portlet--mobile with-border">
                <div class="m-portlet__body" style="max-height: 630px;overflow-y: auto;">
                    <!--begin: Search Form -->
                    <div class="m-form m-form--label-align-right m--margin-top-bottom">
                        <div class="form-group m-form__group row justify-content-start align-items-center toolbar justify-content-start">
                            <!-- Advance Filter -->
                            <!-- Advance Filter -->
                            <form class="form w-100 lookupT" id="siteSettingsFilter">
                                <div class="col-auto">
                                    <select name="code" id="SiteSection"
                                            class="form-control m-input applicationDIFilter"></select>
                                    {{--<div class="input-group m-input-group" style="border-radius: 20px !important;">--}}
                                    {{--<div class="input-group-prepend " >--}}
                                    {{--<span class="input-group-text"--}}
                                    {{--style="background-color: #f2f3f8 !important; border-top-left-radius: 20px;border-bottom-left-radius: 20px; height: 27px; border: none !important;">--}}
                                    {{--Section--}}
                                    {{--</span>--}}
                                    {{--</div>--}}
                                    {{--<input type="text" name="code" id="SiteSection"--}}
                                    {{--class="form-control m-input applicationIDFilter"--}}
                                    {{--style="height: 27px; border-top-right-radius: 20px;border-bottom-right-radius: 20px; width: 140px;"--}}
                                    {{--autocomplete="off">--}}
                                    {{--</div>--}}
                                </div>
                            </form>
                        </div>
                    </div>

                    <!--end: Search Form -->
                    <!--begin: Datatable -->
                    <!-- <div class="lookup_datatable" id="auto_column_hide"></div> -->
                    <!--end: Datatable -->
                    <div class="row m-t-10-i">
                        <div class="col-sm-12">
                            <div class="tableContainer" id="SiteSectionTable">
                                @foreach($sections as $sec)
                                <?php $lookup = $lookups->firstWhere('section', $sec) ?: $sec;  ?>
                                <div class="m-widget4 LookupSingleView {{ $loop->index === 0 ? 'active_row' : '' }}" data-id="{{ $lookup->id??'' }}" data-c-route="lookup/singleView/{{$lookup->id??''}}">
                                    <div class="m-widget4__item">
                                        <div class="m-widget4__info">
                                            <span class="m-widget4__title">{{ $lookup->section??'' }}</span> <br>
                                            <span class="m-widget4__sub font-12">{{ $lookup->desc??'' }}</span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                {{--<table class="table table-bordered m-table m-table--head-bg-success" id="SiteSectionTable">--}}
                                {{--<thead class="fixedHeader">--}}
                                {{--<tr>--}}
                                {{--<th width="10%">Section</th>--}}
                                {{--</tr>--}}
                                {{--</thead>--}}
                                {{--<tbody class="scrollContent">--}}
                                {{--@foreach($lookups as $lookup)--}}
                                {{--<tr @if($loop->index === 0) class="active_row" @endif data-id="{{ $lookup->id }}">--}}
                                {{--<td width="338px" class="c-p makeActiveClass LookupSingleView"--}}
                                {{--data-c-route="lookup/singleView/{{$lookup->id}}">--}}
                                {{--{{$lookup->section}}--}}
                                {{--</td>--}}
                                {{--</tr>--}}
                                {{--@endforeach--}}
                                {{--</tbody>--}}
                                {{--</table>--}}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col col-sm-12 col-md-12 col-lg-9 col-xl-9" id="singleLookup">
            @include('default.pages.settings.lookups.includes.singleLookup')
        </div>
    </div>
</div>