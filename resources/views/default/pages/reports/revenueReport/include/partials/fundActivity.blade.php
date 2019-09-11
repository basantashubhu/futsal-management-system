<!--begin:: Widgets/Support Requests-->
<div class="m-portlet  m-portlet--full-height with-border">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    Fund Activity - To Date
                </h3>
            </div>

            <div class="col-auto no-pd float-right m-t-n-40">
                <div class="date_filter">
                                    <span class="m-subheader__daterange m_report_date_filter fund_activity" id="m_report_date_filter">
                                       <span class="m-subheader__daterange-label">
                                            <span class="m-subheader__daterange-date m--font-brand"></span>
                                           <input type="hidden" name="dateRange" id="statement"
                                                  class="data-range-input">
                                       </span>
                                       <a class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                                            <i class="la la-angle-down"></i>
                                       </a>
                                   </span>
                </div>
            </div>

        </div>
    </div>
    <div class="m-portlet__body">
        <div class="m-widget16">
            <div class="row">


                <div class="col-md-6">
                    <div class="m-widget16__head">
                        <div class="m-widget16__item">
															<span class="m-widget16__sceduled  m--font-boldest">
																<strong>Type</strong>
															</span>
                            <span class="m-widget16__amount m--align-right  m--font-boldest">
																<strong>Amount</strong>
															</span>
                        </div>
                    </div>
                    <div class="m-widget16__body">
                    @foreach($fundActivity as $key=>$value)
                        <!--begin::widget item-->
                            <div class="m-widget16__item">
                                <?php
                                $class = '';
                                if ($key == 'Rabies Surcharge Received')
                                    $class = 'm--font-success';
                                elseif ($key == 'Copay Received')
                                    $class = 'm--font-primary';
                                elseif ($key == 'IE Invoiced')
                                    $class = 'm--font-brand';
                                elseif ($key == 'NP Invoiced')
                                    $class = 'm--font-info';
                                elseif ($key == 'Remaining Balance')
                                    $class = 'm--font-warning';
                                ?>
                                <span class="m-widget16__date m--font-bolder {{$class}}">
																{{$key}}
															</span>
                                <span class="m-widget16__price m--align-right">
																${{number_format($value, 2)}}
															</span>
                            </div>
                            <!--end::widget item-->
                        @endforeach
                    </div>
                </div>

                <div class="col-md-6">
                    <div id="fundActivity_chart" style="height: 270px" data-dateRange="{{isset($dateRange)?$dateRange:''}}">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end:: Widgets/Support Requests-->
<script>
    $(document).ready(function () {
        var dateRange=$('#revenue_chart').attr('data-dateRange');
        reportDatePicker(dateRange,'.fund_activity');
        if( typeof fundActivity!='undefined')
        {
            if(dateRange)
                fundActivity(dateRange);
        }
    });
    $('.fund_activity').on('apply.daterangepicker', function (ev, picker) {
        var dateRange = picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY');
        reloadPartial('/revenue/fundActivity?dateRange=' + dateRange, '.fundActivityContainer')
    });


</script>