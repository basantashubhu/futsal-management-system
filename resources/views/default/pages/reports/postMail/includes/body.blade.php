<div class="m-content">
    <div class="m-portlet m-portlet--mobile certificate-border-color">
        <div class="m-portlet__body">
            <!--begin: Search Form -->
            <div class="m-form m-form--label-align-right m--margin-top-bottom">
                <div class="global-filter row no-gutters">
                    <div class="col-lg-12">
                        <div class="m-portlet no-m-i m-portlet--bordered-semi">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row justify-content-start align-items-center toolbar justify-content-start">
                                    <div class="col-auto">
                                        <div class="date_filter">
                                            <span class="m-subheader__daterange" id="m_application_date_filter">
                                               <span class="m-subheader__daterange-label">
                                                    <span class="m-subheader__daterange-date m--font-brand"></span>
                                                   <input type="hidden" name="date-range" class="date-range-input" id="postMailDateRange">
                                               </span>
                                               <a class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                                                    <i class="la la-angle-down"></i>
                                               </a>
                                           </span>
                                        </div>
                                    </div>
                                    <div class="col text-right">
                                        <button type="button" class="btn btn-warning btn-sm m-btn--pill showList" id="showMailList" data-ref="showAllLists" data-url="getGenerateLists">
                                            Show Files  <span class="m-badge m-badge--brand m-badge--pill" id="updateBadge"></span>
                                        </button>
                                        <button type="button" class="btn btn-warning btn-sm m-btn--pill showList" id="showAllLists" data-ref="showMailList" data-url="getAllLists" style="display: none;">
                                            Show List
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end: Search Form -->
            <div id="mailContentHolder">
                @include('default.pages.reports.postMail.includes.applicationDataTable')
            </div>
        </div>
    </div>
</div>
