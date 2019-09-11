function objectifyForm(formArray) {

    //serialize data function
    var returnArray = {};
    for (var i = 0; i < formArray.length; i++){
        if(formArray[i]['value']!='' && formArray[i]['value']!=null)
            returnArray[formArray[i]['name']] = formArray[i]['value'];
    }
    return returnArray;
}

function saveTemplate(target,data,self)
{
    document.templateData=objectifyForm(data);
    var modal_url='/reports/template/view?target='+target;
    var parent = self.closest('.modal.show').attr('data-modal-id');
    ++modalId;
    showModal(modal_url, {
        relation: "child",
        parentId: parent,
    });

    $('.modal.show[data-modal-id='+parent+']').modal('hide');
}

$(document).off('click','.loadReportTemp').on('click','.loadReportTemp',function () {
    var selected=$('.dataTemplate').find('tr:not(:first-child).active_row').data('id');
    if(typeof  selected !=undefined && selected !='')
    {
        loadTemplate(selected)
    }
});

$(document).off('dblclick','.dataTemplate').on('dblclick','.dataTemplate tr:not(:first-child)',function(){
    var selected=$(this).data('id');
    $(this).closest('.modal-body').siblings('.modal-header').find('button.close').trigger('click');
    if(typeof  selected !=undefined && selected !='')
        loadTemplate(selected);
});
function loadTemplate(selected) {
    var request= {
        url: '/reports/template/load?id=' + selected
    };
    ajaxRequest(request,function (response) {
        var data=response.data.key_val;
        data=JSON.parse(data);
        $.each(data,function (key,value) {
            $('input[name='+key+']').val(value);
            $('select[name='+key+']').selectpicker('val', value)
            $('textarea[name='+key+']').val(value)
        })
    });
}

$(document).off('click','.exportReportData').on('click','.exportReportData',function () {
    var format=$(this).attr('data-export-type');
    var target=$(this).attr('data-target');
    var data=$('.reportSearchForm').serialize();

    var url='/report/exportAll/'+target+'/'+format+'?'+data;

    window.open(url);
});