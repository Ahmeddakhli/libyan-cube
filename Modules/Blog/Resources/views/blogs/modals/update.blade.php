@extends('8x.layouts.main')
@section('title', trans('blog::blog.update_blog'))

@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <!-- begin:: Subheader -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title" data-8xloadtitle>{{ __('blog::blog.create_blog') }}</h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="{{ route('home') }}" class="kt-subheader__breadcrumbs-home"><i class="fa fa-home"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>

                    @if (auth()->user()->hasPermission('index-blog-blogs'))
                        <a href="{{ route('blogs.index') }}" data-8xload
                            class="kt-subheader__breadcrumbs-link">{{ __('blog::blog.blogs') }}</a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                    @else
                        <a href="#" class="kt-subheader__breadcrumbs-link">{{ __('blog::blog.blogs') }}</a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                    @endif

                    <span
                        class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">{{ __('blog::blog.create_blog') }}</span>
                </div>
            </div>
        </div>
        <!-- end:: Subheader -->

        <!-- begin:: Content -->
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
            <div class="row">
                <div class="col-lg-12">
                    <!--begin::Portlet-->
                    <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">{{ __('blog::blog.create_blog') }}</h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <a href="{{ url()->previous() }}" class="btn btn-clean kt-margin-r-10">
                                    <i class="la la-arrow-left"></i>
                                    <span class="kt-hidden-mobile">{{ __('main.back') }}</span>
                                </a>
                            </div>
                        </div>


                        <div class="kt-portlet__body">
                            <!--begin::Form-->
                            <form action="{{ route('blogs.update') }}" method="POST" id="update_blog_form"
                                class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async
                                data-parsley-validate enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" id="id" value="{{ $blog->id }}" />
                                <input type="hidden" name="creation_type" class="creation_type">

                                <div class="form-group row">
                                    <div class="fancy-checkbox col-6 mb-2">
                                        <input name="is_featured" id="is_featured" type="checkbox"
                                            @if ($blog->is_featured == 1) checked=checked @endif>
                                        <label for="is_featured">{{ __('blog::blog.is_featured') }}</label>
                                    </div>
                                    <div class="fancy-checkbox col-6 mb-2">
                                        <input name="is_published" id="is_published" type="checkbox"
                                            @if ($blog->published_at) checked=checked @endif>
                                        <label for="is_published">{{ __('blog::blog.is_published') }}</label>
                                    </div>
                                    <div class="col-6 pr-0 form-group">
                                        <label for="category_ids">{{ __('blog::blog.blog_category') }}</label>
                                        <select class="form-control selectpicker" id="category_ids" name="category_ids[]"
                                            multiple required data-parsley-required
                                            data-parsley-required-message="{{ __('blog::blog.please_select_the_blog_category') }}"
                                            data-parsley-trigger="change focusout">
                                            <option value="" selected disabled>{{ __('blog::blog.blog_category') }}
                                            </option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    @if (in_array($category->id,collect($blog->categories)->pluck('id')->toArray())) selected @endif>
                                                    {{ $category->value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="video">{{ __('blog::blog.video') }} <small class="text-muted">
                                                - {{ __('blog::blog.optional') }}</small></label>
                                        <textarea rows="3" name="video" id="video" class="form-control" placeholder="{{ __('blog::blog.video') }}"
                                            data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295"
                                            data-parsley-maxlength-message="{{ __('blog::blog.description_max_is_4294967295_characters_long') }}">
                            {{ $blog->video }}
                            </textarea>
                                    </div>
                                    <div class="col-12 repeater">
                                        <div data-repeater-list="translations">
                                            @foreach ($blog->translations as $index => $translation)
                                                <div data-repeater-item class="row">
                                                    <div class="col-6">
                                                        {{-- <label for="language_id">{{__('blog::blog.language')}}</label> --}}
                                                        <select class="form-control" id="language_id" name="language_id"
                                                            required data-parsley-required
                                                            data-parsley-required-message="{{ __('blog::blog.please_select_the_language') }}"
                                                            data-parsley-trigger="change focusout">
                                                            <option value="" disabled>{{ __('blog::blog.language') }}
                                                            </option>
                                                            @foreach ($languages as $language)
                                                                <option value="{{ $language->id }}"
                                                                    @if ($translation->language_id == $language->id) selected @endif>
                                                                    {{ $language->code }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-6">
                                                        {{-- <label for="blog">{{__('blog::blog.blog')}}</label> --}}
                                                        <input name="title" id="title" type="text" class="form-control"
                                                            placeholder="{{ __('blog::blog.please_enter_the_blog') }}"
                                                            required data-parsley-required
                                                            data-parsley-required-message="{{ __('blog::blog.please_enter_the_blog') }}"
                                                            data-parsley-trigger="change focusout"
                                                            data-parsley-maxlength="150"
                                                            data-parsley-maxlength-message="{{ __('blog::blog.blog_max_is_150_characters_long') }}"
                                                            value="{{ $translation->title }}">
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <label for="description">{{ __('blog::blog.description') }}
                                                            <small class="text-muted"> -
                                                                {{ __('blog::blog.optional') }}</small></label>
                                                        <textarea rows="6" name="description" id="description-{{ $index }}" class="form-control description"
                                                            placeholder="{{ __('blog::blog.enter_description') }}"
                                                            data-parsley-trigger="change focusout"
                                                            data-parsley-maxlength="4294967295"
                                                            data-parsley-maxlength-message="{{ __('blog::blog.description_max_is_4294967295_characters_long') }}"
                                                            required data-parsley-required
                                                            data-parsley-required-message="{{ __('blog::blog.please_enter_the_blog') }}">{{ $translation->description }}</textarea>
                                                    </div>
                                                    <div class="col-6 mt-2">
                                                        <label for="meta_title">{{ __('blog::blog.meta_title') }}</label>
                                                        <input name="meta_title" id="meta_title" type="text"
                                                            class="form-control" value="{{ $translation->meta_title }}"
                                                            placeholder="{{ __('blog::blog.meta_title') }}"
                                                            data-parsley-trigger="change focusout"
                                                            data-parsley-maxlength="150"
                                                            data-parsley-maxlength-message="{{ __('blog::blog.title_max_is_150_characters_long') }}">
                                                    </div>
                                                    <div class="col-lg-6 mt-2">
                                                        <label
                                                            for="meta_description">{{ __('blog::blog.meta_description') }}
                                                            <small class="text-muted"> -
                                                                {{ __('blog::blog.optional') }}</small></label>
                                                        <textarea rows="6" name="meta_description" id="meta_description" class="form-control"
                                                            placeholder="{{ __('blog::blog.meta_description') }}">{{ $translation->meta_description }}</textarea>
                                                    </div>
                                                    <div class="col-lg-6 mt-2">
                                                        <label for="excerpt">{{ __('blog::blog.excerpt') }} <small
                                                                class="text-muted"> -
                                                                {{ __('blog::blog.optional') }}</small></label>
                                                        <textarea rows="6" name="excerpt" id="excerpt" class="form-control" placeholder="{{ __('blog::blog.excerpt') }}"
                                                            data-parsley-trigger="change focusout"
                                                            data-parsley-maxlength="4294967295"
                                                            data-parsley-maxlength-message="{{ __('blog::blog.description_max_is_4294967295_characters_long') }}">
                                    {{ $translation->excerpt }}
                                    </textarea>
                                                    </div>

                                                    <div class="col-md-2 col-sm-2 mt-2">
                                                        {{-- <label class="control-label">&nbsp;</label> --}}
                                                        <a href="javascript:;" data-repeater-delete
                                                            class="btn btn-brand data-repeater-delete">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @if (!$blog->translations->count())
                                                <div data-repeater-item class="row">
                                                    <div class="col-6">
                                                        {{-- <label for="language_id">{{__('blog::blog.language')}}</label> --}}
                                                        <select class="form-control" id="language_id" name="language_id"
                                                            required data-parsley-required
                                                            data-parsley-required-message="{{ __('blog::blog.please_select_the_language') }}"
                                                            data-parsley-trigger="change focusout">
                                                            <option value="" selected disabled>
                                                                {{ __('blog::blog.language') }}</option>
                                                            @foreach ($languages as $language)
                                                                <option value="{{ $language->id }}"
                                                                    @if ($language->id == 1) selected @endif>
                                                                    {{ $language->code }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        {{-- <label for="blog">{{__('blog::blog.blog')}}</label> --}}
                                                        <input name="blog" id="blog" type="text" class="form-control"
                                                            placeholder="{{ __('blog::blog.please_enter_the_blog') }}"
                                                            required data-parsley-required
                                                            data-parsley-required-message="{{ __('blog::blog.please_enter_the_blog') }}"
                                                            data-parsley-trigger="change focusout"
                                                            data-parsley-maxlength="150"
                                                            data-parsley-maxlength-message="{{ __('blog::blog.blog_max_is_150_characters_long') }}">
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <label for="description">{{ __('blog::blog.description') }}
                                                            <small class="text-muted"> -
                                                                {{ __('blog::blog.optional') }}</small></label>
                                                        <textarea rows="6" name="description" id="description-0" class="form-control description"
                                                            placeholder="{{ __('blog::blog.enter_description') }}"
                                                            data-parsley-trigger="change focusout"
                                                            data-parsley-maxlength="4294967295"
                                                            data-parsley-maxlength-message="{{ __('blog::blog.description_max_is_4294967295_characters_long') }}"></textarea>
                                                    </div>
                                                    <div class="col-6 mt-2">
                                                        <label for="meta_title">{{ __('blog::blog.meta_title') }}</label>
                                                        <input name="meta_title" id="meta_title" type="text"
                                                            class="form-control" value=""
                                                            placeholder="{{ __('blog::blog.meta_title') }}"
                                                            data-parsley-trigger="change focusout"
                                                            data-parsley-maxlength="150"
                                                            data-parsley-maxlength-message="{{ __('blog::blog.title_max_is_150_characters_long') }}">
                                                    </div>
                                                    <div class="col-lg-6 mt-2">
                                                        <label
                                                            for="meta_description">{{ __('blog::blog.meta_description') }}
                                                            <small class="text-muted"> -
                                                                {{ __('blog::blog.optional') }}</small></label>
                                                        <textarea rows="6" name="meta_description" id="meta_description" class="form-control" value=""
                                                            placeholder="{{ __('blog::blog.meta_description') }}"
                                                            data-parsley-trigger="change focusout"
                                                            data-parsley-maxlength="4294967295"
                                                            data-parsley-maxlength-message="{{ __('blog::blog.description_max_is_4294967295_characters_long') }}"></textarea>
                                                    </div>
                                                    <div class="col-lg-6 mt-2">
                                                        <label for="excerpt">{{ __('blog::blog.excerpt') }} <small
                                                                class="text-muted"> -
                                                                {{ __('blog::blog.optional') }}</small></label>
                                                        <textarea rows="6" name="excerpt" id="excerpt" class="form-control" placeholder="{{ __('blog::blog.excerpt') }}"
                                                            data-parsley-trigger="change focusout"
                                                            data-parsley-maxlength="4294967295"
                                                            data-parsley-maxlength-message="{{ __('blog::blog.description_max_is_4294967295_characters_long') }}">
                                    </textarea>
                                                    </div>

                                                    <div class="col-md-2 col-sm-2 mt-2">
                                                        {{-- <label class="control-label">&nbsp;</label> --}}
                                                        <a href="javascript:;" data-repeater-delete
                                                            class="btn btn-brand data-repeater-delete">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <a href="javascript:;" data-repeater-create id="repeater_btn"
                                            class="btn">
                                            <i class="fa fa-plus"></i>
                                            {{ trans('blog::blog.add_blog_translation') }}
                                        </a>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-12 mr-auto">
                                            <div class="row mx-0">
                                                <div class="box">
                                                    <label for="description">{{ __('blog::blog.attachments') }}
                                                        <small class="text-muted"> -
                                                            {{ __('blog::blog.optional') }}</small></label>
                                                    <input type="file" name="attachments[]" multiple
                                                        class="inputfile inputfile-5" id="file-6"
                                                        data-multiple-caption="{count} {{ trans('blog::blog.files_selected') }}" />
                                                    <label for="file-6">
                                                        <figure><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                height="17" viewBox="0 0 20 17">
                                                                <path
                                                                    d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" />
                                                            </svg></figure> <span></span>
                                                    </label>
                                                </div>
                                                <div class="col-12" style="display: contents;">
                                                    @foreach ($attachments as $attachment)
                                                        @if ($attachment->is_deleted == null)
                                                            @if (in_array($attachment->mime_type, ['tiff', 'image/tiff', 'jpeg', 'image/jpeg', 'gif', 'image/gif', 'png', 'image/png']))
                                                                <div class="card col-6"
                                                                    id="card-{{ $attachment->id }}">
                                                                    <a class="html5lightbox" title=""
                                                                        data-group="image_group"
                                                                        href="{{ asset('storage/' . $attachment->id . '/' . $attachment->file_name) }}"
                                                                        data-width="800" data-height="800"
                                                                        title="{{ trans('blog::blog.view_image') }}">
                                                                        <img class="card-img-top"
                                                                            src="{{ asset('storage/' . $attachment->id . '/' . $attachment->file_name) }}"
                                                                            alt="{{ trans('blog::blog.image') }}">
                                                                    </a>
                                                                    {{-- @if (auth()->user()->hasPermission('delete-blog-attachment')) --}}
                                                                    <div class="card-body"
                                                                        style="text-align: center !important;">
                                                                        {{-- <h5 class="card-title">Card title that wraps to a new line</h5> --}}
                                                                        {{-- <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> --}}
                                                                        <button type="button" class="btn btn-danger"
                                                                            onclick="deleteAttachment({{ $attachment->id }});"><i
                                                                                class="fas fa-trash-alt"></i>
                                                                            {{ trans('blog::blog.delete') }}</button>
                                                                    </div>
                                                                    {{-- @endif --}}
                                                            @endif
                                                </div>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                            <div class="m-form__actions m-form__actions--solid">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="button" class="btn btn-brand mx-3 save-continue">
                                            <i class="la la-check"></i>
                                            <span class="kt-hidden-mobile">Save</span>
                                        </button>
                                        <button type="button" class="btn btn-success save-only">
                                            <i class="la la-check"></i>
                                            <span class="kt-hidden-mobile">Save & Close</span>
                                        </button>
                                        <a href="{{route('front.single_blog',['id' => $blog->id,'slug'=>  str_slug($blog->slug)])}}" class="btn btn-primary mx-3" target="_blank">Preview</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end:: Content -->

    </div>
@endsection

<!--end::Form-->

<!-- Callback function -->
{{-- <script>
    function updateBlogCallback() {
        // Close modal
        $('#vcxl_modal').modal('toggle');
        // Reload datatable
        $('#blogs_table').DataTable().ajax.reload(null, false);
    }
    $('#category_ids').selectpicker('refresh');
</script> --}}

@push('footer-scripts')
    <script src="{{ asset('8x/assets/js/repeater.js') }}" type="text/javascript"></script>
    <script src="{{ asset('8x/assets/js/summernote-image-attributes.js') }}"></script>
    <script>
        $('.save-continue').click(function() {
            $('#creation_type').val('save_continue');
            $('#update_blog_form').submit();
        });
        $('.save-only').click(function() {
            $('#creation_type').val('save_only');
            $('#update_blog_form').submit();
        });
    </script>
    
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
            @if ($blog->translations->count())
                @foreach ($blog->translations as $index => $translation)
                    // Summernote
                    $('#description-' + '{{ $index }}').summernote({
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
                $('#description-' + '0').summernote({
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
    <script>
        function deleteAttachment(id) {
            KTApp.blockPage({
                overlayColor: "#000000",
                type: "loader",
                state: "success",
                message: "{{ trans('main.please_wait') }}"
            });
            $.ajax({
                url: "{{ route('delete.media') }}",
                type: "POST",
                data: {
                    id: id
                },
                success: function(response) {
                    // UnblockUI
                    KTApp.unblockPage();

                    // Show notification
                    if (response.status) {
                        // Remove attachment div
                        $('#card-' + id).remove();
                    } else {
                        showNotification(response.message, "{{ trans('main.error') }}", 'la la-warning',
                            null,
                            'danger', true, true, true);
                    }
                },
                error: function(xhr, error_text, statusText) {
                    // UnblockUI
                    KTApp.unblockPage();

                    if (xhr.status == 401) {
                        // Unauthorized
                        if (xhr.responseJSON.error) {
                            setTimeout(function() {
                                window.scrollTo({
                                    top: 0,
                                    behavior: 'smooth'
                                });
                                showMsg(form, 'danger', xhr.responseJSON.error, true);
                            }, 500);
                            showNotification(xhr.responseJSON.error, "{{ trans('main.error') }}",
                                'la la-warning', null, 'danger', true, true, true);
                        } else {
                            setTimeout(function() {
                                window.scrollTo({
                                    top: 0,
                                    behavior: 'smooth'
                                });
                                showMsg(form, 'danger', statusText, true);
                            }, 500);
                            showNotification(statusText, "{{ trans('main.error') }}", 'la la-warning', null,
                                'danger', true, true, true);
                        }
                    } else if (xhr.status == 422) {
                        // HTTP_UNPROCESSABLE_ENTITY
                        if (xhr.responseJSON.errors) {
                            window.scrollTo({
                                top: 0,
                                behavior: 'smooth'
                            });
                            $.each(xhr.responseJSON.errors, function(index, error) {
                                setTimeout(function() {
                                    if (index === 0) {
                                        var remove_previous_alerts = true;
                                    } else {
                                        var remove_previous_alerts = false;
                                    }
                                    showMsg(form, 'danger', error.message,
                                        remove_previous_alerts);
                                }, 500);
                                showNotification(error.message, "{{ trans('main.error') }}",
                                    'la la-warning', null, 'danger', true, true, true);
                            });
                        } else {
                            setTimeout(function() {
                                window.scrollTo({
                                    top: 0,
                                    behavior: 'smooth'
                                });
                                showMsg(form, 'danger', statusText, true);
                            }, 500);
                            showNotification(statusText, "{{ trans('main.error') }}", 'la la-warning', null,
                                'danger', true, true, true);
                        }
                    } else if (xhr.status == 500) {
                        // Internal Server Error
                        var error = xhr.responseJSON.message;
                        if (xhr.responseJSON.error) {
                            setTimeout(function() {
                                window.scrollTo({
                                    top: 0,
                                    behavior: 'smooth'
                                });
                                showMsg(form, 'danger', xhr.responseJSON.error, true);
                            }, 500);
                            showNotification(xhr.responseJSON.error, "{{ trans('main.error') }}",
                                'la la-warning', null, 'danger', true, true, true);
                        } else {
                            setTimeout(function() {
                                window.scrollTo({
                                    top: 0,
                                    behavior: 'smooth'
                                });
                                showMsg(form, 'danger', statusText, true);
                            }, 500);
                            showNotification(statusText, "{{ trans('main.error') }}", 'la la-warning', null,
                                'danger', true, true, true);
                        }
                    }
                }
            });
        }
    </script>
@endpush
