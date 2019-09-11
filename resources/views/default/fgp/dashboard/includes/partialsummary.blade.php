@if(true)
<div class="m-widget14" style="padding: 1rem;">
    <div class="row  align-items-center">
        <div class="col">
            <div id="time_type_chart" class="m-widget14__chart1" style="height: 180px"></div>
        </div>
        <div class="col">
            <div class="m-widget14__legends" id="timeTypeLabel" style="margin-left: -20px;">

            </div>

        </div>
    </div>
    <div class="m-widget14__header" style="text-align: center; padding-top: 20px;">
        <h3 class="m-widget14__title" id="period_number">

        </h3>
        @if(isset($finance->stipend_period))
        <span class="m-widget14__desc" id="datePeriod" style="margin-right: 15px;">
            Period({{$finance->stipend_period->period_no}}): {{date('m/d', strtotime($finance->stipend_period->start_date))}} - {{date('m/d/Y', strtotime($finance->stipend_period->end_date))}}
        </span> &nbsp;
        @endif
        <span class="m-widget14__desc" id="totalVolunteerType" style="margin-right: 15px;">
            Total
        </span>

        <span class="m-widget14__desc" id="totalSite" style="margin-right: 15px;">
            Total
        </span>

        <span class="m-widget14__desc" id="totalTimeType">
            Total
        </span>
    </div>
</div>
@else
<div class="col text-center">
    <img src="{{'images/nodata.png'}}" style="width: 250px; opacity:0.2;" alt="No Data Available" >
    <h2 class="mt-4" style="opacity: 0.2">No Data Available</h2>
</div>
@endif
<script>
    function changeVsyTab(vsyinit = true) {
        console.log('chart');
        @canAccess('tab', 'vsySummary')
        (function() {
            const anchor = $('a[href="#vsySummary"]');
            const vsyAnchor = $('a[href="#finance_tab4"]');
            anchor.closest('ul').prepend(anchor.parent()).prepend(vsyAnchor.parent());
            vsyAnchor.tab('show');
            if(!vsyinit) return;
            initVsyChart()
        })();
        @endif
    }
var timeTypeChange = function (period_id) {
    if ($('#time_type_chart').length == 0) {
        return changeVsyTab(false);
    }

    (function (response) {
        // console.log(response)
        let chartData = response.data;
        if (!chartData) {
            let noDataImage =  `<img src="{{'images/nodata.png'}}" style="width: 250px; opacity:0.2;" alt="No Data Available" >`;
            $('#time_type_chart').empty().append(noDataImage);
            return changeVsyTab(false);
        }
// console.log(response)
        let stipendChartData = [];
        let chartColors = [];
        let labels = '';

        $.each(chartData.items, function (idx, item) {
            if (Number(item.value) > 0) {
                labels += `<div class="m-widget14__legend" style="white-space:nowrap;">
                    <span class="m-widget14__legend-bullet m--bg-${item.color}"
                        style="width: 1rem;"></span>
                        <span class="m-widget14__legend-text c-p t-u-${item.color.charAt(0)}">
                             ${Number(item.value).formatHrs()} Hours ${item.label}
                        </span>
                    </div>`;
            }
            stipendChartData.push(item);
            chartColors.push(mUtil.getColor(item.color));
            delete item.color;
        });

        $('#totalTimeType').text("Total: " + chartData.meta.total + ' Hours');
        $('#totalVolunteerType').text("Volunteers: " + chartData.meta.volunteer);
        $('#totalSite').text("Sites: " + chartData.meta.site);
        $('#timeTypeLabel').html(labels);
        // return;
        // console.log(stipendChartData, chartColors)
        let appChart = Morris.Donut({
            element: 'time_type_chart',
            data: stipendChartData,
            colors: chartColors,
            formatter: v => v.toString().formatHrs()
        });
        appChart.select(0);
        
        changeVsyTab();
    })({data: {items: [], meta: {}}});
};


timeTypeChange('@if(isset($finance->period_unq_id)){{$finance->period_unq_id}}@endif');
</script>