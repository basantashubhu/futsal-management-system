



// Load Color Picker

var originalColor = $('body .m-body').css('background-color');
var colorpalette = [
    ["rgb(242, 243, 248)", "rgb(0, 0, 0)", "rgb(67, 67, 67)", "rgb(102, 102, 102)",
        "rgb(204, 204, 204)", "rgb(217, 217, 217)", "rgb(255, 255, 255)"],
    ["rgb(152, 0, 0)", "rgb(255, 0, 0)", "rgb(255, 153, 0)", "rgb(255, 255, 0)", "rgb(0, 255, 0)",
        "rgb(0, 255, 255)", "rgb(74, 134, 232)", "rgb(0, 0, 255)", "rgb(153, 0, 255)", "rgb(255, 0, 255)"],
    ["rgb(230, 184, 175)", "rgb(244, 204, 204)", "rgb(252, 229, 205)", "rgb(255, 242, 204)", "rgb(217, 234, 211)",
        "rgb(208, 224, 227)", "rgb(201, 218, 248)", "rgb(207, 226, 243)", "rgb(217, 210, 233)", "rgb(234, 209, 220)",
        "rgb(221, 126, 107)", "rgb(234, 153, 153)", "rgb(249, 203, 156)", "rgb(255, 229, 153)", "rgb(182, 215, 168)",
        "rgb(162, 196, 201)", "rgb(164, 194, 244)", "rgb(159, 197, 232)", "rgb(180, 167, 214)", "rgb(213, 166, 189)",
        "rgb(204, 65, 37)", "rgb(224, 102, 102)", "rgb(246, 178, 107)", "rgb(255, 217, 102)", "rgb(147, 196, 125)",
        "rgb(118, 165, 175)", "rgb(109, 158, 235)", "rgb(111, 168, 220)", "rgb(142, 124, 195)", "rgb(194, 123, 160)",
        "rgb(166, 28, 0)", "rgb(204, 0, 0)", "rgb(230, 145, 56)", "rgb(241, 194, 50)", "rgb(106, 168, 79)",
        "rgb(69, 129, 142)", "rgb(60, 120, 216)", "rgb(61, 133, 198)", "rgb(103, 78, 167)", "rgb(166, 77, 121)",
        "rgb(91, 15, 0)", "rgb(102, 0, 0)", "rgb(120, 63, 4)", "rgb(127, 96, 0)", "rgb(39, 78, 19)",
        "rgb(12, 52, 61)", "rgb(28, 69, 135)", "rgb(7, 55, 99)", "rgb(32, 18, 77)", "rgb(76, 17, 48)"]
];

$(".chooseColor").spectrum({
    color: "rgb(242, 243, 248)",
    showInput: true,
    className: "full-spectrum",
    showInitial: true,
    showPalette: true,
    showSelectionPalette: true,
    maxSelectionSize: 10,
    preferredFormat: "hex",
    localStorageKey: "spectrum.chooseColor",
    move: function (color) {
        $('body .m-body').css('background-color', color.toHexString());
    },
    show: function () {
    },
    hide: function () {
        $('body .m-body').css('background-color', originalColor);
    },
    change: function (color) {
        // $("#customColorSaveModal").modal('show');
    },
    palette: colorpalette
});

// Global Background Color
$(document).off('change', 'select[name=global_page_background]').on('change', 'select[name=global_page_background]', function (e) {
    var layout = $(this).val();
    layout = layout.length ? layout.toLowerCase().trim() : false;

    if (layout) {
        switch (layout) {
            case "none":
                $('body').removeClass('lightgray lightyellow darkblue classic pinky');
                break;
            case "lightyellow":
                $('body').removeClass('lightgray darkblue classic pinky').addClass(layout);
                break;
            case "darkblue":
                $('body').removeClass('lightyellow lightgray classic pinky').addClass(layout);
                break;
            case "lightgray":
                $('body').removeClass('darkblue lightyellow classic pinky').addClass(layout);
                break;
            case "classic":
                $('body').removeClass('darkblue lightyellow lightgray pinky').addClass(layout);
                break;
            case "pinky":
                $('body').removeClass('darkblue lightyellow lightgray classic').addClass(layout);
                break;
            default:
                break;
        }
    }
});

// Layout Type
$(document).off('change', 'select[name=layout_type]').on('change', 'select[name=layout_type]', function (e) {
    var layout = $(this).val();
    layout = layout.length ? layout.toLowerCase().trim() : false;

    if (layout) {
        switch (layout) {
            case "fluid":
                $('body').removeClass('m-page--boxed').addClass('m-page--fluid');
                $('.m-container').addClass('m-container--fluid').removeClass('m-container--responsive m-container--xxl custom-response-header');
                break;
            case "boxed":
                $('body').removeClass('m-page--fluid').addClass('m-page--boxed');
                $('.m-container').addClass('m-container--responsive m-container--xxl custom-response-header').removeClass('m-container--fluid');
                break;

            default:
                toastr.error('Setting Not Found');
                break;
        }
    }
});

