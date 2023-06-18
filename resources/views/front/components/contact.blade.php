<form action="{{route('contact_us.contact_us.store')}}" method="POST" class="form-contact" data-parsley-validate>
        @csrf
        <input type="hidden" name="link" value="{{Request::url()}}">
        <input type="hidden" name="type" value="{{$type}}">
        <input type="hidden" name="position" value="{{isset($position) ? $position : null}}">
        <input type="hidden" name="city_id" value="{{isset($city_id) ? $city_id : null}}">
        <input type="hidden" name="model_name" value="{{isset($model_name) ? $model_name : null}}">

        <div class="form-group">
            <input id='full-name' type="text" name="full_name" class="form-control" placeholder="{{__('users.full_name')}}" data-parsley-trigger="change focusout" required data-parsley-required-message="{{__('main.please_enter_your_name')}}">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="{{__('users.email')}}" data-parsley-type-message="يجب أن يكون عنوان بريد إلكتروني" required data-parsley-required-message="{{__('main.please_enter_your_email')}}" >
        </div>
        <div class="form-group phone-group">
            <input type="text" class="form-control phone-input" placeholder="{{__('users.mobile_number')}}" name="phone" data-parsley-trigger="change focusout" required data-parsley-required-message="{{__('main.please_enter_your_mobile_number')}}">
        </div>
        <div class="form-group">
                <input type="text" class="date-picker-field form-control" name="best_time_to_call_from" placeholder="{{__('contactus::contact_us.best_from')}}" required data-parsley-required-message="{{__('main.please_enter_best_time_to_call')}}">
        </div>
        <div class="form-group">
            <textarea rows='5' class="form-control" placeholder="{{__('contactus::contact_us.message')}}" name="message" data-parsley-trigger="change focusout" ></textarea>
        </div>
        <div class="form-group">
            <button type="button" class="submit site-btn contact-from">
                <span class="txt">{{__('main.send')}}</span>
                <em></em>
            </button>
        </div>
    </form>