@extends('dashboard.layouts.basic')

@section('content')
    <style>
        .fade:not(.show) {
            opacity: 1
        }

    </style>
    <!--begin::Form-->
    <form action="{{ route('terms.update') }}" method="POST" id="update_term_form"
        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async
        data-callback="updateAboutCallback" data-parsley-validate enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" id="id" value="{{ $term->id }}" />
        <input type="hidden" name="type" value="terms_conditions">
        <div class="m-portlet__body">

            <div class="form-group row col-12">
                <div class="repeater col-12">
                    <div data-repeater-list="translations">
                        @foreach ($term->translations as $index => $translation)
                            <div data-repeater-item class="row">
                                <div class="col-6 mt-5">
                                    <label for="language_id">{{ __('cms::cms.language') }}</label>
                                    <select class="form-control" id="language_id" name="language_id" required
                                        data-parsley-required
                                        data-parsley-required-message="{{ __('cms::cms.please_select_the_language') }}"
                                        data-parsley-trigger="change focusout">
                                        <option value="" disabled>{{ __('cms::cms.language') }}</option>
                                        @foreach ($languages as $language)
                                            <option value="{{ $language->id }}"
                                                @if ($translation->language_id == $language->id) selected @endif>{{ $language->code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-6 mt-5">
                                    <label for="title">{{ __('cms::cms.title') }}</label>
                                    <input name="title" id="title" type="text" value="{{ $translation->title }}"
                                        class="form-control" placeholder="{{ __('cms::cms.title') }}"
                                        data-parsley-maxlength="150"
                                        data-parsley-maxlength-message="{{ __('cms::cms.term_max_is_150_characters_long') }}">
                                </div>

                                <div class="col-12 mt-5">
                                    <label for="description">{{ __('cms::cms.description') }}</label>
                                    <textarea name="description" id="description-{{ $index }}" class="form-control description"
                                        placeholder="{{ __('cms::cms.please_enter_the_term') }}" required
                                        data-parsley-required
                                        data-parsley-required-message="{{ __('cms::cms.description') }}"
                                        data-parsley-trigger="change focusout" cols="30"
                                        rows="10">{{ $translation->description }}</textarea>
                                </div>
                                <div class="col-md-2 col-sm-2 mt-auto">
                                    {{-- <label class="control-label">&nbsp;</label> --}}
                                    <a href="javascript:;" data-repeater-delete class="btn btn-brand data-repeater-delete">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        @if (!$term->translations->count())
                            <div data-repeater-item class="row">
                                <div class="col-5 mt-5">
                                    <label for="language_id">{{ __('cms::cms.language') }}</label>
                                    <select class="form-control" id="language_id" name="language_id" required
                                        data-parsley-required
                                        data-parsley-required-message="{{ __('cms::cms.please_select_the_language') }}"
                                        data-parsley-trigger="change focusout">
                                        <option value="" selected disabled>{{ __('cms::cms.language') }}</option>
                                        @foreach ($languages as $language)
                                            <option value="{{ $language->id }}"
                                                @if ($language->id == 1) selected @endif>{{ $language->code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 mt-5">
                                    <label for="title">{{ __('cms::cms.title') }}</label>
                                    <input name="title" id="title" type="text" class="form-control"
                                        placeholder="{{ __('cms::cms.title') }}" data-parsley-maxlength="150"
                                        data-parsley-maxlength-message="{{ __('cms::cms.term_max_is_150_characters_long') }}">
                                </div>

                                <div class="col-12 mt-5">
                                    <label for="description">{{ __('cms::cms.description') }}</label>
                                    <textarea name="description" id="description-0" class="form-control description"
                                        placeholder="{{ __('cms::cms.please_enter_the_term') }}" required
                                        data-parsley-required
                                        data-parsley-required-message="{{ __('cms::cms.description') }}"
                                        data-parsley-trigger="change focusout" cols="30" rows="10"></textarea>
                                </div>
                                <div class="col-md-2 col-sm-2 mt-auto">
                                    {{-- <label class="control-label">&nbsp;</label> --}}
                                    <a href="javascript:;" data-repeater-delete class="btn btn-brand data-repeater-delete">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                    <a href="javascript:;" data-repeater-create id="repeater_btn" class="btn">
                        <i class="fa fa-plus"></i> {{ trans('cms::cms.add_translation') }}
                    </a>
                </div>


            </div>
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions m-form__actions--solid">
                    <div class="row">
                        <div class="col-lg-6">
                            <button type="submit"
                                class="btn btn-success btn-brand">{{ trans('cms::cms.update_term') }}</button>
                        </div>
                    </div>
                </div>
            </div>
    </form>
@endsection

<!--end::Form-->

<!-- Callback function -->
<script>
    function updateAboutCallback() {
        // Close modal
        $('#fast_modal').modal('toggle');
        // Reload datatable
        terms_table.ajax.reload(null, false);
    }
    $('.icon-font').iconpicker();
</script>

@push('scripts')
    <script src="{{ asset('8x/assets/js/repeater.js') }}" type="text/javascript"></script>
    <script src="{{ asset('8x/assets/js/summernote-image-attributes.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.repeater').repeater({
                // (Required if there is a nested repeater)
                // Specify the configuration of the nested repeaters.
                // Nested configuration follows the same format as the base configuration,
                // supporting options "defaultValues", "show", "hide", etc.
                // Nested repeaters additionally require a "selector" field.
                repeaters: [{
                    // (Required)
                    // Specify the jQuery selector for this nested repeater
                    selector: '.inner-repeater'
                }],
                show: function() {
                    // Get items count
                    var items_count = $('.repeater').repeaterVal().translations.length;
                    var current_index = items_count - 1;

                    /* Summernote */
                    // Update the textarea id
                    $(this).find('.note-editor').remove(); // Remove repeated summernote
                    $(this).find('.description').attr('id', 'description-' + current_index);

                    $('#description-' + current_index).summernote({
                        imageTitle: {
                            specificAltField: true,
                        },
                        popover: {
                            image: [
                                ['imagesize', ['imageSize100', 'imageSize50',
                                    'imageSize25'
                                ]],
                                ['float', ['floatLeft', 'floatRight', 'floatNone']],
                                ['remove', ['removeMedia']],
                                ['custom', ['imageAttributes']],
                            ],
                        },
                        height: '300px',
                    });

                    // Showing the item
                    $(this).show();
                }
            });
            @if ($term->translations->count())
                @foreach ($term->translations as $index => $translation)
                    // Summernote
                    $('#description-'+'{{ $index }}').summernote({
                    imageTitle: {
                    specificAltField: true,
                    },
                    popover: {
                    image: [
                    ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                    ['float', ['floatLeft', 'floatRight', 'floatNone']],
                    ['remove', ['removeMedia']],
                    ['custom', ['imageAttributes']],
                    ],
                    },
                    height: '300px',
                    });
                @endforeach
            @else
                // Summernote
                $('#description-'+'0').summernote({
                imageTitle: {
                specificAltField: true,
                },
                popover: {
                image: [
                ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                ['float', ['floatLeft', 'floatRight', 'floatNone']],
                ['remove', ['removeMedia']],
                ['custom', ['imageAttributes']],
                ],
                },
                height: '300px',
                });
            @endif
        });
    </script>
    <script>
        // Initialize select picker for repeated items
        $("#repeater_btn").click(function() {
            setTimeout(function() {
                // $(".selectpicker").selectpicker('refresh');
            }, 100);
        });
    </script>
@endpush
