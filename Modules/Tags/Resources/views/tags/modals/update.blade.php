@extends('dashboard.layouts.basic')

@section('content')
<!--begin::Form-->
<form action="{{route('tags.update')}}" method="POST" id="update_tag_form" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="updateTagCallback" data-parsley-validate>
    @csrf
    <input type="hidden" name="id" id="id" value="{{$tag->id}}" />
    <div class="m-portlet__body">

        <div class="form-group row">
            <div class="col-12">
                {{-- <label for="tag">{{__('tags::tags.tag')}}</label> --}}
                <input name="tag" id="tag" type="text" class="form-control" placeholder="{{__('tags::tags.please_enter_the_tag')}}" required data-parsley-required data-parsley-required-message="{{__('tags::tags.please_enter_the_tag')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('tags::tags.tag_max_is_150_characters_long')}}" value="{{$tag->tag}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-12">
                {{-- <label for="color">{{__('tags::tags.color')}}</label> --}}
                <input name="color" id="color" value="{{$tag->color}}" type="color" class="form-control" placeholder="{{__('tags::tags.please_enter_the_color')}}" required data-parsley-required data-parsley-required-message="{{__('tags::tags.please_enter_the_color')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('tags::tags.color_max_is_150_characters_long')}}">
            </div>
        </div>
    </div>
    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
        <div class="m-form__actions m-form__actions--solid">
            <div class="row">
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-success btn-brand">{{trans('tags::tags.update_tag')}}</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

<!--end::Form-->

<!-- Callback function -->
<script>
    function updateTagCallback() {
        // Close modal
        $('#fast_modal').modal('toggle');
        // Reload datatable
        tags_table.ajax.reload(null, false);
    }
</script>

@push('scripts')

@endpush