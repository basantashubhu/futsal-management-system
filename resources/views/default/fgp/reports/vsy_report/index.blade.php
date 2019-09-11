<?php

?>
<style>
    #short-fall table th {
        width: 12%;
    }
    .vsyButtons {
        display: block;
        width: 100px;
    }
    #line-chart-element {
        background-color: lightgoldenrodyellow;
        padding: 10px;
    }
</style>
<div class="m-subheader">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                DE VSY Reports
            </h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="javascript:void(0)" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la flaticon-graph"></i>
                    </a>
                </li>
                <li class="m-nav__separator">
                    -
                </li>
                <li class="m-nav__item">
                    <a data-route="fgp_reports/vsy" class="m-nav__link">
                        <span class="m-nav__link-text">
                            DE VSY Reports
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="m-content" id="reportContent">
    <div class="m-portlet m-portlet--mobile with-border">
        <div class="m-portlet__head">
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav" style="width: 100%">
                    <li class="m-portlet__nav-item">
                        <div class="m-form m-form--label-align-right row justify-center">
                            <div class="form-group m-form__group d-flex col-8 justify-content-between toolbar ">
                                <form class="form form-inline" id="filter_vsy_report" style="order: -1">
                                    <div class="col-auto m-b-10 px-0">
                                        <div class="m-form__group m-form__group--inline pill-style" id="viewTsFilter">
                                            <div class="m-form__label left">
                                                <label class="m-label m-label--single" for="vsy_date_range">
                                                    Date&nbsp;Rage
                                                </label>
                                            </div>
                                            <div class="m-form__control custom-selecter-btn">
                                                <input type="text" name="date_range" class="form-control form-control-sm btn-redius" id="vsy_date_range">
                                            </div>
                                        </div>
                                        <div class="d-md-none m--margin-bottom-10"></div>
                                    </div>
                                    <div class="col-auto hidden">
                                            <button type="button" class="btn btn-default vsyButtons mb-3 print"
                                                    data-export-type="csv">
                                                Print
                                            </button>
                                            {{-- <button type="button" class="btn btn-default vsyButtons mb-3 copy"
                                                    data-export-type="json">
                                                Copy
                                            </button> --}}
                                            <button type="button" class="btn btn-default vsyButtons mb-3 download"
                                                    data-export-type="pdf">
                                                Download
                                            </button>
                                    </div>
                                    {{-- <div class="col-auto m-b-10">
                                        <div class="m-form__group m-form__group--inline pill-style" id="viewTsFilter">
                                            <div class="m-form__label left">
                                                <label class="m-label m-label--single" for="fil_year">
                                                    Year
                                                </label>
                                            </div>
                                            <div class="m-form__control custom-selecter-btn">
                                                <input type="text" name="filter_year" class="form-control form-control-sm btn-redius" id="fil_year" value="{{ date('Y') }}">
                                            </div>
                                        </div>
                                        <div class="d-md-none m--margin-bottom-10"></div>
                                    </div>
                                    <div class="col-auto m-b-10">
                                        <div class="m-form__group m-form__group--inline pill-style" id="viewTsFilter">
                                            <div class="m-form__label left">
                                                <label class="m-label m-label--single" for="fil_months">
                                                    Months
                                                </label>
                                            </div>
                                            <div class="m-form__control custom-selecter-btn">
                                                <select name="filter_months[]" multiple id="fil_months" title="Select" data-style="btn-redius">
                                                    @foreach(range(1, 12) as $m)
                                                        <option value="{{ $m }}">{{ date('M', strtotime("$m/15/2019")) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="d-md-none m--margin-bottom-10"></div>
                                    </div> --}}
                                </form>
                                <div class="d-flex justify-content-end" style="flex:1">
                                    <div class="m-btn-group m-btn-group--pill btn-group order-2" style="display: inline-block"
                                         role="group"
                                         aria-label="Button group with nested dropdown">
                                        <div class="m-btn-group btn-group" role="group">
                                            <button id="ietableExport" type="button"
                                                    class="btn btn-warning btn-sm m-btn m-btn--pill-last br-60 dropdown-toggle showInBig"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                Export as
                                            </button>
                                            <button id="ietableExport" type="button"
                                                    class="btn btn-warning btn-sm m-btn m-btn--pill-last br-60 dropdown-toggle showInMedium"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                <i class="la la-bars"></i>
                                            </button>
                                            <div class="dropdown-menu"
                                                 aria-labelledby="ietableExport"
                                                 x-placement="bottom-start">
                                                <button class="c-p dropdown-item vsy_report_export"
                                                        data-export-type="csv">
                                                    CSV
                                                </button>
                                                <button class="c-p dropdown-item vsy_report_export"
                                                        data-export-type="json">
                                                    JSON
                                                </button>
                                                <button class="c-p dropdown-item vsy_report_export"
                                                        data-export-type="pdf">
                                                    PDF
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-default m-btn--pill order-1 mr-5 vsyButtons mb-3 download"
                                            data-export-type="pdf">
                                        Download
                                    </button>
                                    <button type="button" class="btn btn-sm m-btn--pill btn-default vsyButtons mr-5 order-0 mb-3 print"
                                                    data-export-type="csv">
                                                Print
                                            </button>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="m-portlet__body">
            <div class="row justify-center">
                <div class="col-xl-8 mb-4">
                    <div id="vsy_report_container" class="table-responsive">
                        <table id="vsy_report_table"></table>
                    </div>
                    <div id="short-fall">
                        <br>
                        <table style="width: 200px; margin: auto;">
                            <tr>
                                <th>Shortfall :</th>
                                <th id="short-fall-value" class="text-center p-2">0</th>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <div class="col-md-8">
                    <div class="row justify-content-center">
                        <div class="col-sm-12">
                            <div id="line-chart-element" style="width: 700px;margin: auto;">
                                <canvas id="canvas" height="300" width="700"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function calcShortFall(last, first)
    {
        if (last && first && 0 in last && 0 in first) {
            let total_vsy_achieved = $(last[0].monthly_vsy_actual).text();
            let annual_vsy_goal = first[0].annual_vsy_goal;
            const shortfall = Number(annual_vsy_goal) - Number(total_vsy_achieved);
            const styles = {
                "background-color" : shortfall < 0 ? 'red' : shortfall > 0 ? 'green' : '#fff',
                "color" : shortfall === 0 ? '#000' : '#fff'
            };
            $("#short-fall-value").text(Math.abs(shortfall).toFixed(2)).css(styles);
        }
    }

    $(function (Table) {

        Table.on('m-datatable--on-ajax-done', function (e, data) {
            const box = $('#line-chart-element').html('<canvas id="canvas" height="300" width="600"></canvas>');
            const lastCount = data.length - 2;
            let result = data.slice(0, lastCount);
            calcShortFall(data.slice(lastCount, lastCount + 1), data.slice(0, 1));

           /*  const labels = result.map(x => x.month);
            const chartData = result.map(x => (Number(x.cumulative_hrs_actual) / ( x.unit || 1044 )).toFixed(2))
            const targetData = result.map(x => (Number(x.cumulative_hrs_goal) / ( x.unit || 1044 )).toFixed(2)) */
            const labels = ["January","February","March","April","May","June","July","August","September","October","November","December"].map(m => m.slice(0, 3));
            const chartData = labels.map(month => {
            const data = result.filter(x => x.month.slice(0, 3) === month);
                if(!data.length){
                    return null;
                }
                return (Number(data[0].cumulative_hrs_actual) / ( data[0].unit || 1044 )).toFixed(2);
            })
            
            const targetData = labels.map(month => {
                const data = result.filter(x => x.month.slice(0, 3) === month);
                if(!data.length){
                    return null;
                }
                return (Number(data[0].cumulative_hrs_goal) / ( data[0].unit || 1044 )).toFixed(2);
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
            // return;

            const months = result.map(src => src.month_no);
            let obj = 0 in data ? data[0] : {};
            if (obj.year) {
                $('.vsy_report_export').attr('data-months', months.join(',')).attr('data-year', obj.year);
                // Table.find('thead tr th:first-child').text(obj.year+'/Month');
            } else {
                $('.vsy_report_export').attr('data-months', '').attr('data-year', '');
                // Table.find('thead tr th:first-child').text('Month');
            }
            if (!chartData.length) {
                box.html(`<div class="" style="text-align: center;">
                        <i class="la la-exclamation-circle" style="font-size: 10rem; opacity: 0.2;"></i>
                        </div>
                        <div class="" style="text-align: center;">
                        <p style="font-size: 3rem; opacity: 0.2;">No Data Available</p>
                        </div>`);
            }
        });

        const VSYReport = Table.mDatatable({
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: '/fgp_reports/vsy/getData',
                        params: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            dateRange: '{{ dateRange('this year') }}'
                        }
                    },
                },
                saveState: false,
                serverFiltering: true,
            },
            sortable: true,
            pagination: false,
            columns: [
                {title: 'Month', field: 'month', width: 100},
                {title: 'Cumulative<br> Hours<br> Actual', field: 'cumulative_hrs_actual', textAlign: 'center',
                    template({cumulative_hrs_actual: x}) {
                        x = Number(x)
                        return x  ? x.formatHrs() : '';
                    }
                },
                {title: 'Cumulative<br> Hours<br> Goal', field: 'cumulative_hrs_goal', textAlign: 'center',
                    template({cumulative_hrs_goal: x}) {
                        x = Number(x);
                        return x ? x.formatHrs() : '';
                    }
                },
                {title: 'Monthly<br> VSY<br> Actual', field: 'monthly_vsy_actual', textAlign: 'center', width: 150},
                {title: 'Monthly<br> VSY<br> Goal', field: 'monthly_vsy_goal', textAlign: 'center'},
                {title: 'Monthly<br> Hours<br> Actual', field: 'monthly_hrs_actual', textAlign: 'center'},
                {title: 'Monthly<br> Vols.<br> Active', field: 'monthly_vols_active', textAlign: 'center'},
                {title: 'Annual<br> VSY<br> Goal', field: 'annual_vsy_goal', textAlign: 'center'},
            ]
        });

        $('#vsy_date_range').daterangepicker({
            format: 'mm/dd/yyyy',
            showCustomRangeLabel: false,
        });

        sendAjax('/vsy-calendar-fetch', function({data:calendars}) {
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
            $('#vsy_date_range').daterangepicker({
                showCustomRangeLabel: false,
                format: 'mm/dd/yyyy',
                startDate, endDate,
                ranges
            });
        });
        

       /*  $('#fil_year').datepicker({
            format: 'yyyy',
            minView: 'years',
            minViewMode: 'years',
            autoclose: true
        });

        $('#fil_months').selectpicker({
            width: '300px',
            actionsBox: true,
            showTick: true,
            liveSearch: true,
        }); */

        $('#filter_vsy_report').off('change').on('change', function (e) {
            const input = $(e.target || e.srcElement);
            const value = input.val();
            VSYReport.search(typeof value === 'object' ? value.join(',') : value , input.attr('name'));
        });

        $('.vsy_report_export').off('click').on('click', function (e) {
            const self = $(this);
            let data = {
                query: {
                    filter_year: self.attr('data-year'),
                    filter_months: self.attr('data-months')
                }
            };
            let exportType = self.data('export-type');
            if(exportType === 'pdf') return printVsyFullReport();
            window.open('/export/fgp_vsy_report/'+ exportType +'?'+ $.param(data));
        });

        $('.vsyButtons.download').off('click').on('click', function() {
            const canvas = document.querySelector('#line-chart-element canvas');
            const base64 = canvas.toDataURL();
            const link = document.createElement('A');
            link.href = base64;
            link.download = 'FGP_VSY_'+ (new Date()).getTime() +'.jpg';
            document.body.appendChild(link);
            link.click();
            link.remove();
        });

        //Cross-browser function to select content
        function SelectText(element) {
            var doc = document;
            if (doc.body.createTextRange) {
                var range = document.body.createTextRange();
                range.moveToElementText(element);
                range.select();
            } else if (window.getSelection) {
                var selection = window.getSelection();
                var range = document.createRange();
                range.selectNodeContents(element);
                selection.removeAllRanges();
                selection.addRange(range);
            }
        }
        $(".vsyButtons.copy").click(function (e) {
            const canvas = document.querySelector('#line-chart-element canvas');
            var img = document.createElement('img');
            img.src = canvas.toDataURL()

            var div = document.createElement('div');
            div.contentEditable = true;
            div.appendChild(img);
            document.body.appendChild(div);

            // do copy
            SelectText(div);
            document.execCommand('Copy');
            document.body.removeChild(div);
        });

        $('.vsyButtons.print').off('click').on('click', function() {
            printVsyFullReport();
        });

    }( $('#vsy_report_table') ));

    function printVsyFullReport()
    {
        const canvas = document.querySelector('#line-chart-element canvas');
        const self = $('.vsy_report_export:first');
        const data = {
            query: {
                filter_year: self.attr('data-year'),
                filter_months: self.attr('data-months')
            },
            base64: canvas.toDataURL()
        };
        sendAjax({
            url: '/vsy-report/chart/print', data,
            method: 'post', loader: true
        }, function(filename) {
            const ImageWindow = window.open('vsy-report/chart/download-print?filename='+ filename);
        });
    }
</script>