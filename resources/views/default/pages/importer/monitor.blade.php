<div class="m-content">

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body">
            <div id="monitor" class="m-t-10">

            </div>
        </div>
    </div>
</div>

<script>
    getLog();
    function getLog() {
        monitorInt = setInterval(function () {
            ajaxRequest({
                url: '/textLog/readMonitor/{{$field}}'
            }, function (response) {
                if (response && response.data) {
                    loadView(response.data[0].data);
                }
            });
        }, 3000);
    }

    function loadView(data) {
        debugger;
        var dataArr = JSON.parse(data);

        var template='';
        if(data.type=='success') {


            template = '<div> Field Id : ' + dataArr.id + '</div>' +
                    '<div> Status : ' + dataArr.type + '</div>' +
                    '<div> message : ' + dataArr.message + '</div>';
        }
        else
        {
            template = '<div> Status : ' + dataArr.type + '</div>' +
                    '<div> message : ' + dataArr.message + '</div>';
        }
        $('#monitor').append(template);

    }

</script>