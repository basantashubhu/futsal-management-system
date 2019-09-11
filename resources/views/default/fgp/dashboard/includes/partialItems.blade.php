@if(isset($finance->stipend_period))
<div class="m-widget1" style="padding: 1rem;">
    <div class="m-widget1__header">
        <h3 class="m-widget1__title">
        </h3>
        <span class="m-widget1__desc" id="totalItemType">
            Total
        </span>
    </div>
    <div class="m-widget1__body row  align-items-center">
    <div class="col">
            <canvas id="myChart" style="height: 120px; width: 120px;"></canvas>
        </div>
        <div class="col">
            <div class="m-widget14__legends" id="itemTypeLabel">
                <div class="m-widget14__legend">
                    <span class="m-widget14__legend-bullet m--bg-danger"
                        style="width: 1rem;">&nbsp;</span>
                    <span class="m-widget14__legend-text c-p upadateTableApp t-u" id="Travel"
                        data-value="Mileage">
                    </span>
                </div>
                <div class="m-widget14__legend">
                    <span class="m-widget14__legend-bullet m--bg-info"
                        style="width: 1rem;">&nbsp;</span>
                    <span class="m-widget14__legend-text c-p upadateTableApp t-u" id="Meals"
                        data-value="Food">
                    </span>
                </div><br>
            </div>
        </div>

    </div>
</div>
@else
    <div class="col text-center">
        <img src="{{'images/nodata.png'}}" style="width: 250px; opacity:0.2;" alt="No Data Available" >
        <h2 class="mt-4" style="opacity: 0.2">No Data Available</h2>
        {{--    <div class="" style="text-align: center;"><i class="la la-exclamation-circle" style="font-size: 10rem; opacity: 0.2;"></i></div>--}}
        {{--    <div class="" style="text-align: center;"><p style="font-size: 3rem; opacity: 0.2;">No Data Available</p></div>--}}
    </div>
{{--<div class="col">--}}
{{--    <div class="" style="text-align: center;"><i class="la la-exclamation-circle" style="font-size: 10rem; opacity: 0.2;"></i></div>--}}
{{--    <div class="" style="text-align: center;"><p style="font-size: 3rem; opacity: 0.2;">No Data Available</p></div>--}}
{{--</div>--}}
@endif
<script>
function timeTypeChange(period_id='') {
    if ($('#myChart').length == 0) {
        return;
    }
    (function(response){
        let chartData = response.data;
        if (!chartData) return;

        let stipendCharData = [];
        let stipendChartLabel = [];
        let ctx = $('#myChart');
        $.each(chartData.items, function (idx, item) {
            stipendCharData[idx] = item.value;
            stipendChartLabel[idx] = item.label;
            $('#itemTypeLabel').find('span[data-value='+item.label+']').text('$ '+Number(item.value).toFixed(2)+' '+item.title);
        });
        $('#totalItemType').text("Total : $ " + Number(chartData.meta.total).toFixed(2));
        // console.log(stipendCharData, stipendChartLabel)
        let myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: stipendChartLabel,
                datasets: [{
                    data: stipendCharData,
                    backgroundColor: [
                        'rgba(244, 81, 108, 1)',
                        'rgba(54, 163, 247, 1)',
                    ]
                }]
            },
            options: {
                legend: {
                    display: false,
                }
            }
        });
    });
}
// timeTypeChange1();
timeTypeChange('@if(isset($finance->period_unq_id)){{$finance->period_unq_id}}@endif');
</script>