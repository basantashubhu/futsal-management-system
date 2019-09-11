function reportDatePicker(dateRange=null,pickerClass='.m_report_date_filter') {
    var daterangepickerInit = function () {
        if ($('.m_report_date_filter').length == 0) {
            return;
        }

        var picker = $(pickerClass);
        var start = moment().startOf('year');
        var end = moment().endOf('Year');

        if(dateRange!=null && dateRange!='' )
        {
            var dates=dateRange.split('-');
            start=moment(dates[0]);
            end=moment(dates[1]);
        }

        function cb(start, end, label) {
            var title = '';
            var range = '';

            if ((end - start) < 100) {
                title = 'Today:';
                range = start.format('MMM D');
            } else if (label == 'Yesterday') {
                title = 'Yesterday:';
                range = start.format('MMM D');
            } else {
                range = start.format('MMM D') + ' - ' + end.format('MMM D');
            }

            picker.find('.m-subheader__daterange-date').html(range);
            picker.find('.m-subheader__daterange-title').html(title);

            range=start.format('Y/MM/DD') + ' - ' + end.format('Y/MM/DD');
            $('.data-range-input').val(range);
        }

        picker.daterangepicker({
            startDate: start,
            endDate: end,
            opens: 'right',
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end, '');
    }
    daterangepickerInit();
}