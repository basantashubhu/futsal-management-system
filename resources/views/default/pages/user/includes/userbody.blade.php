<style>
    .m-datatable__cell {
        text-transform: unset !important;
    }
</style>
<div class="m-content">
    <div class="m-portlet m-portlet--mobile with-border">
        <div class="m-portlet__body">
            <!--begin: Search Form -->
            <div class="m-form m-form--label-align-right m--margin-top-bottom">
                <div class="global-filter row no-gutters">
                    <div class="col-lg-12">
                        <div class="m-portlet no-m-i m-portlet--bordered-semi">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row justify-content-start align-items-center toolbar justify-content-start">
                                    <form class="form form-inline" id="usersControll">
                                        <div class="col-auto">
                                            <div class="m-form__group m-form__group--inline w-220 pill-style">
                                                <div class="m-form__label left">
                                                    <label class="m-label m-label--single">
                                                        Name
                                                    </label>
                                                </div>
                                                <div class="m-form__control custom-selecter-btn">
                                                    <input class="form-control m-input form-control-sm  btn-redius" type="text" name="name" id="UserName">
                                                </div>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="m-form__group m-form__group--inline w-220 pill-style">
                                                <div class="m-form__label left">
                                                    <label class="m-label m-label--single">
                                                        Email
                                                    </label>
                                                </div>
                                                <div class="m-form__control custom-selecter-btn">
                                                    <input class="form-control m-input form-control-sm  btn-redius" type="text" name="email" id="UserEmail">
                                                </div>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="m-form__group m-form__group--inline w-220 pill-style">
                                                <div class="m-form__label left">
                                                    <label class="m-label m-label--single" for="user---role">
                                                        Role
                                                    </label>
                                                </div>
                                                <div class="m-form__control">
                                                    {{-- <input class="form-control m-input form-control-sm  btn-redius" type="text" name="role" id="UserRole"> --}}
                                                    <select name="role" id="user---role" class="form-control" title="Select"></select>
                                                </div>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div>
                                        <button class="hidden" id="searchUsersForm" data-target="usersControll"></button>
                                        <div class="col-auto">
                                            <button title="Reset Search" data-route="user" type="button" onclick="deleteCookie('users')"
                                                    class="m-portlet__nav-link btn btn-sm btn-secondary  m-btn m-btn--outline-2x m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
                                                <i class="fa fa-undo"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="responsive-filter row">
                    <div class="col-sm-6"></div>
                    <!-- Advance Filter -->
                        <div class="col-sm-6">
                            <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-left float-right m-dropdown--align-push"
                                 data-dropdown-toggle="click" title="Advance Filter" data-dropdown-persistent="true" aria-expanded="true">
                                <a href="#" id="showApplicationAdvanceSearch"
                                   class="m-portlet__nav-link btn btn-sm btn-secondary  m-btn m-btn--outline-2x m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
                                    <i class="la la-plus m--hide"></i>
                                    <i class="la la-align-right"></i>
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--left m-dropdown__arrow--adjust" style="right: 0 !important;"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__body no-pd-i">
                                            <div class="m-dropdown__content">
                                                <div class="row">
                                                    <div class="col-12 col-sm-12">
                                                        <div class="advance-search">
                                                            <form class="m-form m-form--fit m-form--label-align-right" id="ApplicationFilter">
                                                                <div class="m-portlet__body" style="padding: 0px !important;">
                                                                    <div class="row">
                                                                        <div class="col-sm-12 col-lg-12">
                                                                            <div class="form-group no-pd-bottom m-form__group row">
                                                                                <label for="invoiceProviderrname" class="col-form-label">Providers</label>
                                                                                <select class="form-control m-bootstrap-select m-input m-input--pill invoiceProviderrname1"
                                                                                        id="invoiceProviderrname1" data-selected-text-format="count > 3"
                                                                                        multiple data-width="100%">
                                                                                        @if(isset($providers) && count($providers))
                                                                                            @foreach($providers as $provider)
                                                                                                <option value="{{ $provider->cname }}">
                                                                                                    {{ $provider->cname }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        @endif
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-12">
                                                                            <div class="form-group no-pd-bottom m-form__group row">
                                                                                <label for="vetFilter" class="col-form-label">Veterinarian</label>
                                                                                <select class="form-control m-bootstrap-select m-input m-input--pill vetFilter1 "
                                                                                        id="vetFilter1" data-selected-text-format="count > 3"
                                                                                        multiple data-width="100%">
                                                                                        @if(isset($vets) && count($vets))
                                                                                            @foreach($vets as $vet)
                                                                                                <option value="{{ $vet->id }}">
                                                                                                    {{ $vet->fname }} {{ $vet->lname }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        @endif
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-12">
                                                                            <div class="form-group no-pd-bottom m-form__group row">
                                                                                <label for="invoiceOwnername" class="col-form-label">Owner</label>
                                                                                <input data-lookup="client/lookup" class="form-control m-input form-control-sm invoiceOwnername1" type="text" name="invoiceOwnername" id="invoiceOwnername1">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="m-form__actions footer-action">
                                                                    <div class="row row justify-content-between">
                                                                        <div class="col">
                                                                            <label for="showApplicationAdvanceSearch" onclick="$('#showApplicationAdvanceSearch').trigger('click')"
                                                                                   class="cancelBtn btn btn-sm m-btn m-btn--custom m-btn--pill btn-default float-left">
                                                                                Cancel
                                                                            </label>
                                                                        </div>
                                                                        <div class="col text-right">
                                                                            <button type="reset" class="applyBtn btn m-btn btn-sm m-btn--custom m-btn--pill btn-success">
                                                                                Apply
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Advance Filter -->
                    </div>
            </div>
            <!--end: Search Form -->
        <!--begin: Datatable -->
        <div class="m_datatable" id="auto_column_hide"></div>
        <!--end: Datatable -->
        </div>
    </div>
</div>