<style>
.scrollable-table{
    max-height: 400px;
    overflow-y: scroll;
}
.scrollable-table::-webkit-scrollbar{
    width: 5px;
}
.scrollable-table::-webkit-scrollbar-track{
    width: 5px;
}
/* Handle */
.scrollable-table::-webkit-scrollbar-thumb {
    background: #888;
}

/* Handle on hover */
.scrollable-table::-webkit-scrollbar-thumb:hover {
    background: #555;
}
#line-chart-element1 {
        background-color: lightgoldenrodyellow;
        padding: 0px;
    }
/* .fiscal-tabs .tab-content>.tab-pane {
    display: block;
    height: 0;
    overflow: hidden;
}
.fiscal-tabs .tab-content>.tab-pane.active {
    height: 100%;
} */
</style>

<div class="m-portlet">
    <div class="m-portlet__body  m-portlet__body--no-padding no-pd-i">
        <div class="row m-row--no-padding m-row--col-separator-xl">
            <div class="col-xl-8">
                <!--begin:: Widgets/Stats2-1 -->
                <div class="m-widget1" style="padding: 0.1rem 1.1rem;">
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">
                                    Summary
                                </h3>
                            </div>
                            <div class="col m--align-right">
                                <span class="m-widget1__number m--font-brand">
                                    &nbsp;
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="m-widget1__item" style="padding: 0.1rem 0rem !important;">
                        <ul class="nav nav-tabs  m-tabs-line m-tabs-line--success" role="tablist">
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link active" data-toggle="tab" href="#summary_tab1" role="tab">
                                    Organizations
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="summary_tab1" role="tabpanel">
                                @include('default.fgp.dashboard.includes.partialFinance')
                            </div>
                        </div>
                    </div>
                </div>
                <!--end:: Widgets/Stats2-1 -->
            </div>
            <div class="col-xl-4">
                <div class="m-widget1" style="padding: 0.1rem 1.1rem;">
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">
                                    Notifications
                                </h3>
                            </div>
                            <div class="col m--align-right">
                                <span class="m-widget1__number m--font-brand">
                                <button class="btn btn-info m-btn btn-sm m-btn--custom m-btn--icon m-btn--pill" data-modal-route="/addNote" data-backdrop="static" data-keyboard="false">
                                    <i class="la la-plus"></i>Note 
                                </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="m-widget1__item" style="padding: 0.1rem 0rem !important;">
                        <ul class="nav nav-tabs  m-tabs-line m-tabs-line--success" role="tablist">
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_tabs_6_1" role="tab">
                                    Approval 
                                    {{-- <span class="badge badge-pill badge-danger pd-t-4">
                                        
                                        {{auth()->user()->notifications()->count()}}
                                        
                                    </span> --}}
                                </a>
                            </li>
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_tabs_6_2" role="tab">
                                    Reminder <span class="badge badge-pill badge-danger pd-t-4">{{auth()->user()->reminderNotes()->count()}}</span>
                                </a>
                            </li>
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_tabs_6_3" role="tab">
                                    To Do <span class="badge badge-pill badge-danger pd-t-4">{{auth()->user()->todoNotes()->count()}}</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="m_tabs_6_1" role="tabpanel">
                                <div class="m-datatable scrollable-table" id="notifications_table"></div>
                            </div>
                            <div class="tab-pane" id="m_tabs_6_2" role="tabpanel">
                                <div class="m-datatable scrollable-table" id="reminder_table"></div>
                            </div>
                            <div class="tab-pane" id="m_tabs_6_3" role="tabpanel">
                                <div class="m-datatable scrollable-table" id="todo_table"></div>
                            </div>
                        </div>
                        <!-- <div class="row m-row--no-padding align-items-center">
                            <div class="col" style="height: 340px !important;">
                                <div class="m-datatable" id="notifications_table"></div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {

        const listSelect = '.fiscal-tabs .nav-tabs > li';
        $(document).off('click', listSelect).on('click', listSelect, function(e){
            e.preventDefault();

            const anchor = $(this).find('a').addClass('active show');
            
            $(this).siblings('.active').find('a').removeClass('active show')

            let target = anchor.attr('href');

            $(target).addClass('active show');
            $(target).siblings().removeClass('active show')

            if(anchor.attr('data-init') != 'true') return false;
            initVsyChart('.active');
        })

        $('#summaryRangePicker').daterangepicker({
            showCustomRangeLabel: false
        });

        (function({data:calendars}) {
            let dateRange = [], startDate, endDate;
            const ranges = Object.fromEntries(calendars.map(x => {
                let dates = [x.start_date, x.end_date].map(d => moment(new Date(d.split(' ')[0].replace(/-/g, ','))));
                dateRange = dates;
                return [x.calendar_name, dates];
            }));
            if(dateRange.length === 2) {
                [startDate, endDate] = dateRange;
            } else {
                ranges["No range defined"] = [moment().startOf('year'), moment().endOf('year')];
                [startDate, endDate] = [moment().startOf('year'), moment().endOf('year')];
            }
            $('#summaryRangePicker').daterangepicker({
                showCustomRangeLabel: false,
                format: 'mm/dd/yyyy',
                startDate, endDate,
                ranges
            });
            $('#summaryRangePicker').on('apply.daterangepicker', applydaterange);
        })({data: []});


        $('#summaryRangePicker').on('apply.daterangepicker', applydaterange);

        // $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

        // });
    });
    function applydaterange(ev, picker){
            // let startDate = picker.startDate.format('YYYY-MM-DD')
            // let endDate = picker.endDate.format('YYYY-MM-DD')

            let value = $('#summaryRangePicker').val();

            let data = {
                datatable : {
                    query: {
                        date_range: value
                    }
                },
                query : {
                    date_range : value
                },
                dateRange : value
            }

           (function () {
                const data = [{}, {}, {}];
                let lastCount = data.length - 2;
                let newdata = [...data];
                let d = newdata.splice(-2,1)
                // console.log(d, data)
                if(0 in d){
                    d = d[0];
                }  
                $('#totalMonthly').html(`${d.monthly_hrs_actual ? d.monthly_hrs_actual  : "0:00"}</strong>`)


                calcShortFall(data.slice(lastCount, lastCount + 1), data.slice(0, 1));
        
                
            })();

        }
    function initVsyChart(e) {
        (function () {
            console.log('at first')
            const data = [{month: 'April'}, {month: 'July'}, {}, {}];
            const box = $('#line-chart-element1').html('<canvas id="canvas" height="265" width="600"></canvas>');
            const lastCount = data.length - 2;
            let result = data.slice(0, lastCount);
            // console.log('try')
            // calcShortFall(data.slice(lastCount, lastCount + 1), data.slice(0, 1));
            const labels = ["January","February","March","April","May","June","July","August","September","October","November","December"].map(m => m.slice(0, 3));
            const chartData = labels.map(month => {
                const data = result.filter(x => x.month.slice(0, 3) === month);
                if(!data.length){
                    return null;
                }
                return data.length;
            })
            
            const targetData = labels.map(month => {
                const data = result.filter(x => x.month.slice(0, 3) === month);
                if(!data.length){
                    return null;
                }
                return data.length;
            })
            Chart.defaults.line.spanGaps = true;
            var myLineChart = new Chart(document.getElementById('canvas').getContext('2d'), {
                type: 'line',
                data: {
                    labels, // ["January","February","March","April","May","June","July","August","September","October","November","December"]
                    datasets: [
                        {
                            "label":"Actual VSYs achieved","data":chartData,
                            "fill":false,
                            "borderColor":"rgb(255, 0, 255)",
                            "lineTension":0.1
                        },
                        {
                            "label":"Target VSYs","data":targetData,
                            "fill":false,
                            "borderColor":"rgb(0, 0, 0)",
                            "lineTension":0.1
                        }
                    ]
                },
                options: {}
            });
            if (!chartData.length) {
                box.html(`<div class="col text-center">
                    <img src="/images/nodata.png" style="width: 250px; opacity:0.2;" alt="No Data Available" >
                    <h2 class="mt-4" style="opacity: 0.2">No Data Available</h2>
                </div>`);
            }

        })();
    }
    function calcShortFall(last, first)
    {
        if (last && first && 0 in last && 0 in first) {
            let total_vsy_achieved = $(last[0].monthly_vsy_actual).text();
            let annual_vsy_goal = first[0].annual_vsy_goal;
            const shortfall = Number(annual_vsy_goal) - Number(total_vsy_achieved);
            // console.log({annual_vsy_goal, total_vsy_achieved})
            const styles = {
                "color" : shortfall < 0 ? 'red' : shortfall > 0 ? 'green' : '#716aca',
                // "color" : shortfall === 0 ? '#000' : '#000'
            };
            let final = Math.abs(shortfall).toFixed(2);
            final = isNaN(final) ? '-' : final;
            $("#short-fall-value, #shrtFall").text(final).css({cssText: `color: ${styles.color} !important;`});
            // $("#shrtFall").text(Math.abs(shortfall).toFixed(2));
            $('#totalVsy').html(`<strong>${total_vsy_achieved? total_vsy_achieved : "0.00"}</strong>`)
        }
    }

    (function () {
        const data = [{}, {}, {}];
        let lastCount = data.length - 2;
        let newdata = [...data];
        let d = newdata.splice(-2,1)
        // console.log(d, data)
        if(0 in d){
            d = d[0];
        }  
        $('#totalMonthly').html(`${d.monthly_hrs_actual ? d.monthly_hrs_actual  : "0:00"}</strong>`)

        calcShortFall(data.slice(lastCount, lastCount + 1), data.slice(0, 1));

        
    })();

    function changeVsyTab(initvsy = true) {
        @canAccess('tab', 'vsySummary')
        (function() {
            const anchor = $('a[href="#vsySummary"]');
            const vsyAnchor = $('a[href="#finance_tab4"]');
            anchor.closest('ul').prepend(anchor.parent()).prepend(vsyAnchor.parent());
            vsyAnchor.tab('show');
            if(!initvsy) return;
            initVsyChart()
        })();
        @endif
    }
</script>