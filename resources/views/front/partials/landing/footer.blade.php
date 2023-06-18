<footer class='footer' id='footer-contact'>
    <div class="container">
        <div class="row">
            <div class="col-md-5 my-5">
                <h2 class="section-title">
                    <span class="the-dash" data-scroll></span>
{{--                     <span class="the-title" data-splitting data-scroll>
                        {{__('main.easy_to')}} <span class="l-word">{{__('main.find_us')}}</span>
                    </span> --}}
                    <span class="the-title" data-scroll data-splitting>
                        {{__('main.easy_to')}} <span class="l-word">{{__('main.find_us')}}</span>
                    </span>
                </h2>
                <!-- Contact Informations -->
                @if (count($contacts))
                    <ul class="contact-info mt-3">
                        @foreach($contacts as $contact)
                            @if($contact->type == 'phone')
                                <li>
                                    <div class="icon">
                                        <ion-icon name="location-outline"></ion-icon>
                                    </div>
                                    <div>
                                        <h3>{{$contact->type}}</h3>
                                        <p>{{$contact->contact}}</p>
                                    </div>
                                </li>
                            @endif
                            @if($contact->type == 'email')
                                <li>
                                    <div class="icon">
                                        <ion-icon name='mail-outline'></ion-icon>
                                    </div>
                                    <div>
                                        <h3>{{$contact->type}}</h3>
                                        <p>{{$contact->contact}}</p>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @endif
            </div>
            <!-- Contact Form -->
            <div class="col-md-7 my-5">
                <h2 class='contact-title'>{{__('main.contact_us')}}</h2>
                <div class="contact-form">
                    <form action="" method="" class="form-contact-footer" data-parsley-validate>
                        @csrf
                        <input type="hidden" name="link" value="{{Request::url()}}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <ion-icon name="person-sharp"></ion-icon>
                                    <input type="text" class="form-control hover-target" name="full_name" placeholder="{{__('contactus::contact_us.name')}}" data-parsley-trigger="change focusout" required data-parsley-required data-parsley-required-message="{{__('main.please_enter_your_name')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <ion-icon name="mail-open"></ion-icon>
                                    <input type="email" class="form-control hover-target" name="email" placeholder="{{__('contactus::contact_us.email')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <ion-icon name="call"></ion-icon>
                                    <input type="text" class="form-control hover-target" name="phone" placeholder="{{__('contactus::contact_us.phone')}}" data-parsley-trigger="change focusout" required data-parsley-required data-parsley-required-message="{{__('main.please_enter_your_mobile_number')}}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group form-group--msg">
                                    <ion-icon name="create-sharp"></ion-icon>
                                    <textarea rows="6" class="form-control hover-target" name="message" placeholder="{{__('contactus::contact_us.message')}}"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group form-group--submit m-0">
                                    <ion-icon name="navigate"></ion-icon>
                                    <input type="button" value="{{__('main.send')}}" class="submit hover-target">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Social Links -->
        @if (count($socials))
            <div class="footer-content">
                <ul class="social-links mb-5">
                   @foreach($socials as $social)
                        <li>
                            <a title="{{$social->title}}" href="{{$social->link}}" target="_blank">
                                <span></span>
                                <span></span>
                                <span>
                                    <i class="{{$social->icon}}"></i>
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <div class="copyright">
                    <p>© 2023 team {{trans('main.all_rights_reserved')}}</p>
                </div>
            </div>
        @endif
    </div>
</footer>
