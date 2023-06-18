//== Class Definition
var SnippetLogin = function() {

    var login = $('#m_login');

    var showErrorMsg = function(form, type, msg, remove_previous_alerts = null) {
        var alert = $('<div class="m-alert m-alert--outline alert alert-' + type + ' alert-dismissible" role="alert">\
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>\
			<span></span>\
		</div>');

        if (remove_previous_alerts !== false) {
	        form.find('.alert').remove();
        }

        alert.prependTo(form);
        //alert.animateClass('fadeIn animated');
        mUtil.animateClass(alert[0], 'fadeIn animated');
        alert.find('span').html(msg);
    }

    //== Private Functions

    var displaySignUpForm = function() {
        login.removeClass('m-login--forget-password');
        login.removeClass('m-login--signin');

        login.addClass('m-login--signup');
        mUtil.animateClass(login.find('.m-login__signup')[0], 'flipInX animated');
    }

    var displaySignInForm = function() {
        login.removeClass('m-login--forget-password');
        login.removeClass('m-login--signup');

        login.addClass('m-login--signin');
        mUtil.animateClass(login.find('.m-login__signin')[0], 'flipInX animated');
        //login.find('.m-login__signin').animateClass('flipInX animated');
    }

    var displayForgetPasswordForm = function() {
        login.removeClass('m-login--signin');
        login.removeClass('m-login--signup');

        login.addClass('m-login--forget-password');
        //login.find('.m-login__forget-password').animateClass('flipInX animated');
        mUtil.animateClass(login.find('.m-login__forget-password')[0], 'flipInX animated');

    }

    var handleFormSwitch = function() {
        $('#m_login_forget_password').click(function(e) {
            e.preventDefault();
            displayForgetPasswordForm();
        });

        $('#m_login_forget_password_cancel').click(function(e) {
            e.preventDefault();
            displaySignInForm();
        });

        $('#m_login_signup').click(function(e) {
            e.preventDefault();
            displaySignUpForm();
        });

        $('#m_login_signup_cancel').click(function(e) {
            e.preventDefault();
            displaySignInForm();
        });
    }

    var handleSignInFormSubmit = function() {
        $('#m_login_signin_submit').click(function(e) {
            if ($('#login_form').valid()) {
                e.preventDefault();
                var btn = $(this);
                var form = $(this).closest('form');

                form.validate({
                    rules: {
                        email: {
                            required: true,
                            email: true
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

                form.ajaxSubmit({
                    url: form.action,
                    success: function(response, status, xhr, $form) {
                        // Success
                        if (response.success) {                 
                            setTimeout(function() {
                                btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                                showErrorMsg(form, 'success', response.success);
                            }, 2000);
                        } else {
                            setTimeout(function() {
                                btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                                showErrorMsg(form, 'success', 'Logged-in successfully');
                            }, 2000);
                        }
                        location.reload();
                    },
                    error: function (xhr, error_text, statusText) {
                        if (xhr.status == 401) {
                            // Unauthorized
                            if (xhr.responseJSON.error) {    
                                console.log('he');                   
                                setTimeout(function() {
                                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                                    showErrorMsg(form, 'danger', xhr.responseJSON.error);
                                }, 2000);
                            } else {
                                setTimeout(function() {
                                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                                    showErrorMsg(form, 'danger', xhr.responseJSON.message);
                                }, 2000);
                            }
                        } else if (xhr.status == 422) {
                            // HTTP_UNPROCESSABLE_ENTITY
                            if (xhr.responseJSON.errors) {                      
                                // Remove previous alers
                                form.find('.alert').remove();

                                btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                                $.each(xhr.responseJSON.errors, function(index, error) {
                                    setTimeout(function() {
                                        showErrorMsg(form, 'danger', error.message, false);
                                    }, 2000);
                                });
                            } else {
                                setTimeout(function() {
                                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                                    showErrorMsg(form, 'danger', statusText);
                                }, 2000);
                            }
                        } else if (xhr.status == 500) {
                            // Internal Server Error
                            var error = xhr.responseJSON.message;
                            if (xhr.responseJSON.error) {                       
                                setTimeout(function() {
                                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                                    showErrorMsg(form, 'danger', xhr.responseJSON.error);
                                }, 2000);
                            } else {
                                setTimeout(function() {
                                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                                    showErrorMsg(form, 'danger', statusText);
                                }, 2000);
                            }
                        }
                    }
                });
            } else {
                //
            }
        });
    }

    var handleSignUpFormSubmit = function() {
        $('#m_login_signup_submit').click(function(e) {
            e.preventDefault();

            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    fullname: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    },
                    rpassword: {
                        required: true
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
                url: '',
                success: function(response, status, xhr, $form) {
                	// similate 2s delay
                	setTimeout(function() {
	                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
	                    form.clearForm();
	                    form.validate().resetForm();

	                    // display signup form
	                    displaySignInForm();
	                    var signInForm = login.find('.m-login__signin form');
	                    signInForm.clearForm();
	                    signInForm.validate().resetForm();

	                    showErrorMsg(signInForm, 'success', 'Thank you. To complete your registration please check your email.');
	                }, 2000);
                }
            });
        });
    }

    var handleForgetPasswordFormSubmit = function() {
        $('#m_login_forget_password_submit').click(function(e) {
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
                url: form.action,
                success: function(response, status, xhr, $form) {
                    // Success
                    setTimeout(function() {
                        btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                        form.clearForm(); // clear form
                        form.validate().resetForm(); // reset validation states

                        // display signup form
                        displaySignInForm();
                        var signInForm = login.find('.m-login__signin form');
                        signInForm.clearForm();
                        signInForm.validate().resetForm();

                        showErrorMsg(signInForm, 'success', 'Cool! Password recovery instruction has been sent to your email.');
                    }, 2000);
                },
                error: function (xhr, error_text, statusText) {
                    setTimeout(function() {
                        btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                        showErrorMsg(form, 'danger', statusText);
                    }, 2000);
                }
            });
        });
    }

    var handleResetPasswordFormSubmit = function() {
        $('#m_reset_submit').click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    },
                    password_confirmation: {
                        required: true
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            form.ajaxSubmit({
                url: form.action,
                success: function(response, status, xhr, $form) {
                    // Success
                    if (response.message) {                    
                        setTimeout(function() {
                            btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                            form.clearForm(); // clear form
                            form.validate().resetForm(); // reset validation states;

                            if (response.status) {
                                showErrorMsg(form, 'success', response.message);
                                location.reload();
                            } else {
                                showErrorMsg(form, 'danger', response.message);
                                return;
                            }
                        }, 2000);
                    }
                },
                error: function (xhr, error_text, statusText) {
                    if (xhr.status == 422) {
                        // HTTP_UNPROCESSABLE_ENTITY
                        if (xhr.responseJSON.errors) {                      
                            // Remove previous alers
                            form.find('.alert').remove();

                            btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                            $.each(xhr.responseJSON.errors, function(index, error) {
                                setTimeout(function() {
                                    showErrorMsg(form, 'danger', index+': '+error[0], false);
                                }, 2000);
                            });
                        } else {
                            setTimeout(function() {
                                btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                                showErrorMsg(form, 'danger', statusText);
                            }, 2000);
                        }
                    } else {   
                        setTimeout(function() {
                            btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                            showErrorMsg(form, 'danger', statusText);
                        }, 2000);
                    }
                }
            });
        });
    }

    //== Public Functions
    return {
        // public functions
        init: function() {
            handleFormSwitch();
            handleSignInFormSubmit();
            handleSignUpFormSubmit();
            handleForgetPasswordFormSubmit();
            handleResetPasswordFormSubmit();
        }
    };
}();

//== Class Initialization
jQuery(document).ready(function() {
    SnippetLogin.init();
});