// Page Background
$(document).off('change', 'select[name=page_background]').on('change', 'select[name=page_background]', function (e) {
    var content_skin = $(this).val();
    content_skin = content_skin.length ? content_skin.toLowerCase().trim() : false;

    if (content_skin) {
        switch (content_skin) {
            case "light":
                $('body').removeClass('m-content--skin-light2').addClass('m-content--skin-light');

                break;
            case "lightgray":
                $('body').removeClass('m-content--skin-light').addClass('m-content--skin-light2');
                break;

            default:
                toastr.error('Setting Not Found');
                break;
        }
    }
});


// Desktop Fixed Header
$(document).off('change', 'input[name=desktop_fixed_header]')
    .on('change', 'input[name=desktop_fixed_header]', function (e) {
        if ($(this).prop('checked')) {
            $('body').addClass('m-header--fixed').removeClass('m-header--static');
        } else {
            $('body').addClass('m-header--static').removeClass('m-header--fixed');
        }
    });

// Desktop Header Minimize Mode
$(document).off('change', 'select[name=desktop_header_minimize_mode]')
    .on('change', 'select[name=desktop_header_minimize_mode]', function (e) {
        var content_skin = $(this).val();
        content_skin = content_skin.length ? content_skin.toLowerCase().trim() : false;

        if (content_skin) {
            switch (content_skin) {
                case "hide":
                    $('body').addClass('m-header--show');

                    break;
                case "none":
                    $('body').removeClass('m-header--show');
                    break;

                default:
                    toastr.error('Setting Not Found');
                    break;
            }
        }
    });


// Mobile Fixed header
$(document).off('change', 'input[name=mobile_fixed_header]')
    .on('change', 'input[name=mobile_fixed_header]', function (e) {
        if ($(this).prop('checked')) {
            $('body').addClass('m-header--fixed-mobile');
        } else {
            $('body').removeClass('m-header--fixed-mobile');
        }
    });


// Display Header Menu
$(document).off('change', 'input[name=display_header_menu]').on('change', 'input[name=display_header_menu]', function (e) {
    if ($(this).prop('checked')) {
        $('.m-header-menu ul li:not(:first-child)').removeClass('hidden');
    } else {
        $('.m-header-menu ul li:not(:first-child)').addClass('hidden');
    }
});


// Display Dropdown Skin(Desktop)
$(document).off('change', 'select[name=dropdown_skin]').on('change', 'select[name=dropdown_skin]', function (e) {
    var submenu_dropDown_menu = $(this).val() && $(this).val().length ? $(this).val().toLowerCase().trim() : false;

    if (submenu_dropDown_menu) {
        switch (submenu_dropDown_menu) {
            case "light":
                $('.m-header-menu').removeClass('m-header-menu--submenu-skin-dark');
                break;

            case "dark":
                $('.m-header-menu').addClass('m-header-menu--submenu-skin-dark');
                break;

            default:
                toastr.error('Setting Not Found');
                break;
        }
    }
});


// Display Submenu Arrow
$(document).off('change', 'input[name=display_submenu_arrow]')
    .on('change', 'input[name=display_submenu_arrow]', function (e) {
        if ($(this).prop('checked')) {
            $('.m-menu__nav').addClass('m-menu__nav--submenu-arrow');
        } else {
            $('.m-menu__nav').removeClass('m-menu__nav--submenu-arrow');
        }
    });


// Display Aside Skin(Desktop)
$(document).off('change', 'select[name=aside_skin]')
    .on('change', 'select[name=aside_skin]', function (e) {
        var submenu_dropDown_menu = $(this).val() && $(this).val().length ? $(this).val().toLowerCase().trim() : false;

        if (submenu_dropDown_menu) {
            switch (submenu_dropDown_menu) {
                case "light":
                    $('header .m-stack__item').addClass('m-brand--skin-light').removeClass('m-brand--skin-dark');
                    $('#m_aside_left').addClass('m-aside-left--skin-light').removeClass('m-aside-left--skin-dark');
                    break;

                case "dark":
                    $('header .m-stack__item').addClass('m-brand--skin-dark').removeClass('m-brand--skin-light');
                    $('#m_aside_left').addClass('m-aside-left--skin-dark').removeClass('m-aside-left--skin-light');
                    break;

                default:
                    toastr.error('Setting Not Found');
                    break;
            }
        }
    });


// Fixed Aside
$(document).off('change', 'input[name=fixed_aside]').on('change', 'input[name=fixed_aside]', function (e) {
    if ($(this).prop('checked')) {
        $('body').addClass('m-aside-left--fixed');
    } else {
        $('body').removeClass('m-aside-left--fixed');
    }
});


