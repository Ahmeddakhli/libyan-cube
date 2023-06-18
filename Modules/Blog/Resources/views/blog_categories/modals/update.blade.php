@extends('dashboard.layouts.basic')

@section('content')
<!--begin::Form-->
<form action="{{route('blog.categories.update')}}" method="POST" id="update_blog_category_form" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="updateBlogCategoryCallback" data-parsley-validate enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id" value="{{$blog_category->id}}" />
    <div class="m-portlet__body">
        <div class="form-group col-6 row">
            <input name="order" id="order" type="number" class="form-control" placeholder="{{__('blog::blog.order')}}" required data-parsley-required data-parsley-required-message="{{__('blog::blog.order_is_required')}}" data-parsley-trigger="change focusout" data-parsley-type="integer" data-parsley-min="0" value="{{$blog_category->order}}">
        </div>
        <div class="form-group row">
            <div class="col-12 repeater">
                <div data-repeater-list="translations">
                    @foreach ($blog_category->translations as $translation)
                    <div data-repeater-item class="row">
                        <div class="col-6">
                            {{-- <label for="language_id">{{__('blog::blog.language')}}</label> --}}
                            <select class="form-control" id="language_id" name="language_id" required data-parsley-required data-parsley-required-message="{{__('blog::blog.please_select_the_language')}}" data-parsley-trigger="change focusout">
                                <option value="" disabled>{{__('blog::blog.language')}}</option>
                                @foreach ($languages as $language)
                                <option value="{{$language->id}}" @if ($translation->language_id == $language->id) selected @endif>{{$language->code}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            {{-- <label for="blog">{{__('blog::blog.blog')}}</label> --}}
                            <input name="title" id="title" type="text" class="form-control" placeholder="{{__('blog::blog.please_enter_the_blog_category')}}" required data-parsley-required data-parsley-required-message="{{__('blog::blog.please_enter_the_blog_category')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('blog::blog.blog_category_max_is_150_characters_long')}}" value="{{$translation->title}}">
                        </div>
                        <div class="col-md-2 col-sm-2 mt-2">
                            {{-- <label class="control-label">&nbsp;</label> --}}
                            <a href="javascript:;" data-repeater-delete class="btn btn-brand data-repeater-delete">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                    @if (!$blog_category->translations->count())
                    <div data-repeater-item class="row">
                        <div class="col-6">
                            {{-- <label for="language_id">{{__('blog::blog.language')}}</label> --}}
                            <select class="form-control" id="language_id" name="language_id" required data-parsley-required data-parsley-required-message="{{__('blog::blog.please_select_the_language')}}" data-parsley-trigger="change focusout">
                                <option value="" selected disabled>{{__('blog::blog.language')}}</option>
                                @foreach ($languages as $language)
                                <option value="{{$language->id}}" @if($language->id == 1) selected @endif>{{$language->code}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            {{-- <label for="title">{{__('blog::blog.title')}}</label> --}}
                            <input name="title" id="title" type="text" class="form-control" placeholder="{{__('blog::blog.please_enter_the_blog_category')}}" required data-parsley-required data-parsley-required-message="{{__('blog::blog.please_enter_the_blog_category')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('blog::blog.blog_category_max_is_150_characters_long')}}">
                        </div>
                        <div class="col-md-2 col-sm-2 mt-2">
                            {{-- <label class="control-label">&nbsp;</label> --}}
                            <a href="javascript:;" data-repeater-delete class="btn btn-brand data-repeater-delete">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
                <a href="javascript:;" data-repeater-create id="repeater_btn" class="btn">
                    <i class="fa fa-plus"></i> {{trans('blog::blog.add_blog_translation')}}
                </a>
            </div>
        </div>
    </div>
    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
        <div class="m-form__actions m-form__actions--solid">
            <div class="row">
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-success btn-brand">{{trans('blog::blog.update_blog')}}</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

<!--end::Form-->

<!-- Callback function -->
<script>
    function updateBlogCategoryCallback() {
        // Close modal
        $('#fast_modal').modal('toggle');
        // Reload datatable
        $('#blog_categories_table').DataTable().ajax.reload(null, false);
    }
</script>

@push('scripts')
<script src="{{asset('8x/assets/js/repeater.js')}}" type="text/javascript"></script>
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
            }]
        });
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