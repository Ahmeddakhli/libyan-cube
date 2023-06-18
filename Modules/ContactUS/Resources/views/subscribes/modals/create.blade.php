@extends('dashboard.layouts.basic')

@section('content')
<!--begin::Form-->
<form action="{{route('contact_us.subscribes.store')}}" method="POST" id="create_subscribe_form" enctype="multipart/form-data" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="createSubscribeCallback" data-parsley-validate>
    @csrf
    <div class="m-portlet__body">
        <div class="form-group row">
            <div class="col-lg-8">
                <label for="email">{{__('contactus::contact_us.email')}}</label>
                <input name="email" id="email" type="email" class="form-control" placeholder="{{__('contactus::contact_us.please_enter_the_email')}}" required data-parsley-required data-parsley-required-message="{{__('contactus::contact_us.please_enter_the_email')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('contactus::contact_us.email_max_is_150_characters_long')}}" data-parsley-type="email">
            </div>
        </div>
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-success">{{__('main.submit')}}</button>
                        <button type="reset" class="btn btn-secondary">{{__('main.reset')}}</button>
                        {{--
                        <a href="{{route('contact_us.contact_us.create')}}" data-8xload class="btn btn-brand btn-icon-sm">
                        <i class="flaticon2-plus"></i> {{trans('contactus::contact_us.create_new')}}
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
    function createSubscribeCallback() {
        // Reload datatable
        contactus_table.ajax.reload(null, false);
    }
</script>
@endpush