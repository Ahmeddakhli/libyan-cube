@extends('dashboard.layouts.basic')

@section('content')
<style>
    .fade:not(.show) {
        opacity: 1
    }
</style>
<!--begin::Form-->
<form action="{{route('settings.branches.update')}}" method="POST" id="update_branch_form" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="updateBranchCallback" data-parsley-validate enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id" value="{{$branch->id}}" />
    <div class="m-portlet__body">
        <div class="form-group row col-12">
            <div class="form-group col-12 position-relative">
                <div class="col-12 mt-5 position-relative">
                    <label for="branch">{{__('settings::settings.branch')}} <small class="text-muted"> - {{__('settings::settings.optional')}}</small></label>
                    <input name="branch" id="branch" value="{{$branch->branch}}" type="text" class="form-control" placeholder="{{__('settings::settings.branch')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('settings::settings.branch_max_is_150_characters_long')}}">
                </div>
            </div>
        </div>
         <div class="form-group row">
             <!-- Map -->
             <div class="col-lg-12">
                 <label>{{__('settings::settings.location')}}</label>
                 <input id="map_search" name="map_search" class="form-control" type="text" placeholder="{{__('settings::settings.select_branch_location')}}">
                 <div id="map" style="height:300px; width:100%;"></div>
                 <input id="lat" name="latitude" type="hidden" value="{{$branch->latitude}}" />
                 <input id="lng" name="longitude" type="hidden" value="{{$branch->longitude}}" />
             </div>
         </div>
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-success btn-brand">{{trans('settings::settings.update_branch')}}</button>
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
        function updateBranchCallback() {
            // Close modal
            $('#fast_modal').modal('toggle');
            // Reload datatable
            var branches_table = $('#branches_table').DataTable();
            branches_table.ajax.reload(null, false);
        }
    </script>
    <script>
        @if($branch->latitude && $branch->longitude)
            MapHelper.initMap(true, true, true, false, {
                'lat': '{{$branch->latitude}}',
                'lng': '{{$branch->longitude}}',
                'id': 'map',
                'map_search': 'map_search'
            });
        @else
            MapHelper.initMap(true, true, true, false);
        @endif
    </script>
@endpush