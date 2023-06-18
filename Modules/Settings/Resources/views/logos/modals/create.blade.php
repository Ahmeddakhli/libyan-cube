@extends('dashboard.layouts.basic')
@section('content')
<style>
    .fade:not(.show) {
        opacity: 1
    }
</style>
<!--begin::Form-->
<form action="{{route('settings.logos.store')}}" method="POST" id="create_logo_form" enctype="multipart/form-data" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="createLogoCallback" data-parsley-validate>
    @csrf
    <div class="m-portlet__body">
        <div class="form-group row">
            <div class="col-12 mt-5">
                <label for="image">{{__('settings::settings.logo')}}</label>
                <input name="image" id="image" type="file" placeholder="{{__('settings::settings.please_upload_the_logo')}}" required data-parsley-required data-parsley-required-message="{{__('settings::settings.please_upload_the_logo')}}" data-parsley-trigger="change focusout">
            </div>
            <div class="col-12 mt-5">
                <label for="type">{{__('settings::settings.select_type')}}</label>
                <select name="type" id="type" class="form-control selectpicker" data-live-search="true" required data-parsley-required data-parsley-required-message="{{__('settings::settings.please_select_the_type')}}" data-parsley-trigger="change focusout" data-parsley-errors-container="#type_error_container">
                    <option selected disabled value="">{{__('settings::settings.select_type')}}</option>
                    <option value="header">{{trans('settings::settings.header')}}</option>
                    <option value="footer">{{trans('settings::settings.footer')}}</option>
                </select>
                <div id="type_error_container" class="error_container"></div>
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
                        <a href="{{route('settings.logos.create')}}" data-8xload class="btn btn-brand btn-icon-sm">
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
        function createLogoCallback() {
            // Reload datatable
            $('#fast_modal').modal('toggle');
            var logos_table = $('#logos_table').DataTable();
            logos_table.ajax.reload(null, false);
        }
    </script>
    <script>
        $('.icon-font').iconpicker();
    </script>
    <script>
        $("#type").selectpicker("refresh");
    </script>
@endpush