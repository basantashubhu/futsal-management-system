<script>
    var dateRange=$('#treatmentReportContent').attr('data-range');
    reportDatePicker(dateRange);

    function loadRabiesChart() {
        var totalChart = document.getElementById('rabiesTotal').getContext('2d');
        totalChart.width=500;
        totalChart.height=230;
        var request = {
            url: '/report/treatment/getRabiesChart?dateRange='+dateRange
        };
        ajaxRequest(request, function (response) {
            new Chart(totalChart, {
                // The type of chart we want to create
                type: 'bar',

                // The data for our dataset
                data: {
                    labels: response.data.label,
                    datasets: [
                        {
                            label: "Dog Applied",
                            backgroundColor: 'rgb(52, 191, 163)',
                            borderColor: 'rgb(52, 191, 163)',
                            data: response.data.dogApplied,
                            stack:"1"
                        },
                        {
                            label: "Cat Applied",
                            backgroundColor: 'rgb(54, 163, 247)',
                            borderColor: 'rgb(54, 163, 247)',
                            data: response.data.catApplied,
                            stack:"1"
                        },
                        {
                            label: "Dog Performed",
                            backgroundColor: 'rgb(232, 62, 140)',
                            borderColor: 'rgb(232, 62, 140)',
                            data: response.data.dogPerformed,
                            stack:"2"
                        },
                        {
                            label: "Cat Performed",
                            backgroundColor: 'rgb(253, 126, 20)',
                            borderColor: 'rgb(253, 126, 20)',
                            data: response.data.catPerformed,
                            stack:"2"
                        },

                    ]
                },
                options: {
                    barPercentage:0.5,
//                    scales: {
//                        xAxes: [{
//                            stacked: true
//                        }],
//                        yAxes: [{
//                            stacked: true
//                        }]
//                    }
                }

            });
        });
    }
    loadRabiesChart();

    function loadSurgeryChart() {
        var totalChart = document.getElementById('surgeryTotal').getContext('2d');
        totalChart.width=500;
        totalChart.height=230;

        var request = {
            url: '/report/treatment/getSurgeryChart?dateRange='+dateRange
        };

        ajaxRequest(request, function (response) {
            new Chart(totalChart, {
                // The type of chart we want to create
                type: 'bar',

                // The data for our dataset
                data: {
                    labels: response.data.label,
                    datasets: [
                        {
                            label: "Dog Applied",
                            backgroundColor: 'rgb(52, 191, 163)',
                            borderColor: 'rgb(52, 191, 163)',
                            data: response.data.dogApplied,
                            stack:"1"
                        },
                        {
                            label: "Cat Applied",
                            backgroundColor: 'rgb(54, 163, 247)',
                            borderColor: 'rgb(54, 163, 247)',
                            data: response.data.catApplied,
                            stack:"1"
                        },
                        {
                            label: "Dog Performed",
                            backgroundColor: 'rgb(232, 62, 140)',
                            borderColor: 'rgb(232, 62, 140)',
                            data: response.data.dogPerformed,
                            stack:"2"
                        },
                        {
                            label: "Cat Performed",
                            backgroundColor: 'rgb(253, 126, 20)',
                            borderColor: 'rgb(253, 126, 20)',
                            data: response.data.catPerformed,
                            stack:"2"
                        },

                    ]
                },
                options: {
                    barPercentage:0.5,
                    scales: {
                        xAxes: [{
                            stacked: true
                        }],
                        yAxes: [{
                            stacked: true
                        }]
                    }
                }

            });
        });
    }
    loadSurgeryChart()

    $('.m_report_date_filter').on('apply.daterangepicker', function (ev, picker) {
        var dateRange = picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY');
        var request = {
            url: 'report/treatment/?dateRange='+dateRange
        };
        ajaxRequest(request, function (response) {
            $('#contentHolder').empty();
            $('#contentHolder').html('');
            $("#contentHolder").html(response.data)
        });
    });

    $('.m_report_date_filter').on('cancel.daterangepicker', function (ev, picker) {
        var request = {
            url: 'report/treatment/'
        };
        ajaxRequest(request, function (response) {
            $('#contentHolder').empty();
            $('#contentHolder').html('');
            $("#contentHolder").html(response.data)
        });
    });
</script>