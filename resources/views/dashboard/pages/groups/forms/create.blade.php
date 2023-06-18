<!--begin::Form-->
<form action="{{route('groups.store')}}" method="POST" id="create_group_form" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="createGroupCallback" data-parsley-validate>
    @csrf
    <div class="m-portlet__body">
        <div class="form-group m-form__group row">
            <label class="col-lg-2 col-form-label" for="name">{{trans('groups.group_name')}}</label>
            <div class="col-lg-6">
                <input name="name" id="name" type="text" class="form-control m-input" placeholder="{{trans('groups.enter_group_name')}}" required data-parsley-required data-parsley-required-message="{{trans('groups.group_name_is_required')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="90" data-parsley-maxlength-message="{{trans('groups.group_name_max_is_90_characters_long')}}">
                <span class="m-form__help">{{trans('groups.please_enter_the_group_name')}}</span>
            </div>
        </div>
        {{--
        <div class="form-group m-form__group row">
            <label for="parent_id" class="col-lg-2 col-form-label">{{trans('groups.select_parent_group')}}</label>
            <div class="col-lg-6">
                <select class="form-control m-input" id="parent_id" name="parent_id">
                    <!-- <option>{{trans('groups.select_parent_group')}}</option> -->
                    <option></option>
                    @foreach ($groups as $group)
                        <option value="{{$group->id}}">{{$group->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        --}}
        <div class="form-group m-form__group row">
            <label for="parent_id" class="col-lg-2 col-form-label">{{trans('groups.select_parent_group')}}</label>
            <div class="col-lg-6">
                <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="parent_id" name="parent_id" required data-parsley-required data-parsley-required-message="{{trans('groups.parent_group_is_required')}}" data-parsley-trigger="change focusout">
                    <option value="" selected disabled>{{trans('groups.select_parent_group')}}</option>
                    @foreach ($groups as $group)
                        <option value="{{$group->id}}">{{$group->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        {{--
        <div class="form-group m-form__group row">
            <label for="permissions_group_id" class="col-lg-2 col-form-label">{{trans('groups.select_permissions_group_if_any')}}</label>
            <div class="col-lg-6">
                <select class="form-control m-input" id="permissions_group_id" name="permissions_group_id">
                    <!-- <option>{{trans('groups.select_permissions_group_if_any')}}</option> -->
                    <option></option>
                    @foreach ($groups as $group)
                        <option value="{{$group->id}}">{{$group->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        --}}
        <div class="form-group m-form__group row">
            <label for="permissions_group_id" class="col-lg-2 col-form-label">{{trans('groups.select_permissions_group_if_any')}}</label>
            <div class="col-lg-6">
                <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="permissions_group_id" name="permissions_group_id">
                    <option value="" selected disabled>{{trans('groups.select_permissions_group_if_any')}}</option>
                    @foreach ($groups as $group)
                        <option value="{{$group->id}}">{{$group->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group m-form__group row">
            <label for="description" class="col-lg-2 col-form-label">{{trans('groups.group_description')}}</label>
            <div class="col-lg-10">
                <textarea class="form-control m-input" id="description" name="description" rows="3" data-parsley-trigger="change focusout" data-parsley-maxlength="150"data-parsley-maxlength-message="{{trans('groups.group_description_max_is_150_characters_long')}}"></textarea>
            </div>
        </div>
        <div class="form-group m-form__group row">
            <label for="users" class="col-lg-2 col-form-label">{{trans('groups.select_deselect_users')}}</label>
            <div class="col-lg-10">
                <select class="form-control m-bootstrap-select m_selectpicker" multiple data-actions-box="true" name="users[]" id="users">
                    @foreach ($users as $user)
                        <option value="{{$user->id}}">{{$user->email}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
        <div class="m-form__actions m-form__actions--solid">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-success">{{__('main.submit')}}</button>
                    <button type="reset" class="btn btn-secondary">{{__('main.close')}}</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!--end::Form-->
@push('scripts')
    <!-- Get groups -->
    <script>
        function getGroups() {
            $("#parent_id").selectpicker('refresh').empty();
            $("#permissions_group_id").selectpicker('refresh').empty();
            $.ajax({
                url: "{{route('groups.all')}}",
                type: "GET",
                success: function(response) {
                    if (response.status) {
                        $('#parent_id').append('<option value="" selected disabled>{{trans('groups.select_parent_group')}}</option>');
                        $('#permissions_group_id').append('<option value="" selected disabled>{{trans('groups.select_permissions_group_if_any')}}</option>');
                        $.each(response.data, function(i, group) {
                            $('#parent_id').append($('<option>', {
                                value: group.id,
                                text: group.name
                            }));
                            $('#permissions_group_id').append($('<option>', {
                                value: group.id,
                                text: group.name
                            }));
                        });
                        $(".m_selectpicker").selectpicker("refresh").trigger('change');
                    } else {
                        showNotification(response.message, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(errorThrown);
                }
            });
        }
    </script>
    <!-- Get Users -->
    <script>
        function getUsers() {
            $("#users").selectpicker('refresh').empty();
            $.ajax({
                url: "{{route('users.all')}}",
                type: "GET",
                success: function(response) {
                    if (response.status) {
                        $.each(response.data, function(i, user) {
                            $('#users').append($('<option>', {
                                value: user.id,
                                text: user.email
                            }));
                        });
                        $(".m_selectpicker").selectpicker("refresh").trigger('change');
                    } else {
                        showNotification(response.message, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(errorThrown);
                }
            });
        }
    </script>
    <!-- Callback function -->
    <script>
        function createGroupCallback() {
            // Load drop-down(s)
            getGroups();
            getUsers();
        }
    </script>
@endpush