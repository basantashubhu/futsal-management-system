
$(document).off('click', '*[rel=developerConsole]').on('click', '*[rel=developerConsole]', function (e) {
    e.preventDefault();

    loadDeveloperNote();
    $("#developerPanel").slideToggle();
});

// Shift + ~
$(document).on('keyup keypress', function (e) {
    if (e.shiftKey && e.key == "~") {
        loadDeveloperNote();
        $("#developerPanel").slideToggle();
    }
});

$(document).off('submit', '#DeveloperNoteForm').on('submit', '#DeveloperNoteForm', function (e) {
    e.preventDefault();

    $('#PageHolder').val(location.hash);
    var request = {
        url: '/developernote/store',
        method: 'Post',
        form: 'DeveloperNoteForm'
    };

    addFormLoader();
    ajaxRequest(request, function (response) {

        removeFormLoader();
        $('#NoteTextarea').val('');
        showSuccessMessage(response.data);
        loadDeveloperNote();
        highlightFirst();
    });
});

function initResizer() {
    $("#developerPanel").resizable({
        maxHeight: 600,
        minHeight: 365,
        handles: {
            'n': '#handle'
        },
        resize: function (event, ui) {
            var parent = ui.element;
            var height = ui.size.height;

            // Textarea
            parent.find('#DeveloperNoteForm textarea').css({
                "max-height": (height - 160),
                "height": (height - 160),
            });

            // Note Lists
            parent.find('.notes').css({
                "max-height": (height - 120),
                "height": (height - 120),
            });
        }
    });
}

function loadDeveloperNote() {
    ajaxRequest({
        'url': '/developernote/all'
    }, function (response) {
        loadDeveloperNotesServer(response.data)
    });
}
function loadDeveloperNotesServer(markup) {
    $('#DeveloperNotesHolder').html(markup);
}

function loadDeveloperNotesClient(data) {

    $('#DeveloperNotesHolder').empty();
    if (data.length) {
        $.each(data, function (idx, val) {
            var is_done = '';
            var pickup = '';
            var pickupby = '';
            if (!val.user) {
                pickup = '<button class="btn m-btn--pill btn-xs btn-outline-info dNotePickUp" data-id="' + val.id + '"> Pick Up </button>';
            }
            if (!val.is_done && val.user) {
                is_done = '<button class="btn m-btn--pill btn-xs btn-sm btn-outline-success m-l-5 d_is_done" data-id="' + val.id + '">Done</button>';
            }
            if (val.user) {
                pickupby = '<button class="btn m-btn--pill btn-xs btn-outline-info">Picked By : ' + val.user.name + ' </button>';
            }
            var markup = ' <div class="m-widget3__item">\n' +
                '                                <div class="m-widget3__header">\n' +
                '                                    <div class="m-widget3__user-img">\n' +
                '                                        <img class="m-widget3__img" src="images/no-user.svg" alt="">\n' +
                '                                    </div>\n' +
                '                                    <div class="m-widget3__info">\n' +
                '                                        <span class="m-widget3__username">\n' +
                val.creator.name.ucfirst() +
                '                                        </span>\n' +
                '                                        <br>\n' +
                '                                        <span class="m-widget3__time">\n' +
                '                                            2 day ago\n' +
                '                                        </span>\n' +
                '                                    </div>\n' +
                '                                    <span class="m-widget3__status m--font-info">\n' +
                pickup + pickupby + is_done +
                '                                    </span>\n' +
                '                                </div>\n' +
                '                                <div class="m-widget3__body">\n' +
                '                                    <p class="m-widget3__text">\n' +
                val.text +
                '                                    </p>\n' +
                '                                </div>\n' +
                '                            </div>';
            $('#DeveloperNotesHolder').prepend(markup);
        })
    } else {
        var markup = 'No Issue yet';
        $('#DeveloperNotesHolder').html(markup);
    }

}

$(document).off('click', '.dNotePickUp').on('click', '.dNotePickUp', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    ajaxRequest({
        url: '/developernote/pickup/' + id,
        method: 'Post',
        cancelPrevious: true
    }, function (response) {
        showSuccessMessage(response.data);
        loadDeveloperNote();
    });
});

$(document).off('click', '.d_is_done').on('click', '.d_is_done', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    ajaxRequest({
        url: '/developernote/done/' + id,
        method: 'Post',
        cancelPrevious: true
    }, function (response) {
        showSuccessMessage(response.data);
        loadDeveloperNote();
    });
});

function highlightFirst() {
    var notes = $(".notes");
    notes.animate({scrollTop: 0}, 300);
    notes.find('.m-widget3__item:first-child').addClass('added');

    var removeClassTime = setTimeout(function () {
        notes.find('.m-widget3__item:first-child').removeClass('added');
        clearTimeout(removeClassTime);
    }, 4000);
}



/**
 * Table Export
 */

$(document).off('click', '.developerNote_export').on('click', '.developerNote_export', function (e) {
    e.preventDefault();
    var exportType = $(this).attr("data-export-type");
    if (exportType) {
        $("#developernoteTable table").tableExport({
            type: exportType,
            escape: 'false',
            fileName: "ietable",
            ignoreColumn: [6]
        });
    }
});