<div class="m-portlet ">
    <div class="m-portlet__body  m-portlet__body--no-padding p-a-1-i">
        <div class="row m-row--no-padding m-row--col-separator-xl">

            <div class="col-md-12 col-lg-6 col-xl-3">
                <!--begin::Total Profit-->
                <div class="m-widget24">
                    <div class="m-widget24__item">
                        <h4 class="m-widget24__title m-t-10-i">
                            Support
                        </h4>
                        <br>
                        <span class="m-widget24__desc">
                            Total Support
												</span>
                        <span class="m-widget24__stats m--font-brand">
													{{$data['assigned']['total']}}
												</span>
                        <div class="m--space-10"></div>
                        <div class="progress progress-cyan-bg m-progress--sm">
                            <?php
                            $width=0;
                            if($data['assigned']['assign']>0)
                                $width=($data['assigned']['assign']/$data['assigned']['total'])*100;
                            ?>
                            <div class="progress-bar m--bg-brand" role="progressbar" style="width: {{$width}}%;"
                                 aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="m-widget24__change   m--font-brand">
													Assigned {{$data['assigned']['assign']}}
												</span>
                        <span class="m-widget24__number text-cyan">
													Unassigned {{$data['assigned']['unassigned']}}
												</span>
                    </div>
                </div>
                <!--end::Total Profit-->
            </div>

            <div class="col-md-12 col-lg-6 col-xl-3">
                <!--begin::New Feedbacks-->
                <div class="m-widget24">
                    <div class="m-widget24__item">
                        <h4 class="m-widget24__title m-t-10-i">
                            Assign Support
                        </h4>
                        <br>
                        <span class="m-widget24__desc">
                            Total Support Assign
												</span>
                        <span class="m-widget24__stats m--font-success">
													{{$data['support']['total']}}
                        </span>
                        <div class="m--space-10"></div>
                        <div class="progress m--bg-info m-progress--sm">
                            <?php
                            $width=0;
                            if($data['support']['open']>0)
                                $width=($data['support']['open']/$data['support']['total'])*100
                            ?>
                            <div class="progress-bar m--bg-success" role="progressbar" style="width: {{$width}}%;"
                                 aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="m-widget24__change m--font-success">
													Open {{$data['support']['open']}}
												</span>
                        <span class="m-widget24__number m--font-info">
													Closed {{$data['support']['close']}}
												</span>
                    </div>
                </div>
                <!--end::New Feedbacks-->
            </div>
        </div>
    </div>
</div>