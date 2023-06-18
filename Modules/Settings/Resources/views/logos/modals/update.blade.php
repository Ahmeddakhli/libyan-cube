@extends('dashboard.layouts.basic')

@section('content')
<style>
    .fade:not(.show) {
        opacity: 1
    }
</style>
<!--begin::Form-->
<form action="{{route('settings.logos.update')}}" method="POST" id="update_logo_form" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="updateLogoCallback" data-parsley-validate enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id" value="{{$logo->id}}" />
    <div class="m-portlet__body">

        <div class="form-group row col-12">
            <div class="col-12 mt-5">
                <label for="image">{{__('settings::settings.logo')}}</label>
                <input name="image" id="image" type="file" placeholder="{{__('settings::settings.please_upload_the_logo')}}" data-parsley-trigger="change focusout">
                <br>
                <img src="{{asset('storage/'.$logo->value)}}" style="width:100px;" alt="" srcset="">
            </div>
            <div class="col-12 mt-5">
                <label for="type">{{__('settings::settings.select_type')}}</label>
                <select name="type" id="type" class="form-control" class="form-control selectpicker" data-live-search="true" required data-parsley-required data-parsley-required-message="{{__('settings::settings.please_select_the_type')}}" data-parsley-trigger="change focusout" data-parsley-errors-container="#type_error_container">
                    <option selected disabled value="">{{__('settings::settings.select_type')}}</option>
                    <option value="header" @if($logo->type == 'header') selected @endif>{{trans('settings::settings.header')}}</option>
                    <option value="footer" @if($logo->type == 'footer') selected @endif >{{trans('settings::settings.footer')}}</option>
                </select>
                <div id="type_error_container" class="error_container"></div>
            </div>
        </div>
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-success btn-brand">{{trans('settings::settings.update_logo')}}</button>
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
        function updateLogoCallback() {
            // Close modal
            $('#fast_modal').modal('toggle');
            // Reload datatable
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