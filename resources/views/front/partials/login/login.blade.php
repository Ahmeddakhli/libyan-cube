@section('title', trans('auth.sign_in'))

<div class="login">
    <h2 class='text-center'>{{ __('auth.sign_in') }}</h1>
        <div class="form-group pw-container">
            <form action="#" class="login-Login" data-parsley-validate>
                @csrf
                <div class="form-group">
                    <input type="text" class='form-control' required name="email" placeholder="{{ __('users.email') }}"
                        required data-parsley-required
                        data-parsley-required-message="{{ __('main.please_enter_your_email') }}"
                        data-parsley-trigger="change focusout" />
                </div>
                <input type="password" class='form-control' name="password" required
                    placeholder="{{ __('users.password') }}" />
                <!-- Button trigger modal -->
                <span class="forgot-pw" data-toggle="modal" data-target="#modal">
                    {{ __('auth.forget_password') }}?
                </span>
            </form>

            <!-- Modal -->
            <div class="modal fade" id="modal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header align-items-center">
                            <h5 class="modal-title">{{ __('auth.forget_password') }}?</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">
                                    <ion-icon name="close-outline"></ion-icon>
                                </span>
                            </button>
                        </div> <!-- ./ modal-header -->
                        <div class="modal-body">
                            <form action="{{ route('password.email') }}" class="forget-Password" method="post">
                                @csrf
                                <div class="form-group m-0">
                                    <input type="email" name="email" class='form-control m-0' required
                                        placeholder="{{ __('users.email') }}" required data-parsley-required
                                        data-parsley-required-message="{{ __('main.please_enter_your_email') }}"
                                        data-parsley-trigger="change focusout">
                                </div>
                            </form>
                        </div> <!-- ./ modal-body -->
                        <div class="modal-footer">
                            <button type='button' class="btn"
                                onclick="forget()">{{ __('auth.reset_password') }}</button>
                        </div>
                    </div> <!-- ./ modal-content-->
                </div> <!-- ./ modal-dialog -->
            </div> <!-- ./ modal -->

        </div> <!-- ./ form-group pw-container -->
        <button type='submit' class="submit" onclick="login()">
            <ion-icon name="lock-closed-sharp"></ion-icon> {{ __('auth.login') }}
        </button>
        {{-- <span class="or">OR</span>
        <div class="login__social">
            <button class="login__social--facebook">
                <ion-icon name="logo-facebook"></ion-icon>
            </button>
            <button class="login__social--google">
                <ion-icon name="logo-google"></ion-icon>
            </button>
        </div> <!-- ./ login__social --> --}}
        <div class="footer">
            <div class="footer-txt"><span>{{ __('auth.not_register') }}?</span></div>
            <div class="footer-link"><a id='registerBtn' href="#">{{ __('auth.create_account') }}</a></div>
        </div>
