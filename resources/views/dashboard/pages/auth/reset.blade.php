@extends('front.layouts.main')

@section('content')
    <!--  START CONTACT US  -->
    <section class="contact-page py-5">
        <div class="container col-md-4">
            <div class="contact-form">
                <form method="POST" action="{{route('password.update')}}" class="form-contact rest-from">
                    @csrf
                    <input type="hidden" name="token" value="{{$token}}">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input class="form-control m-input" type="text" value="{{ old('email') }}" placeholder="{{trans('auth.email')}}" name="email" autocomplete="off" id="email">
                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input class="form-control m-input m-login__form-input--last" type="password" placeholder="{{trans('auth.password')}}" name="password" id="password">
                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input class="form-control m-input m-login__form-input--last" type="password" placeholder="{{trans('auth.password_confirmation')}}" name="password_confirmation" id="password_confirmation">
                                @if ($errors->has('password_confirmation'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <input type="button" id="m_reset_submit" class="submit-rest" value="{{trans('auth.reset_password')}}">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $('#m_reset_submit').click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            /* Parsley validate front-end */
            if (!form.parsley().isValid()) {  
				// Display notification                
                $('.messages').empty();
                $('#notification').css('background-color', 'red');
                $('#notification .messages').append(`<span>` + "{{trans('main.oh_snap_change_a_few_thing_up_and_try_submitting_again')}}" + `</span> <br>`);
                $('#notification').fadeIn("slow");
                $('.dismiss').click(function() {
                    $('#notification').fadeOut('slow')
                });

                form.find( '[data-parsley-type]' ).each( function( i , v ){
                    $(this).parsley().validate({
                        focusInvalid: false,
                        invalidHandler: function() {
                            $(this).find(":input.error:first").focus();
                        }
                    });

                    return;
                });
                form.find( '[data-parsley-pattern]' ).each(function( i, v ) {
                    $(this).parsley().validate({
                        focusInvalid: false,
                        invalidHandler: function() {
                            $(this).find(":input.error:first").focus();
                        }
                    });

                    return;
                });
                form.parsley().validate({
                    focusInvalid: false,
                    invalidHandler: function() {
                        $(this).find(":input.error:first").focus();
                    }
                });

                return;
            }

             // Block UI
             $.blockUI({
                overlayColor: "#000000",
                type: "loader",
                state: "success",
                message: "{{trans('main.please_wait')}}"
            });

            $.ajax({
                url:"{{route('password.update')}}",
                method: 'POST',
                data:$('.rest-from').serialize(),
                success: function(response, status, xhr, $form) {
                    // Unblock UI
                    $.unblockUI();

                    // Notification message
                    if (response.message) {  
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
                        $('.dismiss').click(function() {
                            $('#notification').fadeOut('slow')
                        });

                        window.location.replace("{{route('front.home')}}");
                    }
                },
                error: function (xhr, error_text, statusText) {
                     // Unblock UI
                    $.unblockUI();

                    // Empty notification messages
                    $('.messages').empty();

                    // Notification type
                    $('#notification').css('background-color', 'red');

                    // Display notificaion
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        $.each(xhr.responseJSON.errors, function(index, error) {
                            $('#notification .messages').append(`<span>` + error + `</span> <br>`);
                        });
                    } else {
                        $('#notification .messages').append(`<span>` + statusText + `</span> <br>`);
                    }
                    $('#notification').fadeIn("slow");
                    $('.dismiss').click(function() {
                        $('#notification').fadeOut('slow')
                    });
                }
            });
        });
    </script>
@endpush