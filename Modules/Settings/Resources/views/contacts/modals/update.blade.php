@extends('dashboard.layouts.basic')

@section('content')
<style>
    .fade:not(.show) {
        opacity: 1
    }
</style>
<!--begin::Form-->
<form action="{{route('settings.contacts.update')}}" method="POST" id="update_contact_form" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="updateContactCallback" data-parsley-validate enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id" value="{{$contact->id}}" />
    <div class="m-portlet__body">
        <div class="col-12 mt-5">
            <label for="type">{{__('settings::settings.select_type')}}</label>
            <select name="type" id="type" class="form-control selectpicker" data-live-search="true" required data-parsley-required data-parsley-required-message="{{__('settings::settings.please_select_the_type')}}" data-parsley-trigger="change focusout" data-parsley-errors-container="#type_error_container">
                <option selected disabled value="">{{__('settings::settings.select_type')}}</option>
                <option value="contact_us" @if($contact->type == 'contact_us') selected @endif>{{__('settings::settings.email_to_receive_contact_us_messages')}}</option>
                <option value="phone" @if($contact->type == 'phone') selected @endif>{{__('settings::settings.website_contact_us_phone_number')}}</option>
                <option value="email" @if($contact->type == 'email') selected @endif>{{__('settings::settings.website_contact_us_email')}}</option>
                <option value="careers" @if($contact->type == 'careers') selected @endif>{{__('settings::settings.email_to_receive_career_applications')}}</option>
                <option value="whatsapp" @if($contact->type == 'whatsapp') selected @endif> >{{__('settings::settings.website_contact_us_whatsapp')}}</option>
                <option value="address" @if($contact->type == 'address') selected @endif> >{{__('settings::settings.website_contact_us_address')}}</option>
            </select>
            <div id="type_error_container" class="error_container"></div>
        </div>
        <div class="form-group row col-12">
            <div class="col-12 mt-5">
                <label for="value">{{__('settings::settings.contact')}}</label>
                <input name="value" id="value" type="text" class="form-control" value="{{$contact->value}}" placeholder="{{__('settings::settings.please_enter_the_contact')}}" required data-parsley-required data-parsley-required-message="{{__('settings::settings.please_enter_the_contact')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('settings::settings.contact_max_is_150_characters_long')}}">
            </div>
            <div class="col-12 mt-5 address_ar @if($contact->type != 'address') d-none @endif">
                <label for="value_ar">{{__('settings::settings.contact_ar')}}</label>
                <input name="value_ar" id="value_ar" type="text" class="form-control" value="{{$contact->value_ar}}" placeholder="{{__('settings::settings.please_enter_the_contact')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('settings::settings.contact_max_is_150_characters_long')}}">
            </div>

        </div>
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-success btn-brand">{{trans('settings::settings.update_contact')}}</button>
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
    function updateContactCallback() {
        // Close modal
        $('#fast_modal').modal('toggle');
        // Reload datatable
        var contacts_table = $('#contacts_table').DataTable();
        contacts_table.ajax.reload(null, false);
    }
</script>
<script>
    $("#type").selectpicker("refresh");
    $('#type').change(function(){
            if($(this).val() == 'address'){
                $('.address_ar').removeClass('d-none');
            }else{
                $('.address_ar').addClass('d-none');
            }
    });
</script>
@endpush