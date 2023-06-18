@extends('dashboard.layouts.basic')

@section('content')
    <!--begin::Form-->
    <form action="{{route('users.suspend')}}" method="POST" id="suspend_user_form" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="suspendUserCallback" data-parsley-validate>
        @csrf
        <input type="hidden" name="id" value="{{$user->id}}"/>
        <div class="m-portlet__body">
           
            <div class="form-group row">

            </div>

            <div class="form-group row">
                
            </div>
            <!-- Events Assigned to -->
        </div>
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-success">{{trans('users.suspend_user_account')}}</button>
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
        function suspendUserCallback() {
            // Close modal
            $('#fast_modal').modal('toggle');
            // Reload datatable
            users_table.ajax.reload(null, false);
        }
    </script>
@endpush