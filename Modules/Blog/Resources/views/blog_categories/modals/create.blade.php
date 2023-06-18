@extends('dashboard.layouts.basic')


@section('content')
<!--begin::Form-->
<form action="{{route('blog.categories.store')}}" method="POST" id="create_blog_category_form" enctype="multipart/form-data" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="createBlogCategoryCallback" data-parsley-validate>
    @csrf
    <div class="m-portlet__body">
        <div class="form-group col-6 row">
            <input name="order" id="order" type="number" class="form-control" placeholder="{{__('blog::blog.order')}}" required data-parsley-required data-parsley-required-message="{{__('blog::blog.order_is_required')}}" data-parsley-trigger="change focusout" data-parsley-type="integer" data-parsley-min="0">
        </div>
        <div class="form-group row">
            <div class="col-12 repeater">
                <div data-repeater-list="translations">
                    <div data-repeater-item class="row">
                        <div class="col-5">
                            {{-- <label for="language_id">{{__('blog::blog.language')}}</label> --}}
                            <select class="form-control" id="language_id" name="language_id" required data-parsley-required data-parsley-required-message="{{__('blog::blog.please_select_the_language')}}" data-parsley-trigger="change focusout">
                                <option value="" selected disabled>{{__('blog::blog.language')}}</option>
                                @foreach ($languages as $language)
                                <option value="{{$language->id}}" @if($language->id == 1) selected @endif>{{$language->code}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-5">
                            {{-- <label for="title">{{__('blog::blog.title')}}</label> --}}
                            <input name="title" id="title" type="text" class="form-control" placeholder="{{__('blog::blog.please_enter_the_blog_category')}}" required data-parsley-required data-parsley-required-message="{{__('blog::blog.please_enter_the_blog_category')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('blog::blog.blog_max_is_150_characters_long')}}">
                        </div>
                        <div class="col-md-2 col-sm-2">
                            {{-- <label class="control-label">&nbsp;</label> --}}
                            <a href="javascript:;" data-repeater-delete class="btn btn-brand data-repeater-delete">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <a href="javascript:;" data-repeater-create id="repeater_btn" class="btn">
                    <i class="fa fa-plus"></i> {{trans('blog::blog.add_blog_category_translation')}}
                </a>
            </div>
        </div>
    </div>
    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
        <div class="m-form__actions m-form__actions--solid">
            <div class="row">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-success">{{__('main.submit')}}</button>
                    <button type="reset" class="btn btn-secondary">{{__('main.reset')}}</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

<!--end::Form-->
@push('scripts')
<!-- Callback function -->
<script>
    function createBlogCategoryCallback() {
        // Reload datatable
        $('#fast_modal').modal('toggle');
        blog_categories_table.ajax.reload(null, false);
    }
</script>

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