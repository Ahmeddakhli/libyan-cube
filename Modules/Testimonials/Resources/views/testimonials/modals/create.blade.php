@extends('dashboard.layouts.basic')
@section('content')
<!--begin::Form-->
<form action="{{route('testimonials.store')}}" method="POST" id="create_testimonial_form" enctype="multipart/form-data" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="createTestimonialCallback" data-parsley-validate>
    @csrf
    <div class="m-portlet__body">
        <div class="fancy-checkbox">
            <input name="is_featured" id="is_featured" type="checkbox">
            <label for="is_featured">{{__('testimonials::testimonial.is_featured')}}</label>
        </div>
        <div class="form-group row">

            <div class="form-group row">
                <div class="col-12 repeater">
                    <div data-repeater-list="translations">
                        <div data-repeater-item class="row">
                            <div class="col-6 mt-5">
                                <label for="language_id">{{__('testimonials::testimonial.language')}}</label>
                                <select class="form-control" id="language_id" name="language_id" required data-parsley-required data-parsley-required-message="{{__('testimonials::testimonial.please_select_the_language')}}" data-parsley-trigger="change focusout">
                                    <option value="" selected disabled>{{__('testimonials::testimonial.language')}}</option>
                                    @foreach ($languages as $language)
                                    <option value="{{$language->id}}" @if($language->id == 1) selected @endif>{{$language->code}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 mt-5">
                                <label for="title">{{__('testimonials::testimonial.title')}}</label>
                                <input name="title" id="title" type="text" class="form-control" placeholder="{{__('testimonials::testimonial.please_enter_the_testimonial')}}" required data-parsley-required data-parsley-required-message="{{__('testimonials::testimonial.please_enter_the_testimonial')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('testimonials::testimonial.testimonial_max_is_150_characters_long')}}">
                            </div>
                            <div class="col-lg-12">
                                <label for="description">{{__('testimonials::testimonial.description')}}</label>
                                <textarea rows="6" name="description" id="description" class="form-control" placeholder="{{__('testimonials::testimonial.enter_description')}}" required data-parsley-required data-parsley-required-message="{{__('testimonials::testimonial.enter_description')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295" data-parsley-maxlength-message="{{__('testimonials::testimonial.description_max_is_4294967295_characters_long')}}"></textarea>
                            </div>
                            <div class="col-md-2 col-sm-2 mt-auto">
                                {{-- <label class="control-label">&nbsp;</label> --}}
                                <a href="javascript:;" data-repeater-delete class="btn btn-brand data-repeater-delete">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <a href="javascript:;" data-repeater-create id="repeater_btn" class="btn">
                        <i class="fa fa-plus"></i> {{trans('testimonials::testimonial.add_testimonial_translation')}}
                    </a>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-5 mt-5">
                    <label for="name">{{__('testimonials::testimonial.name')}}</label>
                    <input name="name" id="name" type="text" class="form-control" placeholder="{{__('testimonials::testimonial.please_enter_the_name')}}" required data-parsley-required data-parsley-required-message="{{__('testimonials::testimonial.please_enter_the_name')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('testimonials::testimonial.name_max_is_150_characters_long')}}">
                </div>
                <div class="col-lg-4 mt-5">
                    <div class="form-group">
                        <h4 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{__('testimonials::testimonial.attachments')}}:</h4>
                    </div>
                    <div class="row">
                        <div class="box">
                            <label for="description">{{__('testimonials::testimonial.attachments')}} <small class="text-muted"> - {{__('testimonials::testimonial.optional')}}</small></label>
                            <input type="file" name="attachments[]" class="inputfile inputfile-5" id="file-6" data-multiple-caption="{count} {{trans('testimonials::testimonial.files_selected')}}" />
                            <label for="file-6">
                                <figure><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                                        <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" /></svg></figure> <span></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-success">{{__('main.submit')}}</button>
                        <button type="reset" class="btn btn-secondary">{{__('main.reset')}}</button>
                        {{--
                        <a href="{{route('testimonials.create')}}" data-8xload class="btn btn-brand btn-icon-sm">
                        <i class="flaticon2-plus"></i> {{trans('testimonials::testimonial.create_new')}}
                        </a>
                        --}}
                    </div>
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
    function createTestimonialCallback() {
        // Reload datatable
        $('#fast_modal').modal('toggle');
        testimonials_table.ajax.reload(null, false);
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