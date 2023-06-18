@extends('dashboard.layouts.basic')


@section('content')
    <!--begin::Form-->
    <form action="{{route('tags.store')}}" method="POST" id="create_tag_form" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="createTagCallback" data-parsley-validate>
        @csrf
        <div class="m-portlet__body">
            <div class="form-group row">
                <div class="col-12">
                    {{-- <label for="tag">{{__('tags::tags.tag')}}</label> --}}
                    <input name="tag" id="tag" type="text" class="form-control" placeholder="{{__('tags::tags.please_enter_the_tag')}}" required data-parsley-required data-parsley-required-message="{{__('tags::tags.please_enter_the_tag')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('tags::tags.tag_max_is_150_characters_long')}}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    {{-- <label for="color">{{__('tags::tags.color')}}</label> --}}
                    <input name="color" id="color" type="color" class="form-control" placeholder="{{__('tags::tags.please_enter_the_color')}}" required data-parsley-required data-parsley-required-message="{{__('tags::tags.please_enter_the_color')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('tags::tags.color_max_is_150_characters_long')}}">
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
                        <a href="{{route('tags.tags.create')}}" data-8xload class="btn btn-brand btn-icon-sm">
                            <i class="flaticon2-plus"></i> {{trans('tags::tags.create_new')}}
                        </a>
                        --}}
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
        function createTagCallback() {
            // Reload datatable
            tags_table.ajax.reload(null, false);
        }
    </script>
@endpush