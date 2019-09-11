<script>
var dateRange;
    $(function () {
        dateRange=$('#petReportContent').attr('data-range');
        reportDatePicker(dateRange);
        loadTotalChart();
        loadIEChart();
        loadNPChart();
    });


$('.m_report_date_filter').on('apply.daterangepicker', function (ev, picker) {
    var dateRange = picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY');
    var request = {
        url: 'reports/pet/?dateRange='+dateRange
    };
    ajaxRequest(request, function (response) {
        $('#contentHolder').empty();
        $('#contentHolder').html('');
        $("#contentHolder").html(response.data)
    });
});

$('.m_report_date_filter').on('cancel.daterangepicker', function (ev, picker) {
    var dateRange = picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY');
    var request = {
        url: 'reports/pet/'
    };
    ajaxRequest(request, function (response) {
        $('#contentHolder').empty();
        $('#contentHolder').html('');
        $("#contentHolder").html(response.data)
    });
});

function loadTotalChart() {
        var totalChart = document.getElementById('totalSurgery').getContext('2d');
        totalChart.width=500;
        totalChart.height=230;
        var request = {
            url: '/reports/pet/getTotalChart?dateRange='+dateRange
        };
        ajaxRequest(request, function (response) {
            new Chart(totalChart,{
                type: 'pie',
                data: {
                    labels: ['Non Profit Rate','For Profit Rate'],
                    datasets: [{
                        backgroundColor: ["#dc3545", "#007bff"],
                        data: response.data.data
                    }]
                },
                options:{
                    height:230,
                    width:500,
                }
            });
        });
}

function loadIEChart() {
    var IEChart = document.getElementById('totalIE').getContext('2d');
    var request = {
        url: '/reports/pet/getIEChart?dateRange='+dateRange
    };
    ajaxRequest(request, function (response) {
        new Chart(IEChart,{
            type: 'pie',
            data: {
                labels: ['Non Profit Rate','For Profit Rate'],
                datasets: [{
                    backgroundColor: ["#dc3545", "#007bff"],
                    data: response.data.data
                }]
            },
            options:{
                animation: {
                    animateScale: true,
                }
            }
        });
    });
}

function loadNPChart() {
    var NPChart = document.getElementById('totalNP').getContext('2d');
    var request = {
        url: '/reports/pet/getNPChart?dateRange='+dateRange
    };
    ajaxRequest(request, function (response) {
        new Chart(NPChart,{
            type: 'pie',
            data: {
                labels: ['Non Profit Rate','For Profit Rate'],
                datasets: [{
                    backgroundColor: ["#dc3545", "#007bff"],
                    data: response.data.data
                }]
            },
            options:{
            }
        });
    });
}


</script>