// Allow Aside Minimizing
$(document).off('change', 'input[name=allow_aside_minimizing]').on('change', 'input[name=allow_aside_minimizing]', function (e) {
    if ($(this).prop('checked')) {

        // If Default Aside is hidden, show it
        if ($('[name="default_hidden_aside"]').prop('checked')) {
            $('[name="default_hidden_aside"]').trigger('click');
        }

        $('body').addClass('m-brand--minimize m-aside-left--minimize m-scroll-top--shown hideMenuText');
        $('.showAsideText').addClass('show');
    } else {
        $('body').removeClass('m-brand--minimize m-aside-left--minimize m-scroll-top--shown hideMenuText');
        $('.showAsideText').removeClass('show');
    }
});

$(document).off('change', 'input[name = "global_font_size"]').on('change', 'input[name = "global_font_size"]', function(e){

    e.preventDefault();

    // let previousFs = $(this).data('previous-fs');

    // console.log(previousFs, $(this).val())
    

    $(document).find('.global--fs').removeClass(`gfs--${previousFs}`).addClass(`gfs--${$(this).val()}`);

});

// Header Aside Menu Text Toggler
$(document).off('click', '.showAsideText').on('click', '.showAsideText', function (e) {
    e.preventDefault();
    minimizeAsideMenu(true);
});

function minimizeAsideMenu(triggerAjax) {
    $('input[name=allow_aside_minimizing]').prop('checked', false);
    $('body').removeClass('m-brand--minimize m-aside-left--minimize m-scroll-top--shown hideMenuText');
    $('.showAsideText').removeClass('show');

    // Trigger Submit Button Of Layout Form
    if (triggerAjax) {
        $('[name=builder_submit]').trigger('click');
    }
}


// Default Hidden Aside
$(document).off('change', 'input[name=default_hidden_aside]').on('change', 'input[name=default_hidden_aside]', function (e) {
    if ($(this).prop('checked')) {

        // Check Aside is minimized or not
        if ($('[name="allow_aside_minimizing"]').prop('checked')) {
            $('[name="allow_aside_minimizing"]').trigger('click');
        }

        $('body').addClass('m-aside-left--hide');
    } else {
        $('body').removeClass('m-aside-left--hide');
    }
});


// Fixed Footer
$(document).off('change', 'input[name=fixed_footer]').on('change', 'input[name=fixed_footer]', function (e) {
    if ($(this).prop('checked')) {
        $('body').addClass('m-footer--fixed');
    } else {
        $('body').removeClass('m-footer--fixed');
    }
});

/**
 * Submit New Setting
 */
$(document).off('submit', '#layout_builder_form').on('submit', '#layout_builder_form', function (e) {
    e.preventDefault();
    var ajaxOptions = {
        url: $(this).attr('action'),
        method: $(this).attr('method'),
        form: 'layout_builder_form'
    }

    addFormLoader();
    ajaxRequest(ajaxOptions, function (response) {
        removeFormLoader();
        toastr.success("Setting Updated");
        if (window.location) {
            window.location.reload();
        }
    });
});

$(document).off('change', 'input[name=EmailMode]').on('change', 'input[name=EmailMode]', function (e) {
    e.preventDefault();
    var request = {
        url: '/sitesetting/change/email',
        method: 'get'
    }
    ajaxRequest(request, function (data) {
        console.log(data);
    })
});
$(document).off('change', 'input[name=applicationMode]').on('change', 'input[name=applicationMode]', function (e) {
    e.preventDefault();
    var request = {
        url: '/sitesetting/change/application_citizen_add_mode',
        method: 'get'
    }
    ajaxRequest(request, function (data) {
        // console.log(data);
    })
});
$(document).off('change', '*[rel=changeMode]').on('change', '*[rel=changeMode]', function (e) {
    e.preventDefault();
    var code = $(this).data('code');
    var request = {
        url: '/sitesetting/change/' + code,
        method: 'get'
    };
    ajaxRequest(request, function (data) {
        // console.log(data);
    });
});
$(document).off('change', '*[rel=changeNotification]').on('change', '*[rel=changeNotification]', function (e) {
    e.preventDefault();
    var code = $(this).data('code');
    var request = {
        url: '/sitesetting/notification/' + code,
        method: 'get'
    };
    ajaxRequest(request, function (data) {
        toastr.success("Settings Updated Successfully");
        if (window.location) {
            window.location.reload();
        }
    });
});
$(document).off('change', '*[rel=mailChange]').on('change', '*[rel=mailChange]', function (e) {
    e.preventDefault();
    var code = $(this).data('code');
    var request = {
        url: '/sitesetting/mailchange/' + code,
        method: 'get'
    };
    ajaxRequest(request, function (data) {
        // console.log(data);
    })
});