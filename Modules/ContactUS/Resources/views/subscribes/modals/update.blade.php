@extends('dashboard.layouts.basic')

@section('content')
<!--begin::Form-->
<form action="{{route('contact_us.subscribes.update')}}" method="POST" id="update_subscribe_form" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="updateSubscribeCallback" data-parsley-validate enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id" value="{{$subscribe->id}}" />
    <div class="m-portlet__body">
        <div class="form-group row">
            <div class="col-lg-8">
                <label for="email">{{__('contactus::contact_us.email')}}</label>
                <input name="email" id="email" type="email" value="{{$subscribe->email}}" class="form-control" placeholder="{{__('contactus::contact_us.please_enter_the_email')}}" data-parsley-required-message="{{__('contactus::contact_us.please_enter_the_email')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('contactus::contact_us.email_max_is_150_characters_long')}}" data-parsley-type="email" value="{{$subscribe->email}}">
            </div>
        </div>
    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
        <div class="m-form__actions m-form__actions--solid">
            <div class="row">
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-success btn-brand">{{trans('contactus::contact_us.update_subscribe')}}</button>
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
    function updateSubscribeCallback() {
        // Close modal
        $('#fast_modal').modal('toggle');
        // Reload datatable
        $('#subscribes_table').DataTable().ajax.reload(null, false);
    }
</script>
