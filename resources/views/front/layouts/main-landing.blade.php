@php
$whatsapp='';
foreach($contacts as $key => $contact){
if($key == 'whatsapp'){
foreach($contact as $whats){
$whatsapp=$whats->contact;
break;
}
}
}
$phone='';
foreach($contacts as $key => $contact){
if($key == 'phone'){
foreach($contact as $whats){
$phone=$whats->contact;
break;
}
}
}
@endphp
<!DOCTYPE html>
<html @if(App::getLocale() == 'ar') dir="rtl" @else dir="ltr" @endif>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{env('APP_NAME')}} | {{$project->project}}</title>
  <link rel="icon" href="{{asset('front/landing/favicon.ico')}}">

  <link rel="stylesheet" href="{{asset('front/landing/css/bootstrap.min.css')}}?ver={{env('FILES_VER')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css" />
  <link rel="stylesheet" href="{{asset('front/landing/css/style.min.css')}}?ver={{env('FILES_VER')}}">
  <link rel="stylesheet" href="{{asset('front/css/addition.css')}}?ver={{env('FILES_VER')}}">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  @if ($setting->pixel_code)
    {!! $setting->pixel_code !!}
  @endif

  @if ($setting->tags_manager)
      {!! $setting->tags_manager !!}
  @endif
</head>

<body>

  <div class="icons-holder">
    <nav>
      <ul>
        @if($setting->active_messanger_icon)
          <li class="messenger">
            <a href="#">
              <i class="fab fa-facebook-messenger"></i>
              <span>{{__('main.messenger')}}</span>
            </a>
          </li>
        @endif
        @if($setting->active_whatsapp_icon)
          <li class="whatsapp">
            <a href="whatsapp://send?phone={{$whatsapp}}">
              <i class="fab fa-whatsapp"></i>
              <span>{{__('main.whatsapp')}}</span>
            </a>
          </li>
        @endif
        @if($setting->active_phone_icon)
          <li class="phone">
            <a href="tel:{{$phone}}">
              <i class="fas fa-phone-alt"></i>
              <span>{{__('main.call_now')}}</span>
            </a>
          </li>
        @endif
      </ul>
    </nav>
  </div>
  <!-- END GO TOP -->

  @yield('content')
  <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
  <script src="{{ URL::asset('front/js/intlTelInput-jquery.min.js') }}?ver={{ env('FILES_VER') }}"></script>
  <script src="{{URL::asset('8x/assets/js/parsley.min.js')}}?ver={{env('FILES_VER')}}" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js" type="text/javascript"></script>
  <script src="{{URL::asset('front/js/bootstrap-flash-alert.min.js')}}?ver={{env('FILES_VER')}}" type="text/javascript"></script>

<script>
    // intl tel input plugin
    $(".phone-input").each(function (e) {
            $(this).intlTelInput({ initialCountry: "eg" });
    })
    const submitBtn = document.getElementById('submit-form');
    submitBtn.addEventListener("click", () => {
        document.getElementById('block-content').innerHTML = `
        <h1 class="mb-3">شكرا لتسجيلك معنا</h1>
        <p>
            فريقنا سوف يتواصل معك فى اقرب وقت
        </p>
        `;
    })
</script>

  <script>
    function recaptchaCallback() {
        $('.myField').val('noempty');
    }
    $('.contact-from').on('click', function() {
      var form = $(this).closest('form');

      /* Parsley validate front-end */
      if (!form.parsley().isValid()) {
        // Display notification
        $.alert("{{__('main.oh_snap_change_a_few_thing_up_and_try_submitting_again')}}", {
          title: '',
          type: 'warning',
          position: ['top-right', [0, 20]],
        });

        form.find('[data-parsley-type]').each(function(i, v) {
          $(this).parsley().validate({
            focusInvalid: false,
            invalidHandler: function() {
              $(this).find(":input.error:first").focus();
            }
          });

          return;
        });
        form.find('[data-parsley-pattern]').each(function(i, v) {
          $(this).parsley().validate({
            focusInvalid: false,
            invalidHandler: function() {
              $(this).find(":input.error:first").focus();
            }
          });

          return;
        });
        form.parsley().validate({
          focusInvalid: false,
          invalidHandler: function() {
            $(this).find(":input.error:first").focus();
          }
        });

        return;
      }
      $(this).closest('form').find(".phone-input").val('+' + $(this).closest('form').find('.phone-input').intlTelInput(
                    'getSelectedCountryData')
                .dialCode + '-' + $(this).closest('form').find("input[name='phone']").val())
      console.log($(this).closest('form').find(".unit_types").val());
      // Request parameters
      var url = "{{route('contact_us.contact_us.store')}}";
      var data = form.serialize();
      var headers = {
        'content-type': 'appliction/json'
      };

      // Block UI
      $.blockUI({
        overlayColor: "#000000",
        type: "loader",
        state: "success",
        message: "<img src='{{URL::asset('front/images/loader.gif')}}'/>"
      });

      // Send the request
      $.post(url, data, headers).done(function(response) {

        // Unblock UI     
        $.unblockUI();

        // Notification message
        if (response.message) {
          // Empty notificaion messages              
          $('.messages').empty();

          // Notification type
          if (response.status) {
            $.alert(response.message, {
              title: '',
              type: 'info',
              position: ['top-right', [0, 20]],
            });

          } else {
            $.alert(response.message, {
              title: '',
              type: 'warning',
              position: ['top-right', [0, 20]],
            });
          }

          if (response.data.redirect_to) {
            window.location.href = response.data.redirect_to
          }

        }
      }).fail(function(xhr, error_text, statusText) {
        // Unblock UI            
        $.unblockUI();

        // Display notificaion
        if (xhr.responseJSON && xhr.responseJSON.errors) {
          $.each(xhr.responseJSON.errors, function(index, error) {
            $.alert(error.message, {
              title: '',
              type: 'warning',
              position: ['top-right', [0, 20]],
            });
          });
        } else {
          $.alert(statusText, {
            title: '',
            type: 'warning',
            position: ['top-right', [0, 20]],
          });

        }
      });
    });
  </script>
</body>

</html>