//== Class Definition
var SnippetLogin = function () {

    var login = $('#m_login');

    var showErrorMsg = function (form, type, msg) {
        var alert = $('<div class="m-alert m-alert--outline alert alert-' + type + ' alert-dismissible" role="alert">\
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>\
			<span></span>\
		</div>');

        form.find('.alert').remove();
        alert.prependTo(form);
        alert.animateClass('fadeIn animated');
        alert.find('span').html(msg);
    }

    //== Private Functions

    var displaySignUpForm = function () {
        login.removeClass('m-login--forget-password');
        login.removeClass('m-login--signin');

        login.addClass('m-login--signup');
        login.find('.m-login__signup').animateClass('flipInX animated');
    }

    var displaySignInForm = function () {
        login.removeClass('m-login--forget-password');
        login.removeClass('m-login--signup');

        login.addClass('m-login--signin');
        login.find('.m-login__signin').animateClass('flipInX animated');
    }

    var displayForgetPasswordForm = function () {
        login.removeClass('m-login--signin');
        login.removeClass('m-login--signup');

        login.addClass('m-login--forget-password');
        login.find('.m-login__forget-password').animateClass('flipInX animated');
    }

    var handleFormSwitch = function () {
        $('#m_login_forget_password').click(function (e) {
            e.preventDefault();
            displayForgetPasswordForm();
        });

        $('#m_login_forget_password_cancel').click(function (e) {
            e.preventDefault();
            displaySignInForm();
        });

        $('#m_login_signup').click(function (e) {
            e.preventDefault();
            displaySignUpForm();
        });

        $('#m_login_signup_cancel').click(function (e) {
            e.preventDefault();
            $('#registerForm').find('input').val('');
            displaySignInForm();
        });
    }

    var handleSignInFormSubmit = function () {
        $(document).off('click', '#m_login_signin_submit').on('click', '#m_login_signin_submit', function (e) {

            getLocation();
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    email: {
                        required: true,
                    },
                    password: {
                        required: true
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
            var data = $('#loginForm').serializeArray();

            if (clientInfo.hasOwnProperty('fingerprint')) {

                client = clientInfo;

                form.ajaxSubmit({
                    url: '/login',
                    type: 'post',
                    data: client,
                    success: function (response, status, xhr, $form) {
                        location.assign('/');
                    },
                    complete: function (response) {

                        $('.input-required').find('.input-required').removeClass('input-required');
                        if (response.status == 422) {
                            var m = JSON.parse(response.responseText);
                            var errors = m.errors;
                            $.each(errors, function (name, val) {
                                $('input[name=' + name + ']').addClass('input-required');
                            });

                            toastr.error(m.message);
                        }
                        btn.removeClass('m-loader m-loader--right m-loader--light').removeAttr('disabled');
                    },
                });
            }
            else {
                var myVar = setInterval(function () {
                    if (clientInfo.hasOwnProperty('fingerprint')) {
                        clearInterval(myVar);
                        client = clientInfo;
                        form.ajaxSubmit({
                            url: '/login',
                            type: 'post',
                            data: client,
                            success: function (response, status, xhr, $form) {
                                location.assign('/');
                            },
                            complete: function (response) {

                                $('.input-required').find('.input-required').removeClass('input-required');
                                if (response.status == 422) {
                                    var m = JSON.parse(response.responseText);
                                    var errors = m.errors;
                                    $.each(errors, function (name, val) {
                                        $('input[name=' + name + ']').addClass('input-required');
                                    });

                                    toastr.error(m.message);
                                }
                                btn.removeClass('m-loader m-loader--right m-loader--light').removeAttr('disabled');
                            },
                        });
                    }
                }, 1000);

            }


        });
    }

    var handleSignUpFormSubmit = function () {
        $(document).off('click', '#m_login_signup_submit').on('click', '#m_login_signup_submit', function (e) {
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');
            var data = $('#registerForm').serializeArray();
            form.validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },

                    agree: {
                        required: true
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            form.ajaxSubmit({
                url: '/new/register/client',
                type: 'post',
                data: data,
                success: function (response, status, xhr, $form) {
                    // similate 2s delay
                    // location.assign('/login4');
                    // setTimeout(function() {
                    //     btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                    //     form.clearForm();
                    //     form.validate().resetForm();

                    //     // display signup form
                    displaySignInForm();
                    var signInForm = login.find('.m-login__signin form');
                    signInForm.clearForm();
                    signInForm.validate().resetForm();
                    //
                    showErrorMsg(signInForm, 'success', 'Thank you. To complete your registration please check your email.');
                    //        location.assign('/dashboard');
                    // }, 2000);
                }
            });
        });
    }

    var handleForgetPasswordFormSubmit = function () {
        $('#m_login_forget_password_submit').click(function (e) {
            e.preventDefault();

            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            form.ajaxSubmit({
                url: '/password/email',
                method: 'post',
                success: function (response, status, xhr, $form) {
                    // similate 2s delay
                    setTimeout(function () {
                        btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove
                        form.clearForm(); // clear form
                        form.validate().resetForm(); // reset validation states

                        // display signup form
                        displaySignInForm();
                        var signInForm = login.find('.m-login__signin form');
                        signInForm.clearForm();
                        signInForm.validate().resetForm();

                        showErrorMsg(signInForm, 'success', 'Cool! Password recovery instruction has been sent to your email.');
                    }, 1000);
                },
                error(errResp) {
                    if (errResp.status === 422 && errResp.hasOwnProperty('responseJSON')) {
                        btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                        showErrorMsg(form, 'danger', errResp.responseJSON.error);
                    }
                }
            });
        });
    }

    var handleClientSignUpSubmit = function () {
        $('#m_client_signup_submit').click(function (e) {
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');
            var data = $('#registerForm').serializeArray();
            form.validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    name: {
                        required: true,
                    },
                    ssn: {
                        required: true,
                    },
                    password: {
                        required: true,
                    },
                    agree: {
                        required: true
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            form.ajaxSubmit({
                url: '/register/client/new',
                type: 'post',
                data: data,
                success: function (response, status, xhr, $form) {
                    // console.log(response);
                    // similate 2s delay
                    // location.assign('/');
                    $('#RegistrationSuccesfullSection').show();
                    $('#CreateCredential').hide();
                    // setTimeout(function() {
                    //     btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                    //     form.clearForm();
                    //     form.validate().resetForm();

                    //     // display signup form
                    //     displaySignInForm();
                    //     var signInForm = login.find('.m-login__signin form');
                    //     signInForm.clearForm();
                    //     signInForm.validate().resetForm();

                    // showErrorMsg(signInForm, 'success', 'Thank you. To complete your registration please check your email.');
                    //        location.assign('/dashboard');
                    // }, 2000);
                }
            });
        });
    };
    //== Public Functions
    return {
        // public functions
        init: function () {
            handleFormSwitch();
            handleSignInFormSubmit();
            handleSignUpFormSubmit();
            handleForgetPasswordFormSubmit();
            handleClientSignUpSubmit();
        }
    };
}();

//== Class Initialization
jQuery(document).ready(function () {
    SnippetLogin.init();
});

function submitLogin(infoClient) {
    client = infoClient;

    form.ajaxSubmit({
        url: '/login',
        type: 'post',
        data: client,
        success: function (response, status, xhr, $form) {
            location.assign('/');
        },
        complete: function (response) {

            $('.input-required').find('.input-required').removeClass('input-required');
            if (response.status == 422) {
                var m = JSON.parse(response.responseText);
                var errors = m.errors;
                $.each(errors, function (name, val) {
                    $('input[name=' + name + ']').addClass('input-required');
                });

                toastr.error(m.message);
            }
            btn.removeClass('m-loader m-loader--right m-loader--light').removeAttr('disabled');
        },
    });
}