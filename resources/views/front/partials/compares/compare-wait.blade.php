<div class="default-slider home-units-slider">
    @foreach($wating_to_compare as $unit)
        @include('front.components.compare-wait-box', ['unit' => $unit])
    @endforeach
</div>

<script>
    $('.home-units-slider').not('slick-initialized').slick({
        speed: 1000,
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: false,
        rtl: is_rtl ? true : false,
        prevArrow: '<button class="PrevArrow"><img src="{{URL::asset('front/images/icons/left-chevron.png')}}"></button>',
        nextArrow: '<button class="NextArrow"><img src="{{URL::asset('front/images/icons/right-chevron.png')}}"></button>',
        responsive: [{
            breakpoint: 1200,
            settings: {
                slidesToShow: 3,
            }
        }, {
            breakpoint: 991,
            settings: {
                slidesToShow: 2,
            }
        }, {
            breakpoint: 575,
            settings: {
                slidesToShow: 1,
            }
        }]
    });
</script>

<!-- Up to compare -->
<script>
    $('.up-to-compare').on('click', function(e) {
        e.preventDefault();

        // Get data
        var first_compare_id = $(this).attr('compare-id');
        var last_compare_id = $('#compare-box-2').attr('compare-id'); // Third compare "Last in compares"

        // Request parameters
        var url = "{{route('front.compare.change_order')}}";
        var data = {
            'first_compare_id': first_compare_id,
            'last_compare_id': last_compare_id,
            "_token": "{{ csrf_token() }}",
        };
        var headers = {
            'Content-Type': 'application/json'
        };

        // Send change order request
        $.post(url, data, headers).done(function(response) {
            // Reload compare data
            if (response.status) {
                $('.compares-div').empty().html(response.data.compares)
                $('.compare-wait-div').empty().html(response.data.compare_waiting) 
            }
        });
    });
</script>