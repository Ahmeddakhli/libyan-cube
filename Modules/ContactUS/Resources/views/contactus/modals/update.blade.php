@extends('dashboard.layouts.basic')

@section('content')
<!--begin::Form-->
<form action="{{route('contact_us.contact_us.update')}}" method="POST" id="update_contact_us_form" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="updateContactUsCallback" data-parsley-validate enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id" value="{{$contact_us->id}}" />
    <div class="m-portlet__body">
        <div class="form-group row">
            <div class="col-5">
                <label for="full_name">{{__('contactus::contact_us.full_name')}}</label>
                <input name="full_name" id="full_name" value="{{$contact_us->full_name}}" type="text" class="form-control" placeholder="{{__('contactus::contact_us.please_enter_the_full_name')}}" required data-parsley-required data-parsley-required-message="{{__('contactus::contact_us.please_enter_the_full_name')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('contactus::contact_us.full_name_max_is_150_characters_long')}}" value="{{$contact_us->full_name}}">
            </div>
            <div class="col-lg-8">
                <label for="email">{{__('contactus::contact_us.email')}} <small class="text-muted"> - {{__('contactus::contact_us.optional')}}</small></label>
                <input name="email" id="email" type="email" value="{{$contact_us->email}}" class="form-control" placeholder="{{__('contactus::contact_us.please_enter_the_email')}}" data-parsley-required-message="{{__('contactus::contact_us.please_enter_the_email')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('contactus::contact_us.email_max_is_150_characters_long')}}" data-parsley-type="email" value="{{$contact_us->email}}">
            </div>
            <div class="col-5">
                <label for="phone">{{__('contactus::contact_us.phone')}}</label>
                <input name="phone" id="phone" type="text" class="form-control" value="{{$contact_us->phone}}" placeholder="{{__('contactus::contact_us.please_enter_the_phone')}}" required data-parsley-required data-parsley-required-message="{{__('contactus::contact_us.please_enter_the_phone')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="20" data-parsley-maxlength-message="{{__('contactus::contact_us.phone_max_is_20_characters_long')}}" value="{{$contact_us->phone}}">
            </div>
            <div class="col-5">
                <label for="link">{{__('contactus::contact_us.link')}}</label>
                <input name="link" id="link" value="{{$contact_us->link}}" type="text" class="form-control" placeholder="{{__('contactus::contact_us.please_enter_the_link')}}" required data-parsley-required data-parsley-required-message="{{__('contactus::contact_us.please_enter_the_link')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295" data-parsley-maxlength-message="{{__('contactus::contact_us.link_max_is_4294967295_characters_long')}}" value="{{$contact_us->link}}">
            </div>
            <div class="col-lg-8">
                <label for="message">{{__('contactus::contact_us.message')}} <small class="text-muted"> - {{__('contactus::contact_us.optional')}}</small></label>
                <textarea rows="6" name="message" id="message" class="form-control" value="{{$contact_us->message}}" placeholder="{{__('contactus::contact_us.please_enter_the_message')}}" required data-parsley-required data-parsley-required-message="{{__('contactus::contact_us.please_enter_the_message')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295" data-parsley-maxlength-message="{{__('contactus::contact_us.message_max_is_4294967295_characters_long')}}">
                    {{$contact_us->message}}
                </textarea>
            </div>
            <div class="col-6">
                <label>{{trans('contactus::contact_us.best_time_to_call_from')}}</label>
                <input name="best_time_to_call_from" autocomplete="off" value="{{$contact_us->best_time_to_call_from}}" class="form-control datetimepicker-init" placeholder="{{trans('contactus::contact_us.best_time_to_call_from')}}" data-parsley-trigger="change focusout" value="{{$contact_us->best_time_to_call_from}}" />
            </div>
            <div class="col-6">
                <label>{{trans('contactus::contact_us.best_time_to_call_to')}}</label>
                <input name="best_time_to_call_to" autocomplete="off" value="{{$contact_us->best_time_to_call_to}}" class="form-control datetimepicker-init" placeholder="{{trans('contactus::contact_us.best_time_to_call_to')}}" data-parsley-trigger="change focusout" value="{{$contact_us->best_time_to_call_to}}" />
            </div>
        </div>
    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
        <div class="m-form__actions m-form__actions--solid">
            <div class="row">
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-success btn-brand">{{trans('contactus::contact_us.update_contact_us')}}</button>
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
    function updateContactUsCallback() {
        // Close modal
        $('#fast_modal').modal('toggle');
        // Reload datatable
        $('#contact_us_table').DataTable().ajax.reload(null, false);
    }
</script>
