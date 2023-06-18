@extends('dashboard.layouts.basic')


@section('content')
<style>
    .fade:not(.show) {
        opacity: 1
    }
</style>
<!--begin::Form-->
<form action="{{route('settings.branches.store')}}" method="POST" id="create_branch_form" enctype="multipart/form-data" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="createBranchCallback" data-parsley-validate>
    @csrf
    <div class="m-portlet__body">
        <div class="form-group row">
            <div class="form-group row col-12">
                <div class="col-12 mt-5">
                    <label for="branch">{{__('settings::settings.branch')}} <small class="text-muted"> - {{__('settings::settings.optional')}}</small></label>
                    <input name="branch" id="branch" type="text" class="form-control" placeholder="{{__('settings::settings.branch')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('settings::settings.branch_max_is_150_characters_long')}}">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <!-- Map -->
            <div class="col-lg-12">
                <label>{{__('settings::settings.location')}}</label>
                <input id="map_search" name="map_search" class="form-control" type="text" placeholder="{{__('settings::settings.select_branch_location')}}">
                <div id="map" style="height:300px; width:100%;"></div>
                <input id="lat" name="latitude" type="hidden" value="" />
                <input id="lng" name="longitude" type="hidden" value="" />
            </div>
        </div>
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-success">{{__('main.submit')}}</button>
                        <button type="reset" class="btn btn-secondary">{{__('main.reset')}}</button>
                        {{--
                        <a href="{{route('settings.branches.create')}}" data-8xload class="btn btn-brand btn-icon-sm">
                        <i class="flaticon2-plus"></i> {{trans('settings::settings.create_new')}}
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
        function createBranchCallback() {
            // Reload datatable
            $('#fast_modal').modal('toggle');
            var branches_table = $('#branches_table').DataTable();
            branches_table.ajax.reload(null, false);
        }
    </script>
    @include('settings::branches.create-scripts')
@endpush