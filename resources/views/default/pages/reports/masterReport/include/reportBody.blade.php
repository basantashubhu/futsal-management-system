<div class="m-content" id="reportContent">
    <div class="row">
        <!--List section-->
        <div class="col-4 col-sm-3 col-md-3">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__body">
                    <div class="m-list-search">
                        <div class="m-list-search__results">
                            <span class="m-list-search__result-category m-list-search__result-category--first">
																	Reports
																</span>
                            <a data-table-target='volunteers' class="m-list-search__result-item pd-5-i active_class_row">
																	<span class="m-list-search__result-item-icon">
																		<i class="flaticon-interface-3 m--font-warning"></i>
																	</span>
                                <span class="m-list-search__result-item-text t-u">
																		Volunteer Reports
																	</span>
                            </a>
                            <a data-table-target='timesheets' class="m-list-search__result-item pd-5-i c-p">
																	<span class="m-list-search__result-item-icon">
																		<i class="flaticon-map-location m--font-success"></i>
																	</span>
                                <span class="m-list-search__result-item-text t-u">
																		Time Sheet Report
																	</span>
                            </a>
                            <a data-table-target='sites' class="m-list-search__result-item pd-5-i">
																	<span class="m-list-search__result-item-icon">
																		<i class="socicon-qq m--font-brand"></i>
																	</span>
                                <span class="m-list-search__result-item-text t-u">
																		Sites Report
																	</span>
                            </a>
                            <a data-table-target='holiday' class="m-list-search__result-item pd-5-i">
																	<span class="m-list-search__result-item-icon">
																		<i class="flaticon-line-graph m--font-info"></i>
																	</span>
                                <span class="m-list-search__result-item-text t-u">
																		Holiday Report
																	</span>
                            </a>
                        </div>
                    </div>
                    <div class="m-list-search m-t-40">
                        <div class="m-list-search__results">
                            <span class="m-list-search__result-category m-list-search__result-category--first">
																	Finance Reports
																</span>
                            <a data-table-target='export_Finanicial' class="m-list-search__result-item pd-5-i">
																	<span class="m-list-search__result-item-icon">
																		<i class="fa fa-database m--font-danger"></i>
																	</span>
                                <span class="m-list-search__result-item-text t-u">
																		Export Finanical Report
																	</span>
                            </a>
                        </div>
                    </div>
                    <div class="m-list-search m-t-40">
                        <div class="m-list-search__results">
                            <span class="m-list-search__result-category m-list-search__result-category--first">
																	SQl Reports
																</span>
                            <a data-table-target='raw_query' class="m-list-search__result-item pd-5-i">
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
                        <div class="m-list-search__results">
                            <span class="m-list-search__result-category m-list-search__result-category--first">
                                                                    Generate Pay Stuff
                                                                </span>
                            <a data-table-target='stipend_template' class="m-list-search__result-item pd-5-i">
                                                                    <span class="m-list-search__result-item-icon">
                                                                        <i class="flaticon-list-2 m--font-info"></i>
                                                                    </span>
                                <span class="m-list-search__result-item-text t-u c-p">
                                                                        Stipend Template
                                                                    </span>
                            </a>
                            <a data-table-target='payroll' class="m-list-search__result-item pd-5-i">
                                                                    <span class="m-list-search__result-item-icon">
                                                                        <i class="flaticon-list-2 m--font-info"></i>
                                                                    </span>
                                <span class="m-list-search__result-item-text t-u c-p">
                                                                        Payroll Year to Date Summary
                                                                    </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Report log List section-->
        <div class="col-8 col-sm-9 col-md-9 reportLoader">
            @include($viewLocation.'.rightSection')
        </div>
    </div>
</div>