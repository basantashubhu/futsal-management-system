

function readURL(option) {
    if (option.input.files && option.input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(option.img).attr('src', e.target.result);
        }

        reader.readAsDataURL(option.input.files[0]);
    }
}

/**
 * numval
 * Get Number value from string
 */
if (!String.prototype.numval) {
    String.prototype.numval = function () {
        if (this && this.match(/\d+/g)) {
            var numbers = this.match(/\d+/g).map(Number);
            if (numbers && numbers.length === 1)
                return numbers[0];
            else
                return numbers;
        }
    }
}

function showSuccessMessage(response) {
    if (response && response[0] && response[0].type.toLowerCase() == 'success' && response[0].data) {
        toastr.success(response[0].data);
    }
}

function addFormLoader() {
    $("#contentHolder").append('<div class="m-loader page from-top" rel="pageLoader"></div>');
}

function addCSVLoader() {
    $('#CustomTableHolder').append('<div class="text-loader"><div class="loader"></div>\
                                            <div class="process-status">Importing...</div></div>');
}
function changeCSVLoader(count = 0, total = 100) {
    // console.log(count);
    $('#CustomTableHolder').append('<div class="text-loader"><div class="loader"></div>\
                                            <div class="process-status">Importing ' + count + ' of ' + total + '</div></div>');
}

function removeCSVLoader() {
    $('#contentHolder').remove('.text-loader');
}

function removeFormLoader() {
    $("#contentHolder").find('.m-loader.page.from-top').remove();
}


$(document).off('blur', '.ucfirst').on('blur', '.ucfirst', function (e) {
    var inputVal = $(this).val();
    if (inputVal.length) {
        $(this).val(inputVal.ucfirst());
    }
});