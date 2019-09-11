<div class="m-content" id="reportContent">
    <div class="row">
        <!--List section-->
        <div class="col-4 col-sm-3 col-md-3">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__body">
                    <div class="m-list-search">
                        <div class="m-list-search__results data-link">
                            <span class="m-list-search__result-category m-list-search__result-category--first">
																	Reports
                                                                </span>
                            @canAccess('fgp_reports_sec', 'report_volunteer')
                            <a data-table-target='volunteers' class="m-list-search__result-item pd-5-i c-p active_class_row">
																	<span class="m-list-search__result-item-icon">
																		<i class="flaticon-interface-3 m--font-warning"></i>
																	</span>
                                <span class="m-list-search__result-item-text t-u">
																		Volunteer
																	</span>
                            </a>
                            @endcanAccess
                            @canAccess('fgp_reports_sec', 'report_timesheet')
                            <a data-table-target='timesheets' class="m-list-search__result-item pd-5-i c-p">
                                                                    <span class="m-list-search__result-item-icon">
                                                                        <i class="flaticon-layers m--font-info"></i>
                                                                    </span>
                                <span class="m-list-search__result-item-text t-u">
                                                                        TimeSheet
                                                                    </span>
                            </a>
                            @endcanAccess
                            @canAccess('fgp_reports_sec', 'report_site')
                            <a data-table-target='sites' class="m-list-search__result-item pd-5-i c-p">
                                                                    <span class="m-list-search__result-item-icon">
                                                                        <i class="flaticon-layers m--font-info"></i>
                                                                    </span>
                                <span class="m-list-search__result-item-text t-u">
                                                                        Sites
                                                                    </span>
                            </a>
                            @endcanAccess
                            @canAccess('fgp_reports_sec', 'report_fiscal_stipend')
                            <a data-table-target='finance_stipend_period' class="m-list-search__result-item pd-5-i c-p">
                                <span class="m-list-search__result-item-icon">
                                    <i class="flaticon-layers m--font-info"></i>
                                </span>
                                <span class="m-list-search__result-item-text t-u">
                                                                    Fiscal Stipend Period
                                                                </span>
                            </a>
                            @endcanAccess
                            @canAccess('fgp_reports_sec', 'report_fiscal_site')
                            <a data-table-target='fiscal_sites' class="m-list-search__result-item pd-5-i c-p">
                                <span class="m-list-search__result-item-icon">
                                    <i class="flaticon-layers m--font-info"></i>
                                </span>
                                <span class="m-list-search__result-item-text t-u">
                                                                    Fiscal Sites
                                                                </span>
                            </a>
                            @endcanAccess
                            @canAccess('fgp_reports_sec', 'report_fiscal_volunteer')
                            <a data-table-target='fiscal_volunteers' class="m-list-search__result-item pd-5-i c-p">
                                <span class="m-list-search__result-item-icon">
                                    <i class="flaticon-layers m--font-info"></i>
                                </span>
                                <span class="m-list-search__result-item-text t-u">
                                                                    Fiscal Volunteers
                                                                </span>
                            </a>
                            @endcanAccess
                            <a data-table-target='de_vsy' class="m-list-search__result-item pd-5-i c-p">
                                <span class="m-list-search__result-item-icon">
                                    <i class="flaticon-layers m--font-info"></i>
                                </span>
                                <span class="m-list-search__result-item-text t-u">
                                                                    DE VSY
                                                                </span>
                            </a>
                            {{-- <a data-table-target='holiday' class="m-list-search__result-item pd-5-i c-p">
																	<span class="m-list-search__result-item-icon">
																		<i class="flaticon-map-location m--font-success"></i>
																	</span>
                                <span class="m-list-search__result-item-text t-u">
																		Holiday
																	</span>
                            </a> --}}
                        </div>
                    </div>
                    <div class="m-list-search m-t-40">
                        <div class="m-list-search__results data-link">
                            <span class="m-list-search__result-category m-list-search__result-category--first">
																	Finance Reports
																</span>
                            <a data-table-target='raw_query' class="m-list-search__result-item pd-5-i c-p">
																	<span class="m-list-search__result-item-icon">
																		<i class="fa fa-database m--font-danger"></i>
																	</span>
                                <span class="m-list-search__result-item-text t-u">
																		Export Financial Report
																	</span>
                            </a>
                        </div>
                    </div>
                    <div class="m-list-search m-t-40">
                        <div class="m-list-search__results data-link">
                            <span class="m-list-search__result-category m-list-search__result-category--first">
																	SQl Reports
																</span>
                            <a data-table-target='raw_query' class="m-list-search__result-item pd-5-i c-p">
																	<span class="m-list-search__result-item-icon">
																		<i class="fa fa-database m--font-danger"></i>
																	</span>
                                <span class="m-list-search__result-item-text t-u">
																		Create Report
																	</span>
                            </a>
                        </div>
                    </div>
                    <div class="m-list-search m-t-40">
                        <div class="m-list-search__results data-link">
                            <span class="m-list-search__result-category m-list-search__result-category--first">
                                Generate Stipend Report
                            </span>
                            <a data-route="postMailReport" class="m-list-search__result-item pd-5-i c-p">
                                <span class="m-list-search__result-item-icon">
                                    <i class="flaticon-list-2 m--font-info"></i>
                                </span>
                                <span class="m-list-search__result-item-text t-u c-p">
                                    Stipend Template
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Report log List section-->
        <div class="col-8 col-sm-9 col-md-9 reportLoader" id="reportLoader">
            @include($viewLocation.'.rightSection')
        </div>
    </div>
</div>