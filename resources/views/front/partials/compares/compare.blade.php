@foreach($compares as $compare)
    @include('front.components.compare-box', ['compare' => $compare])
@endforeach

<script>
    $('.prop-to-compare').not('slick-initialized').slick({
        autoplay: true,
        pauseOnDotsHover: true,
        speed: 1000,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        rtl: is_rtl ? true : false,
        customPaging: function(slider, i) {
            var totalSlides = slider.slideCount;
            return `
                <ion-icon name="videocam-sharp"></ion-icon>
                <span class='total'>
                    ${totalSlides}
                </span>  `
        },
        arrows: true,
        prevArrow: '<button class="PrevArrow"><ion-icon name="chevron-back-outline"></ion-icon></button>',
        nextArrow: '<button class="NextArrow"><ion-icon name="chevron-forward-outline"></ion-icon></button>',
    });
</script>

<!-- Delete to Compare -->
<script>
    $('.remove-from-compare').on('click', function(e) {
        e.preventDefault();

        // Request parameters
        var id = $(this).attr('compare-id');
        var url = "{{route('compare.delete')}}";
        var headers = {
            'content-type': 'appliction/json'
        };
        var data = {
            "_token": "{{ csrf_token() }}",
            'id': id
        }

        // Send Request
        $.post(url, data, headers).done(function(response) {
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

            // Dismiss
            $('.dismiss').click(function() {
                $('#notification').fadeOut('slow')
            });
            setTimeout(function() {
                $('#notification').fadeOut('slow')
            }, 2000);

            // Reload compare data
            var reload_url = "{{route('front.compares.reload')}}";

            // Send Request 
            $.get(reload_url).done(function(response) {
                $('.compares-div').empty().html(response.data.compares)
                $('.compare-wait-div').empty().html(response.data.compare_waiting)
            });

        }).fail(function(xhr, error_text, statusText) {

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
    });
</script>