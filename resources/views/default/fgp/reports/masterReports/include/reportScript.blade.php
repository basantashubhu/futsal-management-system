<script>
    var target = $('#reportLogContainer').attr('data-target');

    $('.data-link a').on('click', function () {
        $('.m-list-search__results').find('a').removeClass('active_class_row');
        $(this).addClass('active_class_row');
        $(this).siblings().removeClass('active_class_row');
        target = $(this).attr('data-table-target');
        var modalUrl='fgp_report/search/'+target;
        $('.generateBtn').attr('data-modal-route',modalUrl);
        reloadTable(target);
    });

    function reloadTable(target) {
        var request = {
            url: '/fgp_reports/loadSection/' + target
        };
        ajaxRequest(request, function (response) {
            $('.reportLoader').empty().append(response.data);
        });
    }

    function mailReport() {
        var request = {
            url: '/fgp_report/loadMailSection'
        };
        ajaxRequest(request, function (response) {
            $('.reportLoader').empty().append(response.data);
        });
    }

    $(document).off('click','.downloadReport').on('click','.downloadReport',function () {
        var id=$(this).data('id');
        var url = '/fgp_report/download/' + id;
        window.open(url);
    });
</script>