</div>
@push('scripts')
    <script src="https://parsleyjs.org/dist/parsley.js"></script>

    <script>
        // SELECT PICKER PLUGIN INIT
        $('.users-select').selectpicker();
    </script>
    <!-- Login Request -->
    <script>
        function login() {
            var form = $('.login-Login');

            /* Parsley validate front-end */
            if (!form.parsley().isValid()) {

                form.find('[data-parsley-type]').each(function(i, v) {
                    $(this).parsley().validate({
                        focusInvalid: false,
                        invalidHandler: function() {
                            $(this).find(":input.error:first").focus();
                        }
                    });

                    $('.messages').empty();
                    $('#notification').css('background-color', 'red');
                    $('#notification').fadeIn("slow");
                    $('#notification .messages').append(`<span>` +
                        "{{ trans('main.oh_snap_change_a_few_thing_up_and_try_submitting_again') }}" +
                        `</span> <br>`);
                    $('.dismiss').click(function() {
                        $('#notification').fadeOut('slow')
                    });
                    return;
                });
                form.find('[data-parsley-pattern]').each(function(i, v) {
                    $(this).parsley().validate({
                        focusInvalid: false,
                        invalidHandler: function() {
                            $(this).find(":input.error:first").focus();
                        }
                    });
                    $('.messages').empty();
                    $('#notification').css('background-color', 'red');
                    $('#notification').fadeIn("slow");
                    $('#notification .messages').append(`<span>` +
                        "{{ trans('main.oh_snap_change_a_few_thing_up_and_try_submitting_again') }}" +
                        `</span> <br>`);
                    $('.dismiss').click(function() {
                        $('#notification').fadeOut('slow')
                    });
                    return;
                });
                form.parsley().validate({
                    focusInvalid: false,
                    invalidHandler: function() {
                        $(this).find(":input.error:first").focus();
                    }
                });
                $('.messages').empty();
                $('#notification').css('background-color', 'red');
                $('#notification').fadeIn("slow");
                $('#notification .messages').append(`<span>` +
                    "{{ trans('main.oh_snap_change_a_few_thing_up_and_try_submitting_again') }}" + `</span> <br>`);
                $('.dismiss').click(function() {
                    $('#notification').fadeOut('slow')
                });

                return;
            }

            var url = "{{ route('login') }}";
            var data = $('.login-Login').serialize();
            var headers = {
                'content-type': 'application/json'
            }

            // Block UI
            $.blockUI({
                overlayColor: "#000000",
                type: "loader",
                state: "success",
                message: "{{ trans('main.please_wait') }}"
            });

            // Send Request
            $.post(url, data, headers).done(function(response) {
                // Un Block UI
                $.unblockUI();

                // Empty notificaion messages              
                $('.messages').empty();

                // Notification type 
                if (response.status) {
                    $('#notification').css('background-color', 'green');
                } else {
                    $('#notification').css('background-color', 'red');
                }

                // Display notification
                $('#notification .messages').append(`<span>` + response.message + `</span> <br>`);
                $('#notification').fadeIn("slow");

                // Dismiss notification
                $('.dismiss').click(function() {
                    $('#notification').fadeOut('slow')
                });
                setTimeout(function() {
                    $('#notification').fadeOut('slow')
                }, 2000);


                // Redirect
                if (response.redirect_to) {
                    window.location.href = response.redirect_to;
                } else {
                    window.location.href = "{{ route('home') }}";
                }

            }).fail(function(xhr, error_text, statusText) {
                // Un Block UI
                $.unblockUI();

                // Empty notification message
                $('.messages').empty();

                // Notification type
                $('#notification').css('background-color', 'red');

                // Display notificaion
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    $.each(xhr.responseJSON.errors, function(index, error) {
                        $('#notification .messages').append(`<span>` + error.message + `</span> <br>`);
                    });
                } else {
                    $('#notification .messages').append(`<span>` + statusText + `</span> <br>`);
                }
                $('#notification').fadeIn("slow");

                // Dismiss notification
                $('.dismiss').click(function() {
                    $('#notification').fadeOut('slow')
                });

            });

        }
    </script>

    <!-- Forget password Request  -->
    <script>
        function forget() {

            var form = $('.forget-Password');

            /* Parsley validate front-end */
            if (!form.parsley().isValid()) {

                form.find('[data-parsley-type]').each(function(i, v) {
                    $(this).parsley().validate({
                        focusInvalid: false,
                        invalidHandler: function() {
                            $(this).find(":input.error:first").focus();
                        }
                    });

                    $('.messages').empty();
                    $('#notification').css('background-color', 'red');
                    $('#notification').fadeIn("slow");
                    $('#notification .messages').append(`<span>` +
                        "{{ trans('main.oh_snap_change_a_few_thing_up_and_try_submitting_again') }}" +
                        `</span> <br>`);
                    $('.dismiss').click(function() {
                        $('#notification').fadeOut('slow')
                    });
                    return;
                });
                form.find('[data-parsley-pattern]').each(function(i, v) {
                    $(this).parsley().validate({
                        focusInvalid: false,
                        invalidHandler: function() {
                            $(this).find(":input.error:first").focus();
                        }
                    });
                    $('.messages').empty();
                    $('#notification').css('background-color', 'red');
                    $('#notification').fadeIn("slow");
                    $('#notification .messages').append(`<span>` +
                        "{{ trans('main.oh_snap_change_a_few_thing_up_and_try_submitting_again') }}" +
                        `</span> <br>`);
                    $('.dismiss').click(function() {
                        $('#notification').fadeOut('slow')
                    });
                    return;
                });
                form.parsley().validate({
                    focusInvalid: false,
                    invalidHandler: function() {
                        $(this).find(":input.error:first").focus();
                    }
                });
                $('.messages').empty();
                $('#notification').css('background-color', 'red');
                $('#notification').fadeIn("slow");
                $('#notification .messages').append(`<span>` +
                    "{{ trans('main.oh_snap_change_a_few_thing_up_and_try_submitting_again') }}" + `</span> <br>`);
                $('.dismiss').click(function() {
                    $('#notification').fadeOut('slow')
                });

                return;
            }

            var url = "{{ route('password.email') }}";
            var data = $('.forget-Password').serialize();
            var headers = {
                'content-type': 'application/json'
            }

            // Block UI
            $.blockUI({
                overlayColor: "#000000",
                type: "loader",
                state: "success",
                message: "{{ trans('main.please_wait') }}"
            });

            // Send Request 
            $.post(url, data, headers).done(function(response) {
                // Un Block UI
                $.unblockUI();

                // Empty notificaion messages              
                $('.messages').empty();

                // Notification type 
                if (response.status) {
                    $('#notification').css('background-color', 'green');
                } else {
                    $('#notification').css('background-color', 'red');
                }

                // Display notification
                $('#notification .messages').append(`<span>` + response.message + `</span> <br>`);
                $('#notification').fadeIn("slow");

                // Dismiss notification
                $('.dismiss').click(function() {
                    $('#notification').fadeOut('slow')
                });
                setTimeout(function() {
                    $('#notification').fadeOut('slow')
                }, 2000);

            }).fail(function(xhr, error_text, statusText) {
                // Un Block UI
                $.unblockUI();

                // Empty notification message
                $('.messages').empty();

                // Notification type
                $('#notification').css('background-color', 'red');

                // Display notificaion
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    $.each(xhr.responseJSON.errors, function(index, error) {
                        $('#notification .messages').append(`<span>` + error.message + `</span> <br>`);
                    });
                } else {
                    $('#notification .messages').append(`<span>` + statusText + `</span> <br>`);
                }
                $('#notification').fadeIn("slow");

                // Dismiss notification
                $('.dismiss').click(function() {
                    $('#notification').fadeOut('slow')
                });
            });

        }
    </script>
@endpush
