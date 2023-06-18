@if (collect($contacts)->where('type', 'whatsapp')->first() || auth()->check())
    <nav class="chat" title='{{trans('main.contact_us')}}'>
        <input type="checkbox" id="chat__input">
        <label class="chat__btn" for="chat__input">
            <ion-icon name="chatbubble-ellipses-outline"></ion-icon>
        </label>
        <!-- <a href="#" class="chat__messanger" title='Messanger'>
            <ion-icon name="flash-outline"></ion-icon>
        </a> -->
        @if(collect($contacts)->where('type', 'whatsapp')->first())
            <a href="https://api.whatsapp.com/send?phone={{collect($contacts)->where('type', 'whatsapp')->first()->contact}}" class="chat__whatsapp" title='{{trans('main.whatsapp')}}' target="_blank">
                <ion-icon name="logo-whatsapp"></ion-icon>
            </a>
        @endif
        @if(auth()->check())
            <a href="#" class="chat__zoom zoom_request" title='{{trans('main.zoom_meeting')}}'>
                <ion-icon name="videocam"></ion-icon>
            </a>
        @endif
    </nav>
    @push('scripts')
        <script>
            $('.zoom_request').on('click',function(e){
                e.preventDefault();

                // Request parameters
                var url ="{{route('meetings.store')}}";
                var data = {
                    'user_id':"{{ auth()->user() ? auth()->user()->id : ''}}",
                    'meeting_type':"zoom_meeting",
                    "_token": "{{ csrf_token() }}",
                }
                var headers = {
                    'Content-Type':'application/json'
                };

                // Send the request
                $.post(url, data, headers).done(function(response) {
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
                        
                        // Dismiss notification
                        setTimeout(function() {
                            $('#notification').fadeOut('slow')
                        }, 2000);
                    }
                }).fail(function(xhr, error_text, statusText) {
                    // Empty notification messages
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
            });
        </script>
    @endpush
@endif