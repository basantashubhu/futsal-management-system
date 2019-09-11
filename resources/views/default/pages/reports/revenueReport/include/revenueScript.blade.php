<script>


    var fundStandingChart = function (dateRange='') {
        if ($('#revenue_chart').length == 0) {
            return;
        }
        ajaxRequest({
            url: 'revenue/chart?dateRange='+dateRange
        }, function (response) {
            var totalRevenue = response.data;
            var appchart = Morris.Donut({
                element: 'revenue_chart',
                data: totalRevenue,
                colors: [
                    mUtil.getColor('primary'),
                    mUtil.getColor('success'),
                    mUtil.getColor('info'),
                    mUtil.getColor('danger')
                ],
                resize: true,
                formatter: function (x) {
                    return '$' + x.toFixed(2)
                }
            });
            appchart.select(0);
        });
    };
    fundStandingChart();


    var fundActivity = function (dateRange='') {
        if ($('#fundActivity_chart').length == 0) {
            return;
        }
        ajaxRequest({
            url: 'revenue/fundChart??dateRange='+dateRange
        }, function (response) {
            var totalRevenue = response.data;
            var appchart = Morris.Donut({
                element: 'fundActivity_chart',
                data: totalRevenue,
                colors: [
                    mUtil.getColor('primary'),
                    mUtil.getColor('success'),
                    mUtil.getColor('brand'),
                    mUtil.getColor('info'),
                    mUtil.getColor('warning')
                ],
                resize: true,
                formatter: function (x) {
                    return '$' + x.toFixed(2)
                }
            });
            appchart.select(0);
        });
    };
    fundActivity();


    ajaxRequest({
        url: 'revenue/rabiesChart'
    }, function (response) {
        if (response.data) {
            var rabiesBarChart = document.getElementById('rabiesBarChart').getContext('2d');
            var chart = new Chart(rabiesBarChart, {
                // The type of chart we want to create
                type: 'bar',

                // The data for our dataset
                data: {
                    labels: response.data['date'],
                    datasets: [
                        {
                            label: "NP",
                            backgroundColor: 'rgb(54, 163, 247)',
                            borderColor: 'rgb(54, 163, 247)',
                            data: response.data['np'],
                        }, {
                            label: "IE",
                            backgroundColor: 'rgb(52, 191, 163)',
                            borderColor: 'rgb(52, 191, 163)',
                            data: response.data['ie'],
                        },
                    ]
                },

                // Configuration options go here
                options: {
                    scales: {
                        xAxes: [{
                            stacked: true
                        }],
                        yAxes: [{
                            stacked: true
                        }]
                    },
                    legend:{
                        display:false
                    }
                }
            });
        }

    });

    ajaxRequest({
        url: 'revenue/surgeryChart'
    }, function (response) {
        if (response.data) {
            var surgeryBarChart = document.getElementById('surgeryBarChart').getContext('2d');
            var chart = new Chart(surgeryBarChart, {
                // The type of chart we want to create
                type: 'bar',

                // The data for our dataset
                data: {
                    labels: response.data['date'],
                    datasets: [
                        {
                            label: "NP",
                            backgroundColor: 'rgb(54, 163, 247)',
                            borderColor: 'rgb(23, 162, 184)',
                            data: response.data['np'],
                        },
                        {
                            label: "IE",
                            backgroundColor: 'rgb(52, 191, 163)',
                            borderColor: 'rgb(88, 103, 221)',
                            data: response.data['ie'],
                        },
                    ]
                },

                // Configuration options go here
                options: {
                    scales: {
                        xAxes: [{
                            stacked: true
                        }],
                        yAxes: [{
                            stacked: true
                        }]
                    },
                    legend:{
                        display:false
                    }
                }
            });
        }

    });





    function reloadPartial(url, container) {
        var request = {
            url: url
        };
        ajaxRequest(request, function (response) {
            $(container).empty();
            $(container).html('');
            $(container).html(response.data)
        });
    }
</script>