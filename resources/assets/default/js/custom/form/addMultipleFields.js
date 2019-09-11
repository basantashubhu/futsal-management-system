
function addTableFields(event, options = false){
    var capture = event.parent().parent().clone();
    capture.find('.idField').val('');
    if(options == "remove"){
        event.parent().parent().remove();
    }
    else{
        capture.find('#addFields').hide();
        capture.find('.remove').show();
        if(event.parent().parent().siblings().length<10)
            event.parent().parent().parent().append(capture);
        else
            toastr.error("Can't add more row")
    }
}