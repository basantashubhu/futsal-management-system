/**
 * @author Suman Thaapa -- Lead 
 * @author Prabhat gurung 
 * @author Basanta Tajpuriya 
 * @author Rakesh Shrestha 
 * @author Manish Buddhacharya 
 * @author Lekh Raj Rai 
 * @author Ascol Parajuli
 * @email NEPALNME@GMAIL.COM
 * @create date 2019-03-12 16:51:56
 * @modify date 2019-03-12 16:51:56
 * @desc [description]
 */

$(document).off('click', '.printBtn').on('click', '.printBtn', function(e){
    e.preventDefault();
    var file_name = $(this).data('filename');
    var id = $(this).data('id');
    var request = {
        url: 'checkPdfFile/'+id,
        method: 'get',
    }
    ajaxRequest(request, function(response){
        if(response && response.response && response.response.data &&
                response.response.data[0] && response.response.data[0].type == 'error') {
            return;
        }
        else{
            print_certificate(file_name);
        }
    });
});

$(document).off('click', '.bulk_print').on('click', '.bulk_print', function(e){
    if($(this).hasClass('mergePdf')){
        $(this).removeClass('mergePdf');
    }
    else{
        $(this).addClass('mergePdf');
    }
});

$(document).off('click', '#printMergeFile').on('click', '#printMergeFile', function(e){
    e.preventDefault();
    var const_i = 0;
    var data = {};
    $('.mergePdf').each(function(index, value){
        const_i++;
        data['file_id'+const_i] = $(this).data('id');
    });

    if($('.mergePdf').length > 0){
        var request = {
            url: '/getPdfFile',
            method: 'post',
            data: data
        };

        ajaxRequest(request, function(response){
            if(response && response.response && response.response.data &&
                response.response.data[0] && response.response.data[0].type == 'error') {
                return;
            }
            bulk_print(response.data);
        });
    }
    else{
        showModal('notFoundError/Email');
    }
});

$(document).off('click', '.printInvoiceView').on('click', '.printInvoiceView', function(e){
    e.preventDefault();
    var file_name = $(this).data('filename');
    var id = $(this).data('id');
    var request = {
        url: 'checkPdfFile/'+id,
        method: 'get',
    }
    ajaxRequest(request, function(response){
        if(response && response.response && response.response.data &&
                response.response.data[0] && response.response.data[0].type == 'error') {
            return;
        }
        else{
            print_certificate(file_name);
        }
    });
});

function print_certificate(file_name)
{
    printJS('storage/uploads/'+file_name);
}
function bulk_print(file_name)
{

    printJS('bulk_print/'+file_name);
}

$('#applicationTitle').on('change', function(){
    fileTable.search($(this).val(), 'document_title');
});
