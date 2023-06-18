

<!-- START BREADCRUMB -->
<nav aria-label="breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('front.home')}}">الرئيسيه</a></li>
            <li class="breadcrumb-item active" aria-current="page">المقارنه</li>
        </ol>
    </div>
</nav>
<!-- END BREADCRUMB -->

<!-- START VIEW BLOG  -->
<section class="compare-page pb-5">
    <div class="container">
        <div class="row">
            @foreach($compares as $compare)
            @include('front.components.compare-box', ['compare' => $compare])
            @endforeach

        </div>
        <form class="export-form" action="{{route('front.compares.export')}}" method="Post">
            @csrf
            <input type="hidden" name="data" value="{{json_encode($compares)}}">
        </form>
        <div class="pdf mt-5">
            <a href="#" class="site-btn" data-toggle="modal" data-target="#log-modal" download>
                <span class="txt">تصدير بصيغة pdf</span>
                <em></em>
            </a>
        </div>
        <!-- <div class="pagination-wrap">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a href="#" class="page-link">
                        <span class="material-icons">chevron_right</span>
                    </a>
                </li>
                <li class="page-item active">
                    <a href="#" class="page-link">1</a>
                </li>
                <li class="page-item">
                    <a href="#" class="page-link">2</a>
                </li>
                <li class="page-item">
                    <a href="#" class="page-link">3</a>
                </li>
                <li class="page-item">
                    <a href="#" class="page-link">
                        <span class="material-icons">chevron_left</span>
                    </a>
                </li>
            </ul>
        </div> -->
    </div>
</section>
<!-- END VIEW BLOG  -->
@push('scripts')
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
            // Notification type 
            $(`#compare-box-${id}`).fadeOut();
            if (response.status) {
                $.alert(response.message, {
                title: '',
                type: 'info',
                position: ['top-right', [0, 20]],
            });

            } else {
                $.alert(response.message, {
                title: '',
                type: 'warning',
                position: ['top-right', [0, 20]],
            });
            }

        }).fail(function(xhr, error_text, statusText) {

            // Display notificaion
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                $.each(xhr.responseJSON.errors, function(index, error) {
                    $.alert(error.message, {
                title: '',
                type: 'warning',
                position: ['top-right', [0, 20]],
            });

                });
            } else {
                $.alert(statusText, {
                title: '',
                type: 'warning',
                position: ['top-right', [0, 20]],
            });

            }
        });
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
<!-- Contact Form -->
<script>
    $('.contact-from-compare').on('click', function() {
        var form = $(this).closest('form');

        /* Parsley validate front-end */
        if (!form.parsley().isValid()) {
            // Display notification
            $.alert("{{__('main.oh_snap_change_a_few_thing_up_and_try_submitting_again')}}", {
                title: '',
                type: 'warning',
                position: ['top-right', [0, 20]],
            });

            form.find('[data-parsley-type]').each(function(i, v) {
                $(this).parsley().validate({
                    focusInvalid: false,
                    invalidHandler: function() {
                        $(this).find(":input.error:first").focus();
                    }
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

        // Request parameters
        var url = "{{route('contact_us.contact_us.store')}}";
        var data = $('.form-contact').serialize();
        var headers = {
            'content-type': 'appliction/json'
        };

        // Block UI
        $.blockUI({
            overlayColor: "#000000",
            type: "loader",
            state: "success",
            message: "{{trans('main.please_wait')}}"
        });

        // Send the request
        $.post(url, data, headers).done(function(response) {

            // Unblock UI     
            $.unblockUI();

            // Notification message
            if (response.message) {
                // Empty notificaion messages              
                $('.messages').empty();

                // Notification type
                if (response.status) {
                    $.alert(response.message, {
                        title: '',
                        type: 'info',
                        position: ['top-right', [0, 20]],
                    });

                    $('.export-form').submit();
                } else {
                    $.alert(response.message, {
                        title: '',
                        type: 'warning',
                        position: ['top-right', [0, 20]],
                    });
                }

            }
        }).fail(function(xhr, error_text, statusText) {
            // Unblock UI            
            $.unblockUI();

            // Display notificaion
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                $.each(xhr.responseJSON.errors, function(index, error) {
                    $.alert(error.message, {
                        title: '',
                        type: 'warning',
                        position: ['top-right', [0, 20]],
                    });

                });
            } else {
                $.alert(statusText, {
                title: '',
                type: 'warning',
                position: ['top-right', [0, 20]],
            });
            }
        });
    });
</script>
@endpush