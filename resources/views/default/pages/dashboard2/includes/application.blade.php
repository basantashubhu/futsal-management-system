<!-- begin::draggable Portlet -->
<div class="row">
    <div class="col-lg-12">
        <div class="action-menu">
            <ul>
                <li>
                    <button class="m-portlet__nav-link btn-sm btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill"
                            data-route="application/4" title="View Application"><i class="la la-eye"></i></button>
                </li>
                <li>
                    <button class="m-portlet__nav-link btn btn-sm m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill"
                            data-route="application/4"
                            title="Edit Application"><i class="la la-eye"></i></button>
                </li>

                <li>
                    <button class="m-portlet__nav-link btn-sm btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill"
                            data-route="application/4"
                            title="View Application"><i class="la la-eye"></i></button>
                </li>
                <li>
                    <button class="m-portlet__nav-link btn btn-sm m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill"
                            data-route="application/4"
                            title="Edit Application"><i class="la la-eye"></i></button>
                </li>

                <li>
                    <button class="m-portlet__nav-link btn-sm btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill"
                            data-route="application/4"
                            title="View Application"><i class="la la-eye"></i></button>
                </li>
                <li>
                    <button class="m-portlet__nav-link btn btn-sm m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill"
                            data-route="application/4"
                            title="Edit Application"><i class="la la-eye"></i></button>
                </li>
            </ul>
        </div>
        <div class="m-portlet application-border-color">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Application
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav" style="width: 100%;">
                        <li class="m-portlet__nav-item">
                            <div class="m-form m-form--label-align-right float-right">
                                <div class="global-filter row no-gutters">
                                    <div class="col-lg-12">
                                        <div class="m-portlet no-m-i m-portlet--bordered-semi noBorder">
                                            <div class="m-portlet__body">
                                                <div class="form-group m-form__group row justify-content-start align-items-center toolbar justify-content-start">
                                                    <!-- Advance Filter -->
                            <div class="col-auto no-pd-right">
                                <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-left m-dropdown--align-push"
                                     data-dropdown-toggle="click" title="Advance Filter" data-dropdown-persistent="true"
                                     aria-expanded="true">
                                    <a href="#" id="showApplicationAdvanceSearchDashboard"
                                       class="m-portlet__nav-link btn btn-sm btn-brand  m-btn m-btn--outline-2x m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle closeClass">
                                        <i class="la la-plus m--hide"></i>
                                        <i class="la la-filter"></i>
                                    </a>
                                    <div class="m-dropdown__wrapper" style="width: 675px;">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--left m-dropdown__arrow--adjust"></span>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__body no-pd-i">
                                                <div class="m-dropdown__content">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-12">
                                                            <div class="advance-search">
                                                                <form class="m-form m-form--fit m-form--label-align-right"
                                                                      id="ApplicationFilter">
                                                                    <div class="m-portlet__body">
                                                                        <div class="row">
                                                                            <div class="col-sm-12 col-lg-4">
                                                                                <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                                                    <label for="example-text-input"
                                                                                           class="col-form-label">Owner/Care Taker</label>
                                                                                    <input class="form-control m-input form-control-sm advanceSearch"
                                                                                           type="text" value=""
                                                                                           name="clientName"
                                                                                           id="applicationClientName" autocomplete="off">
                                                                                </div>
                                                                                <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                                                    <label for="example-text-input"
                                                                                           class="col-form-label">Owner Mobile</label>
                                                                                    <input class="form-control m-input form-control-sm advanceSearch"
                                                                                           type="text" value=""
                                                                                           name="cellPhone"
                                                                                           id="applicationCell" autocomplete="off">
                                                                                </div>
                                                                                <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                                                    <label for="example-email-input"
                                                                                           class="col-form-label">Owner Email</label>
                                                                                    <input class="form-control m-input form-control-sm"
                                                                                           type="text" value=""
                                                                                           name="email"
                                                                                           id="applicationEmail" autocomplete="off">
                                                                                </div>
                                                                                <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                                                    <label for="example-search-input"
                                                                                           class="col-form-label">SSN</label>
                                                                                    <input class="form-control m-input form-control-sm advanceSearch"
                                                                                           type="text" value=""
                                                                                           name="ssn"
                                                                                           id="applicationSsnFilter" autocomplete="off">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-12 col-lg-4">
                                                                                <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                                                    <label for="example-text-input"
                                                                                           class="col-form-label">AppID</label>
                                                                                    <input class="form-control m-input form-control-sm applicationID"
                                                                                           type="text" value=""
                                                                                           name="applicationID"
                                                                                           id="applicationId" autocomplete="off">
                                                                                </div>

                                                                                <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                                                    <label for="example-text-input"
                                                                                           class="col-form-label">Application Date</label>
                                                                                    <input class="form-control m-input form-control-sm m_datepicker_1"
                                                                                           type="text" name="dateRange"
                                                                                           id="m_application_date_filter_advance" autocomplete="off">
                                                                                </div>
                                                                                <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                                                    <label for="example-email-input"
                                                                                           class="col-form-label">Status</label>
                                                                                    <select class="form-control m-bootstrap-select m-input"
                                                                                            name="status"
                                                                                            id="applicationStatusFilter_advance"
                                                                                            title="Select Status"
                                                                                            data-selected-text-format="count > 3"
                                                                                            multiple data-width="100%">
                                                                                        <option value="New" >New</option>
                                                                                        <option value="Review">Review</option>
                                                                                        <option value="Approved">Approved</option>
                                                                                        <option value="Denial">Denial</option>
                                                                                        <option value="Certificate">Certificate</option>
                                                                                        <option value="Invoiced">Invoiced</option>
                                                                                        <option value="Closed">Closed</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                                                    <label for="example-email-input"
                                                                                           class="col-form-label">Source</label>
                                                                                    <select class="form-control m-bootstrap-select m-input"
                                                                                            id="applicationStatusFilter_advance3"
                                                                                            title="Select Status"
                                                                                            data-selected-text-format="count > 3"
                                                                                            multiple data-width="100%">
                                                                                        <option value="" selected>All</option>
                                                                                        <option value="Manual">Manual</option>
                                                                                        <option value="FixedAndFab" >Fixed And Fab</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-12 col-lg-4">
                                                                                <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                                                    <label for="example-text-input"
                                                                                           class="col-form-label">City</label>
                                                                                    <!-- <div class="input-group m-input-group"> -->
                                                                                      <input class="form-control m-input form-control-sm"
                                                                                           type="text" value=""
                                                                                           name="city"
                                                                                           data-lookup="zip_code/getData/city"
                                                                                           id="applicationCity" autocomplete="off">
                                                                                           <!-- <div class="input-group-append">
                                                                                            <span class="input-group-text c-p" id="basic-addon1" data-sub-modal-route="getCity">
                                                                                              <i class="la la-search"></i>
                                                                                            </span>
                                                                                          </div>
                                                                                    </div> -->
                                                                                </div>
                                                                                <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                                                    <label for="example-text-input"
                                                                                           class="col-form-label">Zip</label>
                                                                                    <input class="form-control m-input form-control-sm"
                                                                                           type="text" value=""
                                                                                           name="zipCode"
                                                                                           data-lookup="zip_code/getData/zip_code"
                                                                                           id="applicationZip" autocomplete="off">
                                                                                </div>
                                                                                <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                                                    <label for="example-email-input"
                                                                                           class="col-form-label">Service Provider</label>
                                                                                    <select class="form-control m-bootstrap-select m-input"
                                                                                            id="serviceProviderFilter"
                                                                                            multiple data-width="250px" title="Select Provider" data-selected-text-format="count > 3" name="serviceProvider">
                                                                                        @if(isset($providers) && count($providers))
                                                                                            @foreach($providers as $provider)
                                                                                                <option value="{{ $provider->id }}">
                                                                                                    {{ $provider->cname }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        @endif
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                                                    <label for="example-email-input"
                                                                                           class="col-form-label">Vet Name</label>
                                                                                    <input class="form-control m-input form-control-sm"
                                                                                           type="text" value=""
                                                                                           name="vetName"
                                                                                           id="applicationEmail" autocomplete="off">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="m-form__actions footer-action">
                                                                        <div class="row row justify-content-between">
                                                                            <div class="col">
                                                                                <label for="showApplicationAdvanceSearch" onclick="$('#showApplicationAdvanceSearchDashboard').trigger('click')"
                                                                                       class="cancelBtn btn btn-sm m-btn m-btn--custom m-btn--pill btn-default float-left">
                                                                                    Cancel
                                                                                </label>
                                                                                <label for="showApplicationAdvanceSearch"
                                                                                       class="btn btn-sm m-btn m-btn--custom m-btn--pill btn-default float-left m-l-5 clearBtn" data-target="ApplicationFilter" data-close="showApplicationAdvanceSearchDashboard">
                                                                                            Clear
                                                                                </label>
                                                                            </div>
                                                                            <div class="col">
                                                                            </div>
                                                                            <div class="col text-right">
                                                                                <button type="button" for="showApplicationAdvanceSearchDashboard"
                                                                                        class="applyBtn btn m-btn btn-sm m-btn--custom m-btn--pill btn-success submitAppFilterDashboard" data-target="ApplicationFilter" data-close="showApplicationAdvanceSearchDashboard">
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
                            <!-- close Advance Filter -->
                            <div class="col-auto">
                              <div class="date_filter">
                              <span class="m-subheader__daterange"
                                    id="applicationDateRangePicker">
                                 <span class="m-subheader__daterange-label">
                                      <span class="m-subheader__daterange-date m--font-brand"></span>
                                     <input type="hidden" name="date-range"
                                            id="ApplicationDateRange">
                                 </span>
                                 <a class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                                      <i class="la la-angle-down"></i>
                                 </a>
                             </span>
                              </div>
                            </div>
                                                    <form class="form form-inline" id="DashboardApplicationQuickSearch">

                                                        <div class="col-auto">
                                                            <div class="input-group m-input-group"
                                                                 style="border-radius: 20px !important;">
                                                                <div class="input-group-prepend">
                                                                <span class="input-group-text"
                                                                      style="background-color: #f2f3f8 !important; border-top-left-radius: 20px;border-bottom-left-radius: 20px; height: 27px; border: none !important;">
                                                                    AppId
                                                                </span>
                                                                </div>
                                                                <input type="text"
                                                                       name="applicationID"
                                                                       class="form-control m-input width-80 applicationIDFilter"
                                                                       aria-describedby="basic-addon1"
                                                                       style="height: 27px; border-top-right-radius: 20px;border-bottom-right-radius: 20px;"
                                                                       id="applicationIDFilter" autocomplete="off">
                                                            </div>
                                                            <div class="d-md-none m--margin-bottom-10"></div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="input-group m-input-group"
                                                                 style="border-radius: 20px !important;">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" style="background-color: #f2f3f8 !important; border-top-left-radius: 20px;border-bottom-left-radius: 20px; height: 27px; border: none !important;">
                                                                        Source
                                                                    </span>
                                                                </div>
                                                                <div class="m-form__control custom-selecter-btn">
                                                                    <select class="form-control m-bootstrap-select m-input m-input--pill applicationSourceFilter"
                                                                            name="source"
                                                                            id="applicationSourceFiltertest"
                                                                             data-style="btn-redius" data-width="160"
                                                                            title="Select Source"
                                                                            data-actions-box="true">
                                                                        <option value="" selected>All</option>
                                                                        <option value="Manual">Manual</option>
                                                                        <option value="Fixed and Fab" >Fixed and Fab</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="d-md-none m--margin-bottom-10"></div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="m-form__group m-form__group--inline w-220 pill-style">
                                                                <div class="m-form__label left">
                                                                    <label class="m-label m-label--single">
                                                                        Status
                                                                    </label>
                                                                </div>
                                                                <div class="m-form__control custom-selecter-btn">
                                                                    <select class="form-control m-bootstrap-select m-input m-input--pill applicationStatusFilter"
                                                                            name="status"
                                                                            id="applicationStatusFiltertest" multiple
                                                                            data-width="170px" data-style="btn-redius"
                                                                            title="Select Status"
                                                                            data-actions-box="true" name="statusSingle" data-selected-text-format="count > 3">
                                                                        <option value="New" selected>New</option>
                                                                        <option value="Pending" selected>Pending</option>
                                                                        <option value="Review" selected>Review</option>
                                                                        <option value="Approved" selected>Approved</option>
                                                                        <option value="Denial">Denial</option>
                                                                        <option value="Certificate">Certificate</option>
                                                                        <option value="Invoiced">Invoiced</option>
                                                                        <option value="Closed">Closed</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="d-md-none m--margin-bottom-10"></div>
                                                        </div>
                                                        <button type="button" class="hidden" id="hiddenButton" data-target="DashboardApplicationQuickSearch">test</button>
                                                    </form>
                                                    <div class="col-auto">
                                                        <button title="Reset Search" data-route="dashboard"
                                                                class="m-portlet__nav-link btn btn-sm btn-brand m-btn m-btn--outline-2x m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
                                                            <i class="fa fa-undo"></i>
                                                        </button>
                                                    </div>
                                                    <div class="col text-right">
                                                        <div class="m-btn-group m-btn-group--pill btn-group"
                                                             role="group"
                                                             aria-label="Button group with nested dropdown">
                                                            <div class="m-btn-group btn-group" role="group">
                                                                <button id="ietableExport" type="button"
                                                                        class="btn btn-warning btn-sm m-btn m-btn--pill-last br-60 dropdown-toggle"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">
                                                                    Export as
                                                                </button>
                                                                <div class="dropdown-menu"
                                                                     aria-labelledby="ietableExport"
                                                                     x-placement="bottom-start">
                                                                    {{--<button class="c-p dropdown-item ietable-export" data-export-type="excel">
                                                                        Excel
                                                                    </button>
                                                                    <button class="c-p dropdown-item ietable-export" data-export-type="doc">
                                                                        Doc
                                                                    </button>--}}
                                                                    <button class="c-p dropdown-item server-applicationexporter"
                                                                            data-export-type="csv">
                                                                        CSV
                                                                    </button>
                                                                    <button class="c-p dropdown-item server-applicationexporter"
                                                                            data-export-type="txt">
                                                                        Text
                                                                    </button>
                                                                    <button class="c-p dropdown-item server-applicationexporter"
                                                                            data-export-type="json">
                                                                        JSON
                                                                    </button>
                                                                    <button class="c-p dropdown-item server-applicationexporter"
                                                                            data-export-type="pdf">
                                                                        PDF
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="responsive-filter float-left">
                                    <!-- Advance Filter -->
                                    <div class="col-auto no-pd-right">
                                        <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-left m-dropdown--align-push"
                                             data-dropdown-toggle="click" title="Advance Filter"
                                             data-dropdown-persistent="true" aria-expanded="true">
                                            <a href="#" id="showApplicationAdvanceSearchDashboard1"
                                               class="m-portlet__nav-link btn btn-sm btn-secondary  m-btn m-btn--outline-2x m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle closeClass">
                                                <i class="la la-plus m--hide"></i>
                                                <i class="la la-align-right"></i>
                                            </a>
                                            <div class="m-dropdown__wrapper" style="width: 500px;">
                                              <span class="m-dropdown__arrow m-dropdown__arrow--left m-dropdown__arrow--adjust"
                                                    style="right: 0 !important;"></span>
                                              <div class="m-dropdown__inner">
                                                  <div class="m-dropdown__body no-pd-i">
                                                      <div class="m-dropdown__content">
                                                          <div class="row">
                                                              <div class="col-12 col-sm-12">
                                                                  <div class="advance-search">
                                                                      <form class="m-form m-form--fit m-form--label-align-right"
                                                                            id="smallApplicationFilter">
                                                                          <div class="m-portlet__body" style="padding: 0px !important;">
                                                                              <div class="row">
                                                                                  <div class="col-sm-6 col-lg-6">
                                                                                      <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                                                          <label for="example-text-input"
                                                                                                 class="col-form-label">Owner/Care Taker</label>
                                                                                          <input class="form-control m-input form-control-sm advanceSearch"
                                                                                                 type="text" value=""
                                                                                                 name="clientName" autocomplete="off">
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-sm-6 col-lg-6">
                                                                                    <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                                                        <label for="example-text-input"
                                                                                               class="col-form-label">Owner Mobile</label>
                                                                                        <input class="form-control m-input form-control-sm advanceSearch"
                                                                                               type="text" value=""
                                                                                               name="cellPhone"
                                                                                               id="applicationCell" autocomplete="off">
                                                                                    </div>
                                                                                  </div>
                                                                                  <div class="col-sm-6 col-lg-6">
                                                                                    <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                                                        <label for="example-email-input"
                                                                                               class="col-form-label">Owner Email</label>
                                                                                        <input class="form-control m-input form-control-sm"
                                                                                               type="text" value=""
                                                                                               name="email"
                                                                                               id="applicationEmail" autocomplete="off">
                                                                                    </div>
                                                                                  </div>
                                                                                  <div class="col-sm-6 col-lg-6">
                                                                                    <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                                                        <label for="example-search-input"
                                                                                               class="col-form-label">SSN</label>
                                                                                        <input class="form-control m-input form-control-sm advanceSearch"
                                                                                               type="text" value=""
                                                                                               name="ssn"
                                                                                               id="applicationSsnFilter" autocomplete="off">
                                                                                    </div>
                                                                                  </div>
                                                                                  <div class="col-sm-6 col-lg-6">
                                                                                    <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                                                        <label for="example-text-input"
                                                                                               class="col-form-label">AppID</label>
                                                                                        <input class="form-control m-input form-control-sm applicationID"
                                                                                               type="text" value=""
                                                                                               name="applicationID"
                                                                                               id="applicationId" autocomplete="off">
                                                                                    </div>
                                                                                  </div>
                                                                                  <div class="col-sm-6 col-lg-6">
                                                                                    <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                                                        <label for="example-text-input"
                                                                                               class="col-form-label">Application Date</label>
                                                                                        <input class="form-control m-input form-control-sm m_datepicker_1"
                                                                                               type="text" name="dateRange"
                                                                                               id="m_application_date_filter_advance" autocomplete="off">
                                                                                    </div>
                                                                                  </div>

                                                                                  <div class="col-sm-6 col-lg-6">
                                                                                      <div class="form-group no-pd-bottom m-form__group row">
                                                                                          <label for="example-email-input"
                                                                                                 class="col-form-label">Status</label>
                                                                                          <select class="form-control form-control-sm m-bootstrap-select m-input"
                                                                                                  id="applicationStatusFilter_advance2"
                                                                                                  title="Select Status"
                                                                                                  data-selected-text-format="count > 3" multiple name="status[]"
                                                                                          >
                                                                                              @if(isset($status) && count($status))
                                                                                                  @foreach($status as $sta)
                                                                                                      <option value="{{ $sta->value }}">
                                                                                                          {{ $sta->value }}
                                                                                                      </option>
                                                                                                  @endforeach
                                                                                              @endif
                                                                                          </select>
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-sm-6 col-lg-6">
                                                                                      <div class="form-group no-pd-bottom m-form__group row">
                                                                                          <label for="example-email-input"
                                                                                                 class="col-form-label">Source</label>
                                                                                          <select class="form-control form-control-sm m-bootstrap-select m-input"
                                                                                                  id="applicationCopayFilter1"
                                                                                                  title="Select Source" name="source">
                                                                                              <option value="" selected>All</option>
                                                                                              <option value="Manual">Manual</option>
                                                                                              <option value="FF">Fixed And Fab</option>
                                                                                          </select>
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-sm-6 col-lg-6">
                                                                                    <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                                                        <label for="example-text-input"
                                                                                               class="col-form-label">City</label>
                                                                                        <input class="form-control m-input form-control-sm"
                                                                                               type="text" value=""
                                                                                               data-lookup="zip_code/getData/city"
                                                                                               name="city"
                                                                                              autocomplete="off">
                                                                                    </div>
                                                                                  </div>
                                                                                  <div class="col-sm-6 col-lg-6">
                                                                                    <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                                                        <label for="example-text-input"
                                                                                               class="col-form-label">ZIP</label>
                                                                                        <input class="form-control m-input form-control-sm"
                                                                                               type="text" value=""
                                                                                               name="zipCode"
                                                                                               data-lookup="zip_code/getData/zip_code"
                                                                                              autocomplete="off">
                                                                                    </div>
                                                                                  </div>
                                                                                  <div class="col-sm-6 col-lg-6">
                                                                                    <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                                                        <label for="example-email-input"
                                                                                               class="col-form-label">Service Provider</label>
                                                                                        <select class="form-control form-control-sm m-bootstrap-select m-input"
                                                                                                id="serviceProviderFilter1"
                                                                                                multiple data-width="250px" title="Select Provider" data-selected-text-format="count > 3" name="serviceProvider">
                                                                                            @if(isset($providers) && count($providers))
                                                                                                @foreach($providers as $provider)
                                                                                                    <option value="{{ $provider->id }}">
                                                                                                        {{ $provider->cname }}
                                                                                                    </option>
                                                                                                @endforeach
                                                                                            @endif
                                                                                        </select>
                                                                                    </div>
                                                                                  </div>
                                                                                  <div class="col-sm-6 col-lg-6">
                                                                                    <div class="form-group np-pd-left no-pd-bottom m-form__group row">
                                                                                        <label for="example-email-input"
                                                                                               class="col-form-label">Vet Name</label>
                                                                                        <input class="form-control m-input form-control-sm"
                                                                                               type="text" value=""
                                                                                               name="vetName"
                                                                                               id="applicationEmail" autocomplete="off">
                                                                                    </div>
                                                                                  </div>
                                                                              </div>
                                                                          </div>

                                                                          <div class="m-form__actions footer-action">
                                                                              <div class="row row justify-content-between">
                                                                                  <div class="col">
                                                                                      <label for="showApplicationAdvanceSearch"
                                                                                             onclick="$('#showApplicationAdvanceSearch1').trigger('click')"
                                                                                             class="cancelBtn btn btn-sm m-btn m-btn--custom m-btn--pill btn-default float-left">
                                                                                          Cancel
                                                                                      </label>
                                                                                      <label for="showApplicationAdvanceSearch"
                                                                                       class="btn btn-sm m-btn m-btn--custom m-btn--pill btn-default float-left m-l-5 clearBtn" data-target="smallApplicationFilter" data-close="showApplicationAdvanceSearchDashboard1">
                                                                                            Clear
                                                                                        </label>
                                                                                  </div>
                                                                                  <div class="col text-right">
                                                                                      <button type="button"
                                                                                              class="applyBtn btn m-btn btn-sm m-btn--custom m-btn--pill btn-success submitAppFilterDashboard"
                                                                                              data-target="smallApplicationFilter" data-close="showApplicationAdvanceSearchDashboard1">
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
                                <div class="s-exportClass">
                                    <div class="m-btn-group m-btn-group--pill btn-group"
                                         role="group"
                                         aria-label="Button group with nested dropdown">
                                        <div class="m-btn-group btn-group" role="group">
                                            <button id="ietableExport" type="button"
                                                    class="btn btn-warning btn-sm m-btn m-btn--pill-last br-60 dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                Export as
                                            </button>
                                            <div class="dropdown-menu"
                                                 aria-labelledby="ietableExport"
                                                 x-placement="bottom-start">
                                                {{--<button class="c-p dropdown-item ietable-export" data-export-type="excel">
                                                    Excel
                                                </button>
                                                <button class="c-p dropdown-item ietable-export" data-export-type="doc">
                                                    Doc
                                                </button>--}}
                                                <button class="c-p dropdown-item server-applicationexporter"
                                                        data-export-type="csv">
                                                    CSV
                                                </button>
                                                <button class="c-p dropdown-item server-applicationexporter"
                                                        data-export-type="txt">
                                                    Text
                                                </button>
                                                <button class="c-p dropdown-item server-applicationexporter"
                                                        data-export-type="json">
                                                    JSON
                                                </button>
                                                <button class="c-p dropdown-item server-applicationexporter"
                                                        data-export-type="pdf">
                                                    PDF
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body m-portlet__body--no-padding">
                <div class="row m-row--no-padding">
                    <div class="col-xl-3">
                        <!--begin:: Widgets/Profit Share-->
                        <div class="m-widget14" style="padding: 1rem;">
                            <div class="m-widget14__header">
                                <h3 class="m-widget14__title">
                                    <!-- Application -->
                                </h3>
                                <span class="m-widget14__desc" id="totalApplication">
                                    Total Application
                                </span>
                            </div>
                            <div class="row  align-items-center">
                                <div class="col">
                                    <div id="application_chart" class="m-widget14__chart1" style="height: 180px"></div>
                                </div>
                                <div class="col">
                                    <div class="m-widget14__legends" style="margin-left: -20px;">
                                        <div class="m-widget14__legend">
                                            <span class="m-widget14__legend-bullet m--bg-info"
                                                  style="width: 1rem;"></span>
                                            <span class="m-widget14__legend-text c-p upadateTableApp t-u" id="New"
                                                  data-value="New">
                                            </span>
                                        </div>
                                        <div class="m-widget14__legend">
                                            <span class="m-widget14__legend-bullet m--bg-primary"
                                                  style="width: 1rem;"></span>
                                            <span class="m-widget14__legend-text c-p upadateTableApp t-u" id="Review"
                                                  data-value="Review">
                                            </span>
                                        </div>
                                        <div class="m-widget14__legend">
                                            <span class="m-widget14__legend-bullet m--bg-success"
                                                  style="width: 1rem;"></span>
                                            <span class="m-widget14__legend-text c-p upadateTableApp t-u" id="Approved"
                                                  data-value="Approved">
                                            </span>
                                        </div>
                                        <div class="m-widget14__legend">
                                            <span class="m-widget14__legend-bullet m--bg-warning"
                                                  style="width: 1rem;"></span>
                                            <span class="m-widget14__legend-text c-p upadateTableApp t-u" id="Denial"
                                                  data-value="Denial">
                                            </span>
                                        </div>
                                        <div class="m-widget14__legend">
                                            <span class="m-widget14__legend-bullet m--bg-danger"
                                                  style="width: 1rem;"></span>
                                            <span class="m-widget14__legend-text c-p upadateTableApp t-u" id="Closed"
                                                  data-value="Closed">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end:: Widgets/Profit Share-->
                    </div>
                    <div class="col-xl-9">
                        <!--begin: Datatable -->
                        <div class="m_datatable" id="application_datatable"></div>
                        <!--end: Datatable -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    loadCookie('application','.submitAppFilterDashboard');
    loadCookie('application_open','#hiddenButton');
    $(document).ready(function () {
      var appOpenData = [{name: $('#applicationIDFilter').attr('name'), value: $('#applicationIDFilter').val()}, {name: $('#applicationSourceFiltertest').attr('name'), value: $('#applicationSourceFiltertest').val()}, {name: $('#applicationStatusFiltertest').attr('name'), value: $('#applicationStatusFiltertest').val()}];
        $('#applicationStatusFilter_advance, #applicationStatusFilter_advance3, #serviceProviderFilter').selectpicker({
            liveSearch: true,
            showTick: true,
            actionsBox: true,
        });
        $('.applicationStatusFilter').selectpicker({
            liveSearch: true,
            showTick: true,
            actionsBox: true,
        });
        $('.applicationSourceFilter').selectpicker({
            liveSearch: true,
            showTick: true,
            actionsBox: true,
        });
        $('.applicationCopayFilter, #applicationCopayFilter1').selectpicker({
            liveSearch: true,
            showTick: true,
            actionsBox: true,
        });
        $('.applicationStatusFilter_advance').selectpicker({
            liveSearch: true,
            showTick: true,
            actionsBox: true,
        });
        $('.applicationStatusFilter_advance1').selectpicker({
            liveSearch: true,
            showTick: true,
            actionsBox: true,
        });
        $('#applicationStatusFilter_advance').off('change').on('change',function(){
            $(this).selectpicker('val',$(this).val());
            $('#applicationStatusFiltertest').selectpicker('val',$(this).val());
        });

        ajaxRequest({
            url: 'applications/chart'
        }, function (response) {
            var chartData = response.data;
            $(response.data).each(function (i, val) {
                $('#' + val.label).text(val.value + ' ' + val.label);
            });
        });
        // var status = loadCookie('application_open','#hiddenButton', true);
        // console.log(status);
        


        var apptable = $('#application_datatable').mDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: '/application/all',
                        method: 'POST',
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        params:{
                        },
                    },
                },
                pageSize: 5,
                saveState: false,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true,

            },
            layout: {
                theme: 'default',
                class: '',
                scroll: false,
                height: 550,
                footer: false
            },

            // column sorting
            sortable: true,

            pagination: true,

            toolbar: {
                // toolbar items
                items: {
                    // pagination
                    pagination: {
                        // page size select
                        pageSizeSelect: [5, 10, 20, 30, 50, 100],
                    },
                },
            },

            search: {
                input: $('#generalSearch'),
            },
            rows: {
                autoHide: true,
            },

            // columns definition
            columns: [
                {
                    field: 'created_at',
                    title: 'Date',
                    sortable: 'desc',
                    template: function (row) {
                        return moment(row.created_at).format(std.config.date_format);
                    },
                    width: 80,
                },
                {
                    field: 'id',
                    title: 'AppId',
                    width: 100,
                    template: function (row) {
                        if (std.config.alt_id == 'true' && row.alt_id) {
                            return 'IE' + row.alt_id.toString().padStart(5, '0');
                        }
                        return row.id;
                    }
                },
                {
                    field: 'fname',
                    title: 'Owner/Care Taker',
                    sortable: false,
                    width: 200,
                    template: function (row) {
                        if (row.fname == null) {
                            return '';
                        }
                        if (row.mname)
                            return row.fname + ' ' + row.mname + ' ' + row.lname;
                        else
                            return row.fname + ' ' + row.lname;
                    },
                },
                {
                    field: 'cell_phone',
                    title: 'Phone',
                    sortable: false,
                    template: function (row) {
                      if(row.cell_phone){
                        var cell = row.cell_phone.replace(/(\d{3})(\d{3})(\d{4})/, "($1) $2-$3");
                        return cell;
                      }else{
                        return '-';
                      }
                    },
                },
                {
                    field: 'city',
                    title: 'City',
                    sortable: false,
                    template: function (row) {
                        return row.city
                    },
                },
                {
                    field: 'status',
                    title: 'Status',
                    width: 120,
                    template: function (row) {
                        if (!row.status) {
                            return '<span class="m-badge m-badge--info m-badge--wide c-p">New</span>';
                        }
                        if (row.status == 'New') {
                            var type = 'm-badge--info';

                        } else if (row.status == 'Pending') {
                            var type = 'm-badge--warning';
                        } else if (row.status == 'Approved') {
                            var type = 'm-badge--success';
                        } else if (row.status == 'Invoiced') {
                            var type = 'm-badge--warning';
                        } else if (row.status == 'Review'){
                            var type = 'm-badge--primary';
                        }
                        else {
                            var type = 'm-badge--danger';
                        }
                        return '<span class="m-badge ' + type + ' m-badge--wide c-p">' + row.status + '</span>';

                    }
                },
                {
                    field: 'source',
                    title: 'Source',
                    width: 70,
                    template: function (row) {
                        if (row.source) {
                            return '<h6>' + row.source + '</h6>'
                        }
                        return '';
                    },
                },
                {
                    field: 'action',
                    title: 'Action',
                    width: 70,
                    template: function (row) {
                        @if(auth()->user()->role->name == 'non_profit')
                                return '<button class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" data-route="sp_applicationSingle/' + row.id + '" title="View Application">' +
                                '<i class="la la-eye"></i>' +
                                '</button>';
                        @else
                                return '<button class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" data-route="application/' + row.id + '" title="View Application">' +
                                '<i class="la la-eye"></i>' +
                                '</button>';
                        @endif
                    },
                },]

        });

        $(document).off('change', '#applicationStatusFiltertest').on('change', '#applicationStatusFiltertest', function () {
            apptable.search($(this).val(), 'status');
            appOpenData.splice(2, 1, {name: 'status', value: $(this).val()});
            setCookie('application_open',JSON.stringify(appOpenData));
        });

        $('.applicationIDFilter').off('blur').on('blur', function () {
            apptable.search($(this).val(), 'applicationID');
            appOpenData.splice(0, 1, {name: 'applicationID', value: $(this).val()});
            setCookie('application_open',JSON.stringify(appOpenData));
        });

        $('#applicationSourceFiltertest').off('change').on('change', function () {
            $('#applicationStatusFilter_advance').selectpicker('val',$(this).val());
            $(this).selectpicker('val',$(this).val());

            apptable.search($(this).val(), 'source');

            appOpenData.splice(1, 1,{name: 'source', value: $(this).val()});
            setCookie('application_open',JSON.stringify(appOpenData));
        });
        // $('#applicationDateRangePicker').on('blur', function () {
        //     apptable.search($(this).val(), 'dateRange');
        // });
        $('#source').on('change', function () {
            apptable.search($(this).val(), 'source');
            appOpenData.push({name: 'source', value: $(this).val()});
        });

        $('#applicationDateRangePicker').on('apply.daterangepicker', function (ev, picker) {
            var dateRange = picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY');
            apptable.search(dateRange, 'dateRange');
        });
        $(document).off('click', '.submitAppFilterDashboard').on('click', '.submitAppFilterDashboard', function (e) {
            var id = $(this).attr('data-target');
            data = $('#'+id).serializeArray();
            var close = $(this).attr('data-close');
            // $('#'+close).click();

            $('#showApplicationAdvanceSearchDashboard1').click();
            // $('.closeClass').each(function(){
            // });
            setCookie('application',JSON.stringify(data));
            apptable.search(data, 'advancedFilter');
        });

        $(document).off('click', '#hiddenButton').on('click', '#hiddenButton', function (e) {
            var id = $(this).attr('data-target');
            data = $('#'+id).serializeArray();
            apptable.search(data, 'advancedFilter');
        });

        TopDateLoader('#applicationDateRangePicker');
        loadSearchDateRange("applicationDateRange");

        $(document).off('click', '.upadateTableApp').on('click', '.upadateTableApp', function (e) {
            var value = [$(this).data('value')];
            apptable.search(value, 'status');
            $('#applicationStatusFiltertest').selectpicker('val', value);
            appOpenData.splice(2, 1, {name: 'status', value: value});
            setCookie('application_open',JSON.stringify(appOpenData));
        });
    });
</script>
<!-- end::draggable Portlet -->
