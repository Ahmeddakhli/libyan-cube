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
                        <!-- Create LCC Form -->
                        <!--begin::Form-->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="en-tab" data-toggle="tab" href="#en" role="tab"
                                    aria-controls="en" aria-selected="true">{{ __('main.english') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="ar-tab" data-toggle="tab" href="#ar" role="tab"
                                    aria-controls="ar" aria-selected="false">{{ __('main.arabic') }}</a>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="en" role="tabpanel" aria-labelledby="en-tab">
                                <form action="{{ route('blogs.store') }}" method="POST" id="create_blog_form_en"
                                    enctype="multipart/form-data"
                                    class="m-form m-form--fit m-form--label-align-right m-form--group-seperator"
                                    data-async data-callback="createFacilityCallback" data-parsley-validate>
                                    @csrf
                                    <input type="hidden" name="creation_type" class="creation_type">
                                    <div class="m-portlet__body">
                                        <div class="row mx-0 my-5">
                                            <div class="fancy-checkbox col-3">
                                                <input name="is_featured" id="is_featured-en" type="checkbox">
                                                <label for="is_featured-en">{{ __('blog::blog.is_featured') }}</label>
                                            </div>
                                            <div class="fancy-checkbox col-3">
                                                <input name="is_published" id="is_published-en" type="checkbox">
                                                <label for="is_published-en">{{ __('blog::blog.is_published') }}</label>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="form-group col-6 pr-0">
                                                <label
                                                    for="category_ids">{{ __('blog::blog.blog_category') }}</label>
                                                <select class="form-control selectpicker" id="category_ids"
                                                    name="category_ids[]" multiple required data-parsley-required
                                                    data-parsley-required-message="{{ __('blog::blog.please_select_the_blog_category') }}"
                                                    data-parsley-trigger="change focusout">
                                                    <option value="" selected disabled>
                                                        {{ __('blog::blog.blog_category') }}
                                                    </option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">
                                                            {{ $category->value ? $category->value : $category->default_value }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-6 mt-2">
                                                <label for="video">{{ __('blog::blog.video') }} <small
                                                        class="text-muted">
                                                        - {{ __('blog::blog.optional') }}</small></label>
                                                <textarea rows="3" name="video" id="video" class="form-control" placeholder="{{ __('blog::blog.video') }}"
                                                    data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295"
                                                    data-parsley-maxlength-message="{{ __('blog::blog.description_max_is_4294967295_characters_long') }}">
                                        </textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12 ">
                                                <div>
                                                    <div data-repeater-item class="row">
                                                        <div class="col-6">
                                                            {{-- <label for="language_id">{{__('blog::blog.language')}}</label> --}}
                                                            {{-- <select class="form-control" id="language_id"
                                                                name="language_id" required data-parsley-required
                                                                data-parsley-required-message="{{ __('blog::blog.please_select_the_language') }}"
                                                                data-parsley-trigger="change focusout">
                                                                <option value="" selected disabled>
                                                                    {{ __('blog::blog.language') }}</option>
                                                                @foreach ($languages as $language)
                                                                    <option value="{{ $language->id }}"
                                                                        @if ($language->id == 1) selected @endif>
                                                                        {{ $language->code }}</option>
                                                                @endforeach
                                                            </select> --}}
                                                            <input type="hidden" name="translations[0][language_id]" value="1">
                                                        </div>

                                                        <div class="col-6">
                                                            {{-- <label for="title">{{__('blog::blog.title')}}</label> --}}
                                                            <input name="translations[0][title]" id="title" type="text"
                                                                class="form-control"
                                                                placeholder="{{ __('blog::blog.please_enter_the_blog') }}"
                                                                required data-parsley-required
                                                                data-parsley-required-message="{{ __('blog::blog.please_enter_the_blog') }}"
                                                                data-parsley-trigger="change focusout"
                                                                data-parsley-maxlength="150"
                                                                data-parsley-maxlength-message="{{ __('blog::blog.title_max_is_150_characters_long') }}">
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <label
                                                                for="description">{{ __('blog::blog.description') }}
                                                                <small class="text-muted"> -
                                                                    {{ __('blog::blog.optional') }}</small></label>
                                                            <textarea rows="6" name="translations[0][description]" id="description-0" class="form-control description"
                                                                placeholder="{{ __('blog::blog.enter_description') }}" data-parsley-trigger="change focusout"
                                                                data-parsley-maxlength="4294967295"
                                                                data-parsley-maxlength-message="{{ __('blog::blog.description_max_is_4294967295_characters_long') }}"
                                                                data-parsley-required></textarea>
                                                        </div>
                                                        <div class="col-6 mt-2">
                                                            <label
                                                                for="meta_title">{{ __('blog::blog.meta_title') }}</label>
                                                            <input name="translations[0][meta_title]" id="meta_title" type="text"
                                                                class="form-control"
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
                                                            <textarea rows="6" name="translations[0][meta_description]" id="meta_description" class="form-control"
                                                                placeholder="{{ __('blog::blog.meta_description') }}" data-parsley-trigger="change focusout"
                                                                data-parsley-maxlength="4294967295"
                                                                data-parsley-maxlength-message="{{ __('blog::blog.description_max_is_4294967295_characters_long') }}">
                                                    </textarea>
                                                        </div>
                                                        <div class="col-lg-6 mt-2">
                                                            <label for="excerpt">{{ __('blog::blog.excerpt') }}
                                                                <small class="text-muted"> -
                                                                    {{ __('blog::blog.optional') }}</small></label>
                                                            <textarea rows="6" name="translations[0][excerpt]" id="excerpt" class="form-control" placeholder="{{ __('blog::blog.excerpt') }}"
                                                                data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295"
                                                                data-parsley-maxlength-message="{{ __('blog::blog.description_max_is_4294967295_characters_long') }}">
                                                    </textarea>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-2">

                                                <div class="row">
                                                    <div class="box">
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
                                                        <label for="description">{{ __('blog::blog.attachments') }}
                                                            <small class="text-muted"> -
                                                                {{ __('blog::blog.optional') }}
                                                                {{ trans('blog::blog.only_one_image') }}</small></label>


                                                    </div>
                                                    <label for="image"><strong>{{__('settings::settings.image_dimensions')}}:516 × 159 px</strong></label>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                        <div class="m-form__actions m-form__actions--solid">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-brand mx-3 save-continue">
                                                            <i class="la la-check"></i>
                                                            <span class="kt-hidden-mobile">Save</span>
                                                        </button>
                                                        <button type="button" class="btn btn-success save-only">
                                                            <i class="la la-check"></i>
                                                            <span class="kt-hidden-mobile">Save & Close</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="ar" role="tabpanel" aria-labelledby="ar-tab">
                                <form action="{{ route('blogs.store') }}" method="POST" id="create_blog_form_ar"
                                    enctype="multipart/form-data"
                                    class="m-form m-form--fit m-form--label-align-right m-form--group-seperator"
                                    data-async data-callback="createFacilityCallback" data-parsley-validate>
                                    @csrf
                                    <input type="hidden" name="creation_type" class="creation_type">
                                    <div class="m-portlet__body">
                                        <div class="row mx-0 my-5">
                                            <div class="fancy-checkbox col-3">
                                                <input name="is_featured" id="is_featured-ar" type="checkbox">
                                                <label for="is_featured-ar">{{ __('blog::blog.is_featured') }}</label>
                                            </div>
                                            <div class="fancy-checkbox col-3">
                                                <input name="is_published" id="is_published-ar" type="checkbox">
                                                <label for="is_published-ar">{{ __('blog::blog.is_published') }}</label>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="form-group col-6 pr-0">
                                                <label
                                                    for="category_ids">{{ __('blog::blog.blog_category') }}</label>
                                                <select class="form-control selectpicker" id="category_ids"
                                                    name="category_ids[]" multiple required data-parsley-required
                                                    data-parsley-required-message="{{ __('blog::blog.please_select_the_blog_category') }}"
                                                    data-parsley-trigger="change focusout">
                                                    <option value="" selected disabled>
                                                        {{ __('blog::blog.blog_category') }}
                                                    </option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">
                                                            {{ $category->value ? $category->value : $category->default_value }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-6 mt-2">
                                                <label for="video">{{ __('blog::blog.video') }} <small
                                                        class="text-muted">
                                                        - {{ __('blog::blog.optional') }}</small></label>
                                                <textarea rows="3" name="video" id="video" class="form-control" placeholder="{{ __('blog::blog.video') }}"
                                                    data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295"
                                                    data-parsley-maxlength-message="{{ __('blog::blog.description_max_is_4294967295_characters_long') }}">
                                        </textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <div data-repeater-list="translations">
                                                    <div data-repeater-item class="row">
                                                        <div class="col-6">
                                                            {{-- <label for="language_id">{{__('blog::blog.language')}}</label> --}}
                                                            {{-- <select class="form-control" id="language_id"
                                                                name="language_id" required data-parsley-required
                                                                data-parsley-required-message="{{ __('blog::blog.please_select_the_language') }}"
                                                                data-parsley-trigger="change focusout">
                                                                <option value="" selected disabled>
                                                                    {{ __('blog::blog.language') }}</option>
                                                                @foreach ($languages as $language)
                                                                    <option value="{{ $language->id }}"
                                                                        @if ($language->id == 1) selected @endif>
                                                                        {{ $language->code }}</option>
                                                                @endforeach
                                                            </select> --}}
                                                            <input type="hidden" name="translations[1][language_id]" value="2">
                                                        </div>

                                                        <div class="col-6">
                                                            {{-- <label for="title">{{__('blog::blog.title')}}</label> --}}
                                                            <input name="translations[1][title]" id="title" type="text"
                                                                class="form-control"
                                                                placeholder="{{ __('blog::blog.please_enter_the_blog') }}"
                                                                required data-parsley-required
                                                                data-parsley-required-message="{{ __('blog::blog.please_enter_the_blog') }}"
                                                                data-parsley-trigger="change focusout"
                                                                data-parsley-maxlength="150"
                                                                data-parsley-maxlength-message="{{ __('blog::blog.title_max_is_150_characters_long') }}">
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <label
                                                                for="description">{{ __('blog::blog.description') }}
                                                                <small class="text-muted"> -
                                                                    {{ __('blog::blog.optional') }}</small></label>
                                                            <textarea rows="6" name="translations[1][description]" id="description-1" class="form-control description"
                                                                placeholder="{{ __('blog::blog.enter_description') }}" data-parsley-trigger="change focusout"
                                                                data-parsley-maxlength="4294967295"
                                                                data-parsley-maxlength-message="{{ __('blog::blog.description_max_is_4294967295_characters_long') }}"
                                                                data-parsley-required></textarea>
                                                        </div>
                                                        <div class="col-6 mt-2">
                                                            <label
                                                                for="meta_title">{{ __('blog::blog.meta_title') }}</label>
                                                            <input name="translations[1][meta_title]" id="meta_title" type="text"
                                                                class="form-control"
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
                                                            <textarea rows="6" name="translations[1][meta_description]" id="meta_description" class="form-control"
                                                                placeholder="{{ __('blog::blog.meta_description') }}" data-parsley-trigger="change focusout"
                                                                data-parsley-maxlength="4294967295"
                                                                data-parsley-maxlength-message="{{ __('blog::blog.description_max_is_4294967295_characters_long') }}">
                                                    </textarea>
                                                        </div>
                                                        <div class="col-lg-6 mt-2">
                                                            <label for="excerpt">{{ __('blog::blog.excerpt') }}
                                                                <small class="text-muted"> -
                                                                    {{ __('blog::blog.optional') }}</small></label>
                                                            <textarea rows="6" name="translations[1][excerpt]" id="excerpt" class="form-control" placeholder="{{ __('blog::blog.excerpt') }}"
                                                                data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295"
                                                                data-parsley-maxlength-message="{{ __('blog::blog.description_max_is_4294967295_characters_long') }}">
                                                    </textarea>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-2">

                                                <div class="row">
                                                    <div class="box">
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
                                                        <label for="description">{{ __('blog::blog.attachments') }}
                                                            <small class="text-muted"> -
                                                                {{ __('blog::blog.optional') }}
                                                                {{ trans('blog::blog.only_one_image') }}</small></label>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                        <div class="m-form__actions m-form__actions--solid">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-brand mx-3 save-continue">
                                                            <i class="la la-check"></i>
                                                            <span class="kt-hidden-mobile">Save</span>
                                                        </button>
                                                        <button type="button" class="btn btn-success save-only">
                                                            <i class="la la-check"></i>
                                                            <span class="kt-hidden-mobile">Save & Close</span>
                                                        </button>
                                                    </div>
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
        </div>
    </div>
    <!-- end:: Content -->

</div>
