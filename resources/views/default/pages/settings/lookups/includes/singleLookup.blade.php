<div class="m-portlet m-portlet--mobile with-border">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    {{ucfirst($section)}}
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <div class="row">
                <div class="col no-pd-right">
                    <input name="code" id="LookupSingleTableSearch" placeholder="Search {{ $section }} Code" type="text" class="form-control m-input--pill" autocomplete="off" style="width: 250px;float: right;">
                </div>
                <div class="col-auto">
                    <button type="button" data-modal-route="lookup/addCode/{{$section}}" class="btn m-btn--pill btn-outline-info btn-sm m-btn m-btn--custom no-m-i" title="Add Rate">
                        <i class="la la-plus"></i> Add Code
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="m-portlet__body">
        <!-- Application Detail Summary -->
        <div class="m-accordion m-accordion--default m-accordion--solid" id="m_accordion_3" role="tablist">
            <!--begin::Item-->
            {{--@foreach($codes as $v)--}}
                @include('default.pages.settings.lookups.includes.dataTable')
            {{--@endforeach--}}
            <!--End::Item-->
        </div>
    </div>
</div>