@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('front.home') }}">{{ __('main.home_title') }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('main.careers') }}</li>
            </ol>
        </div>
    </nav>
@endsection

<section class="careers-page pb-5">

    <div class="container">
        <div class="section-title">
            <h1 class='title h2'>{{ __('main.join_us_to_improve_the') }} {{ __('main.future_of_work') }}</h1>
        </div>

        <div class="row mt-4">

            <div class="col-md-6">
                <div class="job-vacancies">

                    <div class="accordion">
                        @foreach ($careers as $career)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#tab-{{ $career->id }}" aria-expanded="true">
                                        {{ $career->title }}
                                    </button>
                                </h2>
                                <div id="tab-{{ $career->id }}"
                                    class="accordion-collapse {{ $loop->index == 0 ? 'collapse show' : '' }}">
                                    <div class="accordion-body">
                                        <h5 class="qualifications text-capitalize mb-4">{{ __('main.qualifications') }}
                                            :</h5>
                                        {!! $career->description !!}
                                        <ul class='qualifications-list'>
                                            <li>{{ __('careers::career.number') }} : {{ $career->number }}</li>
                                        </ul>
                                        <div class="apply text-end mt-3">
                                            <a class='site-btn text-uppercase apply-button'
                                                career-title="{{ $career->title }}" career-id="{{ $career->id }}"
                                                href="#apply-career-modal"
                                                data-bs-toggle="modal">{{ __('main.apply_now') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>

            <div class="col-md-6 d-none d-md-block">
                <div class="">
                    <img class="img-fluid" src="{{ asset('front/assets/careers-bg.png') }}" alt="">
                </div>
            </div>

        </div>
    </div>
</section>

<!-- END careers-page  -->
@push('scripts')
    <script>
        $('.panel-collapse').on('shown.bs.collapse', function(e) {
            const $panel = $(this).attr("id");
            $('html, body').animate({
                scrollTop: $('#' + $panel).offset().top - 150
            }, 500);
        });
    </script>
    <script>
        $(document).on('click', '.apply-button', function() {
            let careerTitle = $(this).attr('career-title');
            let careerId = $(this).attr('career-id');
            $('.job-title').val(careerTitle);
            $('.job-title-header').html(careerTitle);
            $('.career-id-hidden').val(careerId);
        });
    </script>

    <script>
        $('.apply-from').on('click', function() {
            var form = $(this).closest('form');
            $.blockUI({
                overlayColor: "#000000",
                type: "loader",
                state: "success",
                message: "<img src='{{ URL::asset('front/images/loader.gif') }}'/>"
            });
            /* Parsley validate front-end */
            if (!form.parsley().isValid()) {
                $.unblockUI();

                $.alert("{{ __('main.oh_snap_change_a_few_thing_up_and_try_submitting_again') }}", {
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

            var form = document.getElementById('apply-form');

            // Send Request
            $.ajax({
                url: "{{ route('careers.apply') }}",
                method: 'POST',
                data: new FormData(form),
                processData: false,
                contentType: false,
            }).done(function(response) {
                // Un Block UI
                $.unblockUI();

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
                // Un Block UI
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
