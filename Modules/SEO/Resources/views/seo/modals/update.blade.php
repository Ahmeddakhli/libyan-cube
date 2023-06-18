@extends('dashboard.layouts.basic')

@section('content')
    <!--begin::Form-->
    <form action="{{ route('seo.update') }}" method="POST" id="update_seo_form"
        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async
        data-callback="updateseoCallback" data-parsley-validate enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" id="id" value="{{ $seo->id }}" />
        <div class="m-portlet__body">
            <div class="fancy-checkbox ">
                <input name="show_short_description" id="show_short_description" type="checkbox"
                    @if ($seo->show_short_description == 1) checked=checked @endif>
                <label for="show_short_description">{{ __('seo::seo.show_short_description') }}</label>
            </div>
            <div class="form-group row">
                <div class="col-12 repeater">
                    <div data-repeater-list="translations">
                        @foreach ($seo->translations as $index => $translation)
                            <div data-repeater-item class="row">
                                <div class="col-6">
                                    <label for="language_id">{{ __('seo::seo.language') }}</label>
                                    <select class="form-control" id="language_id" name="language_id" required
                                        data-parsley-required
                                        data-parsley-required-message="{{ __('seo::seo.please_select_the_language') }}"
                                        data-parsley-trigger="change focusout">
                                        <option value="" disabled>{{ __('seo::seo.language') }}</option>
                                        @foreach ($languages as $language)
                                            <option value="{{ $language->id }}"
                                                @if ($translation->language_id == $language->id) selected @endif>{{ $language->code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-6">
                                    <label for="seo">{{ __('seo::seo.meta_title') }}</label>
                                    <input name="title" id="title" type="text" class="form-control"
                                        placeholder="{{ __('seo::seo.please_enter_the_seo') }}" required
                                        data-parsley-required
                                        data-parsley-required-message="{{ __('seo::seo.please_enter_the_seo') }}"
                                        data-parsley-trigger="change focusout" data-parsley-maxlength="150"
                                        data-parsley-maxlength-message="{{ __('seo::seo.seo_max_is_150_characters_long') }}"
                                        value="{{ $translation->title }}">
                                </div>
                                <div class="col-6">
                                    <label for="popup_contact_us_title">{{ __('seo::seo.popup_contact_us_title') }}</label>
                                    <input name="popup_contact_us_title" id="popup_contact_us_title" type="text"
                                        class="form-control" placeholder="{{ __('seo::seo.popup_contact_us_title') }}"
                                        data-parsley-trigger="change focusout" data-parsley-maxlength="150"
                                        data-parsley-maxlength-message="{{ __('seo::seo.seo_max_is_150_characters_long') }}"
                                        value="{{ $translation->popup_contact_us_title }}">
                                </div>
                                <div class="col-lg-12">
                                    <label for="description">{{ __('seo::seo.meta_description') }} <small
                                            class="text-muted"> - {{ __('seo::seo.optional') }}</small></label>
                                    <textarea rows="6" name="description" id="description" class="form-control description"
                                        placeholder="{{ __('seo::seo.enter_description') }}"
                                        data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295"
                                        data-parsley-maxlength-message="{{ __('seo::seo.description_max_is_4294967295_characters_long') }}"
                                        required data-parsley-required
                                        data-parsley-required-message="{{ __('seo::seo.please_enter_the_seo') }}">{{ $translation->description }}</textarea>
                                </div>
                                <div class="col-6 mt-2">
                                    <label for="key_words">{{ __('seo::seo.key_words') }} <small class="text-muted"> -
                                            {{ __('seo::seo.optional') }}</small></label>
                                    <input name="key_words" id="key_words" type="text"
                                        value="{{ $translation->key_words }}" class="form-control"
                                        placeholder="{{ __('seo::seo.key_words') }}" data-parsley-trigger="change focusout"
                                        data-parsley-maxlength="150"
                                        data-parsley-maxlength-message="{{ __('seo::seo.title_max_is_150_characters_long') }}">
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <label for="short_description">{{ __('seo::seo.description') }} <small
                                            class="text-muted"> - {{ __('seo::seo.optional') }}</small></label>
                                    <textarea rows="6" name="short_description" id="short_description-{{ $index }}"
                                        class="form-control short_description"
                                        placeholder="{{ __('seo::seo.short_description') }}"
                                        data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295"
                                        data-parsley-maxlength-message="{{ __('seo::seo.description_max_is_4294967295_characters_long') }}">{{ $translation->short_description }}</textarea>
                                </div>
                                <div class="col-md-2 col-sm-2">
                                    {{-- <label class="control-label">&nbsp;</label> --}}
                                    <a href="javascript:;" data-repeater-delete class="btn btn-brand data-repeater-delete">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        @if (!$seo->translations->count())
                            <div data-repeater-item class="row">
                                <div class="col-6">
                                    <label for="language_id">{{ __('seo::seo.language') }}</label>
                                    <select class="form-control" id="language_id" name="language_id" required
                                        data-parsley-required
                                        data-parsley-required-message="{{ __('seo::seo.please_select_the_language') }}"
                                        data-parsley-trigger="change focusout">
                                        <option value="" selected disabled>{{ __('seo::seo.language') }}</option>
                                        @foreach ($languages as $language)
                                            <option value="{{ $language->id }}"
                                                @if ($language->id == 1) selected @endif>{{ $language->code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="title">{{ __('seo::seo.meta_title') }}</label>
                                    <input name="title" id="title" type="text" class="form-control"
                                        placeholder="{{ __('seo::seo.please_enter_the_seo') }}" required
                                        data-parsley-required
                                        data-parsley-required-message="{{ __('seo::seo.please_enter_the_seo') }}"
                                        data-parsley-trigger="change focusout" data-parsley-maxlength="150"
                                        data-parsley-maxlength-message="{{ __('seo::seo.seo_max_is_150_characters_long') }}">
                                </div>
                                <div class="col-lg-12">
                                    <label for="description">{{ __('seo::seo.meta_description') }} <small
                                            class="text-muted"> - {{ __('seo::seo.optional') }}</small></label>
                                    <textarea rows="6" name="description" id="description" class="form-control description"
                                        placeholder="{{ __('seo::seo.enter_description') }}"
                                        data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295"
                                        data-parsley-maxlength-message="{{ __('seo::seo.description_max_is_4294967295_characters_long') }}"
                                        required data-parsley-required
                                        data-parsley-required-message="{{ __('seo::seo.please_enter_the_seo') }}"></textarea>
                                </div>
                                <div class="col-6 mt-2">
                                    <label for="key_words">{{ __('seo::seo.key_words') }} <small class="text-muted"> -
                                            {{ __('seo::seo.optional') }}</small></label>
                                    <input name="key_words" id="key_words" type="text" class="form-control"
                                        placeholder="{{ __('seo::seo.key_words') }}" data-parsley-trigger="change focusout"
                                        data-parsley-maxlength="150"
                                        data-parsley-maxlength-message="{{ __('seo::seo.title_max_is_150_characters_long') }}">
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <label for="short_description">{{ __('seo::seo.description') }} <small
                                            class="text-muted"> - {{ __('seo::seo.optional') }}</small></label>
                                    <textarea rows="6" name="short_description" id="short_description-0" class="form-control short_description"
                                        placeholder="{{ __('seo::seo.short_description') }}"
                                        data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295"
                                        data-parsley-maxlength-message="{{ __('seo::seo.description_max_is_4294967295_characters_long') }}"></textarea>
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
                        <i class="fa fa-plus"></i> {{ trans('seo::seo.add_seo_translation') }}
                    </a>
                </div>

                <div class="form-group row">
                    <div class="col-12">
                        <label>{{ trans('seo::seo.page') }}</label>
                        <select class="form-control" id="page" name="page" required data-parsley-required
                            data-parsley-required-message="{{ __('seo::seo.page') }}"
                            data-parsley-trigger="change focusout">
                            <option value="" selected disabled>{{ __('seo::seo.page') }}</option>
                            @foreach (['home', 'projects', 'properties', 'contact', 'careers', 'developers', 'about', 'blogs', 'unit_types', 'terms', 'privacy', 'sell_unit'] as $page)
                                <option value="{{ $page }}" @if ($page == $seo->page) selected @endif>
                                    {{ __('seo::seo.' . $page) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions m-form__actions--solid">
                    <div class="row">
                        <div class="col-lg-6">
                            <button type="submit"
                                class="btn btn-success btn-brand">{{ trans('seo::seo.update_seo') }}</button>
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
    function updateseoCallback() {
        // Close modal
        $('#fast_modal').modal('toggle');
        // Reload datatable
        $('#seo_table').DataTable().ajax.reload(null, false);
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
                    $(this).find('.short_description').attr('id', 'short_description-' + current_index);

                    $('#short_description-' + current_index).summernote({
                        height: 150, //set editable area's height
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
                    });

                    // Showing the item
                    $(this).show();
                }
            });
            @if ($seo->translations->count())
                @foreach ($seo->translations as $index => $translation)
                    // Summernote
                    $('#short_description-' + '{{ $index }}').summernote({
                    height: 150, //set editable area's height
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
                    });
                @endforeach
            @else
                // Summernote
                $('#short_description-' + '0').summernote({
                height: 150, //set editable area's height
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
