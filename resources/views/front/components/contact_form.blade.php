<button class="show-contact-us" title="Contact us" data-bs-toggle="collapse" data-bs-target=".floated-contact-form">
    <i class="ri-mail-unread-line ri-xl"></i>
  </button>

  <div class="collapse floated-contact-form">
    <div class="form-holder">
      <div class="text-end">
        <button class="btn-close" data-bs-toggle="collapse" data-bs-target=".floated-contact-form"></button>
      </div>
  
      <h4 class="form-title">{{ __('main.contact_us') }}</h4>
  
    <form action="{{ route('contact_us.contact_us.store') }}" method="POST" class="form-contact"
        data-parsley-validate>
        @csrf
        <input type="hidden" name="link" value="{{ Request::url() }}">
        <input type="hidden" name="type" value="{{ $type }}">
        <input type="hidden" name="position" value="{{ isset($position) ? $position : null }}">
        <input type="hidden" name="city_id" value="{{ isset($city_id) ? $city_id : null }}">
        <input type="hidden" name="model_name" value="{{ isset($model_name) ? $model_name : null }}">
        <div class="form-floating mb-1">
          <input type="text" class="form-control" inputmode="text" name="full_name" placeholder="{{ __('users.full_name') }}"
          data-parsley-trigger="change focusout" required
          data-parsley-required-message="{{ __('main.please_enter_your_name') }}">
          <label class="contact-label">{{ __('users.full_name') }}</label>
        </div>
        <div class="form-floating mb-1">
          <input type="email" class="form-control" inputmode="email" name="email" placeholder="{{ __('users.email') }}" required
          data-parsley-required-message="{{ __('main.please_enter_your_email') }}">
          <label class="contact-label">{{ __('users.email') }}</label>
        </div>
        <div class="form-floating mb-1">
          <input type="text" class="form-control" inputmode="tel" placeholder="{{ __('users.mobile_number') }}"
          name="phone" data-parsley-trigger="change focusout" required
          data-parsley-required-message="{{ __('main.please_enter_your_mobile_number') }}">
          <label class="contact-label">{{ __('users.mobile_number') }}</label>
        </div>
        <div class="form-floating">
          <textarea class="form-control" inputmode="text" placeholder="{{ __('contactus::contact_us.message') }}"
          name="message" data-parsley-trigger="change focusout"></textarea>
          <label class="contact-label">{{ __('contactus::contact_us.message') }}</label>
        </div>
        <div class="mt-2">
          <button type="submit" class="site-btn contact-from">{{ __('main.send') }}</button>
        </div>
      </form>
    </div>
  </div>