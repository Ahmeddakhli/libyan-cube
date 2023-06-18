@extends('dashboard.layouts.basic')

@section('content')
    <!--begin::Form-->
    <form action="{{route('groups.update')}}" method="POST" id="update_group_form" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="updateGroupCallback" data-parsley-validate>
        @csrf
        <div class="m-portlet__body">
            <input type="hidden" value="{{$group->id}}" name="id" />
            <div class="form-group m-form__group row">
                <label class="col-lg-4 col-form-label" for="name">{{trans('groups.group_name')}}</label>
                <div class="col-lg-8">
                    <input name="name" id="name" type="text" class="form-control m-input" placeholder="{{trans('groups.enter_group_name')}}" required data-parsley-required data-parsley-required-message="{{trans('groups.group_name_is_required')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="90" data-parsley-maxlength-message="{{trans('groups.group_name_max_is_90_characters_long')}}" value="{{$group->name}}">
                    <span class="m-form__help">{{trans('groups.please_enter_the_group_name')}}</span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label for="parent_id" class="col-lg-4 col-form-label">{{trans('groups.select_parent_group')}}</label>
                <div class="col-lg-8">
                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="parent_id" name="parent_id" required data-parsley-required data-parsley-required-message="{{trans('groups.parent_group_is_required')}}" data-parsley-trigger="change focusout">
                        <option value="" selected disabled>{{trans('groups.select_parent_group')}}</option>
                        @foreach ($groups as $inner_group)
                            @if ($inner_group->id != $group->id && $inner_group->parent_id != $group->id)
                                @if ($inner_group->id == $group->parent_id)
                                    <option value="{{$inner_group->id}}" selected>{{$inner_group->name}}</option>
                                @else
                                    <option value="{{$inner_group->id}}">{{$inner_group->name}}</option>
                                @endif
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label for="permissions_group_id" class="col-lg-4 col-form-label">{{trans('groups.select_permissions_group_if_any')}}</label>
                <div class="col-lg-8">
                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="permissions_group_id" name="permissions_group_id">
                        <option value="" selected disabled>{{trans('groups.select_permissions_group_if_any')}}</option>
                        @foreach ($groups as $inner_group)
                            @if ($inner_group->id != $group->id)
                                <option value="{{$inner_group->id}}">{{$inner_group->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label for="description" class="col-lg-4 col-form-label">{{trans('groups.group_description')}}</label>
                <div class="col-lg-8">
                    <textarea class="form-control m-input" id="description" name="description" rows="3" data-parsley-trigger="change focusout" data-parsley-maxlength="150"data-parsley-maxlength-message="{{trans('groups.group_description_max_is_150_characters_long')}}">{{$group->description}}</textarea>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label for="users" class="col-lg-4 col-form-label">{{trans('groups.select_deselect_users')}}</label>
                <div class="col-lg-8">
                    <select class="form-control m-bootstrap-select m_selectpicker" multiple data-actions-box="true" name="users[]" id="users">
                        @foreach ($users as $user)
                            @if (in_array($user->id, $group_users))
                                <option value="{{$user->id}}" selected>{{$user->email}}</option>
                            @else
                                <option value="{{$user->id}}">{{$user->email}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-success">{{trans('groups.update_group')}}</button>
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
        function updateGroupCallback() {
            // Close modal
            $('#fast_modal').modal('toggle');
            // Reload datatable
            groups_table.ajax.reload(null, false);
        }
    </script>
@endpush