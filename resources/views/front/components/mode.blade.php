    <!--  DARK MODE  -->
<div class="change-mode">
    <input id='switch' name='theme' type="checkbox">
    <label for="switch">
        <ion-icon class='sun' name="sunny-sharp"></ion-icon>
        <ion-icon class='moon' name="moon-sharp"></ion-icon>
        <div class="ball"></div>
    </label>
</div>
<!-- SHOW OVERLAY BOVE ALL CONTENT (IN MOBILE VERSION) WHEN MENU IS OPENED -->
<div class="overlay__mask"></div>

<!-- START BLOCK REVEAL ( FOR INTRO ANIMATE ) -->
@if (Route::currentRouteName() == 'front.home')

    <div class="reveal-block one">
        <div class="logo">
            <img src="{{URL::asset('front/images/logo.png')}}" alt="mode">
            <!-- <div class="preloader"></div> -->
            <div class="loading-block"></div>
        </div>
    </div>
    <!-- <div class="reveal-block two"></div> -->

@endif

<!-- END BLOCK REVEAL -->
    <!-- START BACK TO TOP BUTOON -->
<div class="back-to-top">
    <ion-icon name="chevron-up-outline" class='chev'></ion-icon>
    <span><a href="#">{{__('main.back_to_top')}}</a></span>
</div>
  <!-- END BACK TO TOP BUTOON -->