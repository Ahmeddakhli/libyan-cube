@extends('dashboard.layouts.basic')
 @section('content')
<!--begin::Form-->
<form action="{{route('inventory.units.import')}}" method="POST" id="update_unit_form" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="updateUnitCallback" data-parsley-validate>
    @csrf
    <div class="m-portlet__body">
        <div class="row">
            <div class="form-group col-12">
                <label for="file">{{__('inventory::inventory.file')}}</label>
                <input type="file" name="units_file" class="form-control" id="file" data-parsley-trigger="change focusout" />

            </div>
        </div>
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-lg-6 ">
                        <button type="submit" class="btn btn-success btn-brand">{{trans('inventory::inventory.units_import')}}</button>
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
    function updateUnitCallback() {
        // Close modal
        $('#fast_modal').modal('toggle');
        var units_table = $('#units_table').DataTable();
        units_table.ajax.reload(null, false);
    }
</script>
@endpush