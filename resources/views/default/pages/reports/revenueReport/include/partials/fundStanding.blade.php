<!--begin:: Widgets/Support Cases-->
<div class="m-portlet  m-portlet--full-height with-border">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    Fund Standing
                </h3>
            </div>



            <div class="col-auto no-pd float-right m-t-n-40">
                <form class="d-ib reportSearchForm">
                <div class="date_filter float-left pd-r-10">
                                    <span class="m-subheader__daterange m_report_date_filter fund_standing" id="m_report_date_filter">
                                       <span class="m-subheader__daterange-label">
                                            <span class="m-subheader__daterange-date m--font-brand"></span>
                                           <input type="hidden" name="dateRange" id="statement" class="data-range-input">
                                       </span>
                                       <a class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                                            <i class="la la-angle-down"></i>
                                       </a>
                                   </span>
                </div>
                </form>
                <div class="m-btn-group m-btn-group--pill btn-group m-t-n-5" role="group"
                     aria-label="Button group with nested dropdown">
                    <div class="m-btn-group btn-group" role="group">
                        <button id="ietableExport" type="button"
                                class="btn btn-warning btn-sm m-btn m-btn--pill-last br-60 dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Export as
                        </button>
                        <div class="dropdown-menu" aria-labelledby="ietableExport"
                             x-placement="bottom-start">
                            <button class="c-p dropdown-item exportReportData" data-export-type="csv"
                                    data-target="fund">
                                CSV
                            </button>
                            <button class="c-p dropdown-item exportReportData" data-export-type="json"
                                    data-target="fund">
                                JSON
                            </button>
                            <button class="c-p dropdown-item exportReportData" data-export-type="pdf"
                                    data-target="fund">
                                PDF
                            </button>
                            {{--<button class="c-p dropdown-item" id="sendEmail"--}}
                            {{--data-modal-route="sendEmailGlobal?table=ledger">--}}
                            {{--Send Email--}}
                            {{--</button>--}}
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
    <div class="m-portlet__body">
        <div class="m-widget16">
            <div class="row">
                <div class="col-md-5">
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
                    @foreach($fundStanding as $key=>$value)
                        <!--begin::widget item-->
                            <div class="m-widget16__item">
                                <?php
                                $class = '';
                                if ($key == 'NP Total Contingent')
                                    $class = 'm--font-brand';
                                elseif ($key == 'IE Total Contingent')
                                    $class = 'm--font-success';
                                elseif ($key == 'Remaning Balance')
                                    $class = 'm--font-info';
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
                <div class="col-md-7">
                    <div id="revenue_chart" style="height: 270px" data-dateRange="{{isset($dateRange)?$dateRange:''}}">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end:: Widgets/Support Stats-->
<script>
    $(document).ready(function () {
        var dateRange=$('#revenue_chart').attr('data-dateRange');
        reportDatePicker(dateRange,'.fund_standing');
        if( typeof fundStandingChart!='undefined')
        {
            if(dateRange)
                fundStandingChart(dateRange);
        }
    });

    $('.fund_standing').on('apply.daterangepicker', function (ev, picker) {
        var dateRange = picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY');
        $(document).find('.data-range-input').val(dateRange);
        reloadPartial('/revenue/fundStanding?dateRange=' + dateRange, '.fundStandingContainer');
    });

</script>