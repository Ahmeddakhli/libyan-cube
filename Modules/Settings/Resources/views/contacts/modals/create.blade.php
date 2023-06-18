@extends('dashboard.layouts.basic')
@section('content')
<style>
    .fade:not(.show) {
        opacity: 1
    }
</style>
<!--begin::Form-->
<form action="{{route('settings.contacts.store')}}" method="POST" id="create_contact_form" enctype="multipart/form-data" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="createContactCallback" data-parsley-validate>
    @csrf
    <div class="m-portlet__body">
        <div class="form-group row">
            <div class="col-12 mt-5">
                <label for="type">{{__('settings::settings.select_type')}}</label>
                <select name="type" id="type" class="form-control selectpicker" data-live-search="true" required data-parsley-required data-parsley-required-message="{{__('settings::settings.please_select_the_type')}}" data-parsley-trigger="change focusout" data-parsley-errors-container="#type_error_container">
                    <option selected disabled value="">{{__('settings::settings.select_type')}}</option>
                    <option value="contact_us">{{__('settings::settings.email_to_receive_contact_us_messages')}}</option>
                    <option value="phone">{{__('settings::settings.website_contact_us_phone_number')}}</option>
                    <option value="careers">{{__('settings::settings.email_to_receive_career_applications')}}</option>
                    <option value="email">{{__('settings::settings.website_contact_us_email')}}</option>
                    <option value="whatsapp">{{__('settings::settings.website_contact_us_whatsapp')}}</option>
                    <option value="address">{{__('settings::settings.website_contact_us_address')}}</option>
                    <option value="sell_unit">{{__('settings::settings.email_to_receive_sell_units_requests')}}</option>
                </select>
                <div id="type_error_container" class="error_container"></div>
            </div>
            <div class="col-12 mt-5">
                <label for="value">{{__('settings::settings.contact')}}</label>
                <input name="value" id="value" type="text" class="form-control" placeholder="{{__('settings::settings.please_enter_the_contact')}}" required data-parsley-required data-parsley-required-message="{{__('settings::settings.please_enter_the_contact')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('settings::settings.contact_max_is_150_characters_long')}}">
            </div>
            <div class="col-12 mt-5 address_ar d-none">
                <label for="value_ar">{{__('settings::settings.contact_ar')}}</label>
                <input name="value_ar" id="value_ar" type="text" class="form-control" placeholder="{{__('settings::settings.please_enter_the_contact')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('settings::settings.contact_max_is_150_characters_long')}}">
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
                        <a href="{{route('settings.contacts.create')}}" data-8xload class="btn btn-brand btn-icon-sm">
                    <i class="flaticon2-plus"></i> {{trans('settings::settings.create_new')}}
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
        function createContactCallback() {
            // Reload datatable
            $('#fast_modal').modal('toggle');
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