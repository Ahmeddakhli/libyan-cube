@extends('dashboard.layouts.basic')

@section('content')
    <!--begin::Form-->
    <form action="{{ route('careers.update') }}" method="POST" id="update_career_form"
        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async
        data-callback="updateCareerCallback" data-parsley-validate enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" id="id" value="{{ $career->id }}" />
        <div class="m-portlet__body">
            <div class="fancy-checkbox ">
                <input name="is_featured" id="is_featured" type="checkbox"
                    @if ($career->is_featured == 1) checked=checked @endif>
                <label for="is_featured">{{ __('careers::career.is_featured') }}</label>
            </div>
            <div class="form-group row">
                <div class="col-12 repeater">
                    <div data-repeater-list="translations">
                        @foreach ($career->translations as $index => $translation)
                            <div data-repeater-item class="row">
                                <div class="col-6">
                                    {{-- <label for="language_id">{{__('careers::career.language')}}</label> --}}
                                    <select class="form-control" id="language_id" name="language_id" required
                                        data-parsley-required
                                        data-parsley-required-message="{{ __('careers::career.please_select_the_language') }}"
                                        data-parsley-trigger="change focusout">
                                        <option value="" disabled>{{ __('careers::career.language') }}</option>
                                        @foreach ($languages as $language)
                                            <option value="{{ $language->id }}"
                                                @if ($translation->language_id == $language->id) selected @endif>{{ $language->code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-6">
                                    {{-- <label for="career">{{__('careers::career.career')}}</label> --}}
                                    <input name="title" id="title" type="text" class="form-control"
                                        placeholder="{{ __('careers::career.please_enter_the_career') }}" required
                                        data-parsley-required
                                        data-parsley-required-message="{{ __('careers::career.please_enter_the_career') }}"
                                        data-parsley-trigger="change focusout" data-parsley-maxlength="150"
                                        data-parsley-maxlength-message="{{ __('careers::career.career_max_is_150_characters_long') }}"
                                        value="{{ $translation->title }}">
                                </div>
                                <div class="col-lg-12">
                                    <label for="description">{{ __('careers::career.description') }} <small
                                            class="text-muted"> -
                                            {{ __('careers::career.optional') }}</small></label>
                                    <textarea rows="6" name="description" id="description-{{ $index }}" class="form-control description"
                                        placeholder="{{ __('careers::career.enter_description') }}"
                                        data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295"
                                        data-parsley-maxlength-message="{{ __('careers::career.description_max_is_4294967295_characters_long') }}"
                                        required data-parsley-required
                                        data-parsley-required-message="{{ __('careers::career.please_enter_the_career') }}">{{ $translation->description }}</textarea>
                                </div>
                                <div class="col-6 mt-2">
                                    <label for="meta_title">{{ __('careers::career.meta_title') }} <small
                                            class="text-muted"> -
                                            {{ __('careers::career.optional') }}</small></label>
                                    <input name="meta_title" id="meta_title" type="text" class="form-control"
                                        value="{{ $translation->meta_title }}"
                                        placeholder="{{ __('careers::career.meta_title') }}"
                                        data-parsley-trigger="change focusout" data-parsley-maxlength="150"
                                        data-parsley-maxlength-message="{{ __('careers::career.title_max_is_150_characters_long') }}">
                                </div>
                                <div class="col-lg-6 mt-2">
                                    <label for="meta_description">{{ __('careers::career.meta_description') }} <small
                                            class="text-muted"> -
                                            {{ __('careers::career.optional') }}</small></label>
                                    <textarea rows="6" name="meta_description" id="meta_description" class="form-control"
                                        placeholder="{{ __('careers::career.meta_description') }}"
                                        data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295"
                                        data-parsley-maxlength-message="{{ __('careers::career.description_max_is_4294967295_characters_long') }}">{{ $translation->meta_description }}</textarea>
                                </div>
                                <div class="col-md-2 col-sm-2">
                                    {{-- <label class="control-label">&nbsp;</label> --}}
                                    <a href="javascript:;" data-repeater-delete class="btn btn-brand data-repeater-delete">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        @if (!$career->translations->count())
                            <div data-repeater-item class="row">
                                <div class="col-6">
                                    {{-- <label for="language_id">{{__('careers::career.language')}}</label> --}}
                                    <select class="form-control" id="language_id" name="language_id" required
                                        data-parsley-required
                                        data-parsley-required-message="{{ __('careers::career.please_select_the_language') }}"
                                        data-parsley-trigger="change focusout">
                                        <option value="" selected disabled>{{ __('careers::career.language') }}</option>
                                        @foreach ($languages as $language)
                                            <option value="{{ $language->id }}"
                                                @if ($language->id == 1) selected @endif>{{ $language->code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    {{-- <label for="title">{{__('careers::career.career')}}</label> --}}
                                    <input name="title" id="title" type="text" class="form-control"
                                        placeholder="{{ __('careers::career.please_enter_the_career') }}" required
                                        data-parsley-required
                                        data-parsley-required-message="{{ __('careers::career.please_enter_the_career') }}"
                                        data-parsley-trigger="change focusout" data-parsley-maxlength="150"
                                        data-parsley-maxlength-message="{{ __('careers::career.career_max_is_150_characters_long') }}">
                                </div>
                                <div class="col-lg-12">
                                    <label for="description">{{ __('careers::career.description') }} <small
                                            class="text-muted"> -
                                            {{ __('careers::career.optional') }}</small></label>
                                    <textarea rows="6" name="description" id="description-0" class="form-control description"
                                        placeholder="{{ __('careers::career.enter_description') }}"
                                        data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295"
                                        data-parsley-maxlength-message="{{ __('careers::career.description_max_is_4294967295_characters_long') }}"
                                        required data-parsley-required
                                        data-parsley-required-message="{{ __('careers::career.please_enter_the_career') }}"></textarea>
                                </div>
                                <div class="col-6 mt-2">
                                    <label for="meta_title">{{ __('careers::career.meta_title') }}</label>
                                    <input name="meta_title" id="meta_title" type="text" class="form-control" value=""
                                        placeholder="{{ __('careers::career.meta_title') }}"
                                        data-parsley-trigger="change focusout" data-parsley-maxlength="150"
                                        data-parsley-maxlength-message="{{ __('careers::career.title_max_is_150_characters_long') }}">
                                </div>
                                <div class="col-lg-6 mt-2">
                                    <label for="meta_description">{{ __('careers::career.meta_description') }} <small
                                            class="text-muted"> -
                                            {{ __('careers::career.optional') }}</small></label>
                                    <textarea rows="6" name="meta_description" id="meta_description" class="form-control" value=""
                                        placeholder="{{ __('careers::career.meta_description') }}"
                                        data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295"
                                        data-parsley-maxlength-message="{{ __('careers::career.description_max_is_4294967295_characters_long') }}"></textarea>
                                </div>


                                <div class="col-md-2 col-sm-2">
                                    {{-- <label class="control-label">&nbsp;</label> --}}
                                    <a href="javascript:;" data-repeater-delete class="btn btn-brand data-repeater-delete">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                    <a href="javascript:;" data-repeater-create id="repeater_btn" class="btn">
                        <i class="fa fa-plus"></i> {{ trans('careers::career.add_career_translation') }}
                    </a>
                </div>

                <div class="form-group row col-12">
                    <div class="col-8">
                        <label>{{ trans('careers::career.number') }}</label>
                        <input name="number_of_available_vacancies" value="{{ $career->number_of_available_vacancies }}"
                            class="form-control" type="number" placeholder="{{ trans('careers::career.number') }}"
                            data-parsley-trigger="change focusout" required data-parsley-required
                            data-parsley-required-message="{{ __('careers::career.please_enter_the_number_of_available_vacancies') }}" />
                    </div>
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions m-form__actions--solid">
                    <div class="row">
                        <div class="col-lg-6">
                            <button type="submit"
                                class="btn btn-success btn-brand">{{ trans('careers::career.update_career') }}</button>
                        </div>
                    </div>
                </div>
            </div>
    </form>
@endsection

<!--end::Form-->
<script>
    $('.m_selectpicker').selectpicker();
</script>
<!-- Callback function -->
<script>
    function updateCareerCallback() {
        // Close modal
        $('#fast_modal').modal('toggle');
        // Reload datatable
        $('#careers_table').DataTable().ajax.reload(null, false);
    }
</script>

@push('scripts')
    <script src="{{ URL::asset('8x/assets/js/repeater.js') }}" type="text/javascript"></script>
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
            @if ($career->translations->count())
                @foreach ($career->translations as $index => $translation)
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
