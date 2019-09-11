var printConfig = {
    printBtn: "*[data-print]"
};

$(document).off('click', printConfig.printBtn).on('click',printConfig.printBtn, function () {
    var url = $(this).attr('data-print');
    printJS(url);
});
