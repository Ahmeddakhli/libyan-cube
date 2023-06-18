 <!-- ./ login -->
<form action="#" method="POST"  class="login-Register" data-parsley-validate>
     @csrf
     <div class="register">
         <h2 class='text-center'>{{__('users.create_user')}}</h2>
         <div class="form-group m-0">
            <select class='dropdown-select users-select form-control' name="group_id"  title='{{trans('main.who_are_you')}}' required data-parsley-required data-parsley-required-message="{{__('main.who_you_are_required')}}" data-parsley-trigger="change focusout" data-parsley-errors-container="#who_error_container">
                @foreach($groups as $group)
                    <option value="{{$group->id}}">{{trans('main.'.$group->slug)}}</option>
                @endforeach
            </select>
            <div id="who_error_container" class="error_container"></div>
         </div> <!-- ./ form-group -->
         <div class="form-group">
             <input type="text" class='form-control' name="username" placeholder="{{__('users.username')}}" required data-parsley-required data-parsley-required-message="{{__('users.username_is_required')}}" data-parsley-trigger="change focusout" />
         </div>
         <div class="form-group">
             <input type="text" class='form-control' name="full_name" placeholder="{{__('users.full_name')}}" required data-parsley-required data-parsley-required-message="{{__('main.please_enter_your_name')}}" data-parsley-trigger="change focusout" />
         </div>
         <div class="form-group">
             <input type="text" class='form-control' name="email" placeholder="{{__('users.email')}}" required data-parsley-required data-parsley-required-message="{{__('main.please_enter_your_email')}}" data-parsley-trigger="change focusout"/>
         </div>
         <div class="form-group">
             <input type="text" class='form-control' name="mobile_number" placeholder="{{__('users.mobile_number')}}" required data-parsley-required data-parsley-required-message="{{__('users.please_enter_the_mobile_number')}}" data-parsley-trigger="change focusout" />
         </div>
         <div class="form-group">
             <input type="password" class='form-control' name="password" placeholder="{{__('users.password')}}" required data-parsley-required data-parsley-required-message="{{__('users.please_enter_the_password')}}" data-parsley-trigger="change focusout" />
         </div>
         <div class="form-group">
             <input type="password" class='form-control' name="password_confirmation" placeholder="{{__('users.password_confirmation')}}" required data-parsley-required data-parsley-required-message="{{__('users.please_enter_the_password_confirmation')}}" data-parsley-trigger="change focusout" />
         </div>
         <button type='button' class="submit" onclick="register();" >
             <ion-icon name="lock-closed-sharp"></ion-icon> {{__('main.register')}}
         </button>
         <div class="footer">
             <div class="footer-txt"><span>{{__('auth.already_registered')}}?</span></div>
             <div class="footer-link"><a id='logBtn' href="#">{{__('auth.login')}}</a></div>
         </div>
     </div>
</form>
@push('scripts')
    <!-- Register -->
    <script>
        function register() {
            var form = $('.login-Register');

            /* Parsley validate front-end */
            if (!form.parsley().isValid()) {  
                
                form.find( '[data-parsley-type]' ).each( function( i , v ){
                    $(this).parsley().validate({
                        focusInvalid: false,
                        invalidHandler: function() {
                            $(this).find(":input.error:first").focus();
                        }
                    });

                    $('.messages').empty();
                    $('#notification').css('background-color', 'red');
                    $('#notification').fadeIn("slow");
                    $('#notification .messages').append(`<span>` + "{{trans('main.oh_snap_change_a_few_thing_up_and_try_submitting_again')}}" + `</span> <br>`);
                    $('.dismiss').click(function() {
                        $('#notification').fadeOut('slow')
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
                    $('.messages').empty();
                    $('#notification').css('background-color', 'red');
                    $('#notification').fadeIn("slow");
                    $('#notification .messages').append(`<span>` + "{{trans('main.oh_snap_change_a_few_thing_up_and_try_submitting_again')}}" + `</span> <br>`);
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
                $('#notification .messages').append(`<span>` + "{{trans('main.oh_snap_change_a_few_thing_up_and_try_submitting_again')}}" + `</span> <br>`);
                $('.dismiss').click(function() {
                    $('#notification').fadeOut('slow')
                });

                return;
            }

            var url = "{{ route('register') }}";
            var data = $('.login-Register').serialize();
            var headers = {
                'content-type': 'application/json'
            }

            // Block UI 
            $.blockUI({
                overlayColor: "#000000",
                type: "loader",
                state: "success",
                message: "{{trans('main.please_wait')}}"
            });

            // Send Request 
            $.post(url, data, headers).done(function(response) {
                // Un Block UI
                $.unblockUI();
                
                // Empty notificaion messages              
                $('.messages').empty();

                // Notification type 
                if(response.status){
                    $('#notification').css('background-color', 'green');
                }else{
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