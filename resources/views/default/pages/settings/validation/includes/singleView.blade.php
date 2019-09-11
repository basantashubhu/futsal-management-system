<div class="m-portlet m-portlet--mobile with-border">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    {{ucfirst($section->section)}}
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <div class="row">
                <div class="col no-pd-right">
                    <input type="text" name="code" placeholder="Search {{ $section->section }} Code" id="ValidationTableSearch" class="form-control m-input--pill" autocomplete="off" style="width: 250px;float: right;">
                </div>
                <div class="col-auto">
                    <button type="button" data-modal-route="addValidation/{{$section->id}}" class="btn m-btn--pill btn-outline-info btn-sm m-btn m-btn--custom no-m-i" title="Add Rate">
                        <i class="la la-plus"></i> Add Code
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="m-portlet__body">
        <!-- Application Detail Summary -->
        <div class="row no-m pd-b-20">
            <div class="col-sm-12 col-md-12 no-pd-i">
                <div class="app-col-seperator height-100">
                    <div class="app-col-body">
                        <div class="row m-row--row-separator-xl">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="row lh-26">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        @include('default.pages.settings.validation.includes.dataTable')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>