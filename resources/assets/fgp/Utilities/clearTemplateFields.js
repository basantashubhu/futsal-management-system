function clearTemplate(){

    $('.modernFormAddTable .weekSelectpicker[name="days[]"]').val('default').selectpicker('refresh')
    $('#ts-v2-sites').val("").trigger("change")
    $('.modernFormAddTable select[name="item[label][]"]').val("").trigger("change")
    let itemValue = $('.modernFormAddTable select[name="item[value][]"]');
    itemValue.val("").trigger("change")
    itemValue.removeAttr('data-stipend-category')

    let inputsNames = ["time_in", "time_out", "break_out", "break_in", "total_hrs", "item[amount][]"];

    inputsNames.forEach((name) => {
        $(`.modernFormAddTable input[name="${name}"]`).val("");
    })

}