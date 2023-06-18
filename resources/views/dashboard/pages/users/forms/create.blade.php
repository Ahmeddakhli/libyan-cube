<!--begin::Form-->
<form action="{{route('users.store')}}" method="POST" id="create_user_form" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="createUserCallback" data-parsley-validate>
    @csrf
    <input type="hidden" name="remember_me" value="0"/>
    <div class="m-portlet__body">
        <div class="form-group m-form__group row">
            <label class="col-lg-2 col-form-label" for="username">{{trans('users.username')}}</label>
            <div class="col-lg-6">
                <input name="username" id="username" type="text" class="form-control m-input" placeholder="{{trans('users.enter_username')}}" required data-parsley-required data-parsley-required-message="{{trans('users.username_is_required')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{trans('users.username_max_is_150_characters_long')}}">
                <span class="m-form__help">{{trans('users.please_enter_the_username')}}</span>
            </div>
        </div>
        <div class="form-group m-form__group row">
            <label class="col-lg-2 col-form-label" for="email">{{trans('users.email')}}</label>
            <div class="col-lg-6">
                <input name="email" id="email" type="text" class="form-control m-input" placeholder="{{trans('users.enter_email')}}" required data-parsley-required data-parsley-required-message="{{trans('users.email_is_required')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{trans('users.email_max_is_150_characters_long')}}" data-parsley-type="email" data-parsley-type-message="{{trans('users.email_is_invalid')}}">
                <span class="m-form__help">{{trans('users.please_enter_the_email')}}</span>
            </div>
        </div>
        <div class="form-group m-form__group row">
            <label class="col-lg-2 col-form-label" for="password">{{trans('users.password')}}</label>
            <div class="col-lg-6">
                <input name="password" id="password" type="password" class="form-control m-input" placeholder="{{trans('users.enter_password')}}" required data-parsley-required data-parsley-required-message="{{trans('users.password_is_required')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{trans('users.password_max_is_150_characters_long')}}" data-parsley-minlength="6" data-parsley-minlength-message="{{trans('users.password_min_is_6_characters_long')}}">
                <span class="m-form__help">{{trans('users.please_enter_the_password')}}</span>
            </div>
        </div>
        <div class="form-group m-form__group row">
            <label class="col-lg-2 col-form-label" for="password_confirmation">{{trans('users.password_confirmation')}}</label>
            <div class="col-lg-6">
                <input name="password_confirmation" id="password_confirmation" type="password" class="form-control m-input" placeholder="{{trans('users.enter_password_confirmation')}}" required data-parsley-required data-parsley-required-message="{{trans('users.password_confirmation_is_required')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{trans('users.password_confirmation_max_is_150_characters_long')}}" data-parsley-minlength="6" data-parsley-minlength-message="{{trans('users.password_confirmation_min_is_6_characters_long')}}">
                <span class="m-form__help">{{trans('users.please_enter_the_password_confirmation')}}</span>
            </div>
        </div>
        <div class="form-group m-form__group row">
            <label class="col-lg-2 col-form-label" for="mobile_number">{{trans('users.mobile_number')}}</label>
            <div class="col-lg-6">
                <input name="mobile_number" id="mobile_number" type="text" class="form-control m-input" placeholder="{{trans('users.enter_mobile_number')}}" required data-parsley-required data-parsley-required-message="{{trans('users.mobile_number_is_required')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{trans('users.mobile_number_max_is_150_characters_long')}}" data-parsley-pattern="/((?:\+|00)[17](?: |\-)?|(?:\+|00)[1-9]\d{0,2}(?: |\-)?|(?:\+|00)1\-\d{3}(?: |\-)?)?(0\d|\([0-9]{3}\)|[1-9]{0,3})(?:((?: |\-)[0-9]{2}){4}|((?:[0-9]{2}){4})|((?: |\-)[0-9]{3}(?: |\-)[0-9]{4})|([0-9]{7}))/" data-parsley-pattern="{{trans('users.mobile_number_is_invalid')}}">
                <span class="m-form__help">{{trans('users.please_enter_the_mobile_number')}}</span>
            </div>
        </div>
        <div class="form-group m-form__group row">
            <label for="group_id" class="col-lg-2 col-form-label">{{trans('users.select_group')}}</label>
            <div class="col-lg-6">
                <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="group_id" name="group_id" required data-parsley-required data-parsley-required-message="{{trans('users.group_id_required')}}" data-parsley-trigger="change focusout">
                    <option value="" selected disabled>{{trans('users.select_group')}}</option>
                    @foreach ($groups as $group)
                        <option value="{{$group->id}}">{{$group->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group m-form__group row">
            <label class="col-lg-2 col-form-label" for="full_name">{{trans('users.full_name')}}</label>
            <div class="col-lg-6">
                <input name="full_name" id="full_name" type="text" class="form-control m-input" placeholder="{{trans('users.enter_full_name')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{trans('users.full_name_max_is_150_characters_long')}}">
                <span class="m-form__help">{{trans('users.please_enter_the_full_name')}}</span>
            </div>
        </div>
        <div class="form-group m-form__group row">
            <label class="col-lg-2 col-form-label" for="gender">{{trans('users.gender')}}</label>
            <div class="col-lg-6">
                <input type="radio" class="gender" value="1" name="gender" required data-parsley-required="true" data-parsley-required-message="{{trans('users.gender_is_required')}}" style="height:20px;width:25px;" tabindex="1997"> Male
                <input type="radio" class="gender" value="2" name="gender" required data-parsley-required="true" data-parsley-required-message="{{trans('users.gender_is_required')}}"" style="height:20px;width:25px;" tabindex="1997"> Female
            </div>
        </div>
        <div class="form-group m-form__group row">
            <label class="col-lg-2 col-form-label" for="image">{{trans('users.image')}}</label>
            <div class="col-lg-6">
                <input type="file" id="image" data-parsley-trigger="change focusout" data-parsley-filemaxmegabytes="2" data-parsley-filemimetypes="image/jpg, image/jpeg, image/png" name="image">
            </div>
        </div>
        <div class="form-group m-form__group row">
            <label class="col-lg-2 col-form-label" for="job_title">{{trans('users.job_title')}}</label>
            <div class="col-lg-6">
                <input name="job_title" id="job_title" type="text" class="form-control m-input" placeholder="{{trans('users.enter_job_title')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{trans('users.job_title_max_is_150_characters_long')}}">
                <span class="m-form__help">{{trans('users.please_enter_the_job_title')}}</span>
            </div>
        </div>
        <div class="form-group m-form__group row">
            <label class="col-lg-2 col-form-label" for="age">{{trans('users.age')}}</label>
            <div class="col-lg-6">
                <input type="text" class="form-control" placeholder="{{trans('users.age')}}" data-parsley-required="true" id="age" data-parsley-required-message="{{trans('users.age_is_required')}}" data-parsley-trigger="change focusout" data-parsley-type="integer" name="age" data-parsley-range="[1, 999]">
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
    <!-- Callback function -->
    <script>
        function createUserCallback() {
            //
        }
    </script>
@endpush