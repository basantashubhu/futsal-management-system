<div class="m-portlet ">
    <div class="m-portlet__body  m-portlet__body--no-padding p-a-1-i">
        <div class="row m-row--no-padding m-row--col-separator-xl">
            <div class="col-md-12 col-lg-6 col-xl-3">
                <!--begin::New Feedbacks-->
                <div class="m-widget24">
                    <div class="m-widget24__item">
                        <h4 class="m-widget24__title m-t-10-i">
                            Certificates
                        </h4>
                        <br>
                        <span class="m-widget24__desc">
                            # of Certificates Generated
												</span>
                        <span class="m-widget24__stats m--font-success">
													{{$report['certificates']['total']}}
												</span>
                        <div class="m--space-10"></div>
                        <div class="progress m--bg-info m-progress--sm">
                            <?php
                            $width=0;
                            if($report['certificates']['dog']>0)
                                $width=($report['certificates']['dog']/$report['certificates']['total'])*100
                            ?>
                            <div class="progress-bar m--bg-success" role="progressbar" style="width: {{$width}}%;"
                                 aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="m-widget24__change m--font-success">
													Dogs {{$report['certificates']['dog']}}
												</span>
                        <span class="m-widget24__number m--font-info">
													Cats {{$report['certificates']['cat']}}
												</span>
                    </div>
                </div>
                <!--end::New Feedbacks-->
            </div>

            <div class="col-md-12 col-lg-6 col-xl-3">
                <!--begin::Total Profit-->
                <div class="m-widget24">
                    <div class="m-widget24__item">
                        <h4 class="m-widget24__title m-t-10-i">
                            Invoice
                        </h4>
                        <br>
                        <span class="m-widget24__desc">
                            Total Contingent
												</span>
                        <span class="m-widget24__stats m--font-brand">
													${{number_format($report['total_invoice']['total'],2)}}
												</span>
                        <div class="m--space-10"></div>
                        <div class="progress progress-cyan-bg m-progress--sm">
                            <?php
                            $width=0;
                            if($report['total_invoice']['paid']>0)
                                $width=($report['total_invoice']['paid']/$report['total_invoice']['total'])*100;
                            ?>
                            <div class="progress-bar m--bg-brand" role="progressbar" style="width: {{$width}}%;"
                                 aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="m-widget24__change   m--font-brand">
													Paid ${{number_format($report['total_invoice']['paid'],2)}}
												</span>
                        <span class="m-widget24__number text-cyan">
													Unpaid ${{number_format($report['total_invoice']['unpaid'], 2)}}
												</span>
                    </div>
                </div>
                <!--end::Total Profit-->
            </div>

            <div class="col-md-12 col-lg-6 col-xl-3">
                <!--begin::New Orders-->
                <div class="m-widget24">
                    <div class="m-widget24__item">
                        <h4 class="m-widget24__title m-t-10-i">
                            Service Performed
                        </h4>
                        <br>
                        <span class="m-widget24__desc">
                           # of Service
												</span>
                        <span class="m-widget24__stats m--font-warning">
													{{$report['treatments']['total']}}
												</span>
                        <div class="m--space-10"></div>
                        <div class="progress m--bg-fill-danger m-progress--sm">
                            <?php
                            $width=0;
                            if($report['treatments']['treated']>0)
                                $width=($report['treatments']['treated']/$report['treatments']['total'])*100
                            ?>
                            <div class="progress-bar m--bg-warning" role="progressbar" style="width: {{$width}}%;"
                                 aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="m-widget24__change m--font-warning">
													Complete {{$report['treatments']['treated']}}
												</span>
                        <span class="m-widget24__number m--font-danger">
													Remaining {{$report['treatments']['untreated']}}
												</span>
                    </div>
                </div>
                <!--end::New Orders-->
            </div>
            <div class="col-md-12 col-lg-6 col-xl-3">
                <!--begin::New Users-->
                <div class="m-widget24">
                    <div class="m-widget24__item">
                        <h4 class="m-widget24__title m-t-10-i">
                           Applications
                        </h4>
                        <br>
                        <span class="m-widget24__desc">
                            No of Applications
												</span>
                        <span class="m-widget24__stats m--font-info">
													{{$report['application']['total']}}
												</span>
                        <div class="m--space-10"></div>
                        <div class="progress m--bg-success m-progress--sm">
                            <?php
                            $width=0;
                            if($report['application']['IE']>0)
                                $width=($report['application']['IE']/$report['application']['total'])*100
                            ?>
                            <div class="progress-bar m--bg-info" role="progressbar" style="width: {{$width}}%;"
                                 aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="m-widget24__change  m--font-info">
													IE {{$report['application']['IE']}}
												</span>
                        <span class="m-widget24__number m--font-success">
													NP {{$report['application']['NP']}}
												</span>
                    </div>
                </div>
                <!--end::New Users-->
            </div>
        </div>
    </div>
</div>