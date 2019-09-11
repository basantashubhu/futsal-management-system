function floatLabelInput(input, load = false, align = 30) {
    if (load) {
        let floatingInterval = setInterval(ownFloatLabel, 100, input, load, align);
        setTimeout(function () {
            clearInterval(floatingInterval);
        }, 1000);
    } else {
        ownFloatLabel(input, load, align);
    }
    return true;
}

function ownFloatLabel(input, load = false, align = 30) {
    if (load && input.value.length === 0) {
        $(input).closest('.field').find('label:first').attr('style', '').removeClass('floatingLabel');
        return false;
    }
    $(input).closest('.field').css('position','relative')
    .find('label:first').css({
        'position':'absolute', 'top':'-7px','left':align+'px',
        'background' : 'white','color':'#3780b7',
        'padding':'0 1px',
        'z-index':'9', 'transition': '0.3s'
    }).addClass('floatingLabel');
    $(input).css({'cssText':'position:relative;' });
}