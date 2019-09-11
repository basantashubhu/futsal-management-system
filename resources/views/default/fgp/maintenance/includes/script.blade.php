<script>
loadCookie('table_main', '#appQuickButton');

var lastCount;
$("#table_name").on('m-datatable--on-ajax-done', function(e, data) {
    lastCount = data.length - 1;
});

var nameTable = $("#table_name").mDatatable({
    data:{
        type:"remote",
        source:{
            read:{
            url:"getAllTable",
            method: 'get'
        }
    },
    pageSize:1000,
    saveState:!1,
    serverPaging:!1,
    serverFiltering:!1,
    serverSorting:!1},
    sortable:!0,
    pagination:!1,
    search:{
        input: $("#generalSearch")
    },
    rows:{
        autoHide:false,
        afterTemplate: function(row, data, index){
            row.addClass('getDescription');
            row.attr('data-id', data.id);

            if(lastCount === index) {
                $("#table_name tbody").addClass('scrollbar-navy').attr('style', 'max-height:50vh;overflow-y:auto;');
            }
        }
    },
    columns:[
        {
            field:"table_name",
            title:"Table Name"
        },
        {
            field:"label",
            title:"Label",
            width:150,
        },{
            field:'id',
            title: 'Action',
            width: 100,
            textAlign: 'right',
            template:function(row){
                return '<a href="#" class="btn btn-outline-brand m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill getDescription" data-id="'+row.id+'">'+
                        '<i class="la la-eye"></i>'+
                    '</a>';
            }
        }
    ]
});

$(document).off('input', '#label').on('input', '#label', function(e){
    e.preventDefault();
    if($(this).val().length>2){
        var label = [{name: 'label', value: $(this).val()}];
        setCookie('table_main', JSON.stringify(label));
        nameTable.search($(this).val(), 'label');
    }else{
        $(this).blur(function(e){
            if($(this).val().length<2){
            deleteCookie('table_main');
            reloadDatatable('#table_name');
            }
        })
    }
});

$(document).off('click', '.getDescription').on('click', '.getDescription', function(e){
    e.preventDefault();
    $(this).parent().find('a').removeClass('m--font-info');
    $(this).addClass('m--font-info');
    var id = $(this).attr('data-id');
    var request= {
        url: 'getTableDesc/'+id,
        method: 'get'
    }
    ajaxRequest(request, function(response){
        $('#viewTable').attr('data-modal-route', 'viewTable/'+response.data.id);
        $('#editTable').attr('data-modal-route', 'editTable/'+response.data.id);
        $('#tableDescription').html('<span>'+response.data.description+'</span>');
    });
});

$(document).off('click', '#syncTable').on('click', '#syncTable', function(e){
    e.preventDefault();
    var request={
        url: 'syncTable',
        method: 'get'
    }
    addFormLoader();
    ajaxRequest(request, function(response){
        processForm(response, function(){
            removeFormLoader();
            reloadDatatable('#table_name');
        });
    });
});
</script>