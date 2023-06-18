

<footer class='main-footer'>
    <div class="container">

        <div class="contacts__social">
            <span class="d-md-block d-none">{{ __('main.follow_us') }}:</span>
            @foreach ($socials as $social)
                <a class="contacts__social--link" href="{{ $social->link }}" target="_blank"><i
                        class="{{ $social->icon }}"></i></a>
            @endforeach
        </div>
    </div>

    <hr>

    <div class="container">

        <div class="accordion">
            <div class="row my-md-5 py-md-3">

                <div class="col-lg-3 col-md-6">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#footer-acc-1" aria-expanded="false">
                                {{ __('main.contact_us') }}
                            </button>
                        </h2>
                        <div id="footer-acc-1" class="accordion-collapse collapse dont-collapse-sm">
                            <div class="accordion-body">
                                <ul>
                                    @foreach ($contacts as $key => $contact)
                                        @if ($key == 'address')
                                            @foreach ($contact as $address)
                                                <li>
                                                    <address>
                                                        <i class="ri-map-pin-line"></i>
                                                        @if (App::getLocale() == 'ar')
                                                            {{ $address->contact_ar }}
                                                        @else
                                                            {{ $address->contact }}
                                                        @endif
                                                    </address>
                                                </li>
                                            @endforeach
                                        @endif
                                    @endforeach
                                    @foreach ($contacts as $key => $contact)
                                        @if ($key == 'phone')
                                            @foreach ($contact as $phone)
                                                <li>
                                                    <a href='tel:+{{ $phone->contact }}'>
                                                        <i class="ri-phone-line"></i>
                                                        <bdi>+{{ $phone->contact }}</bdi>
                                                    </a>
                                                </li>
                                            @endforeach
                                        @endif
                                    @endforeach
                                    @foreach ($contacts as $key => $contact)
                                        @if ($key == 'email')
                                            @foreach ($contact as $email)
                                                <li>
                                                    <a href='mailto:{{ $email->contact }}'>
                                                        <i class="ri-mail-line"></i>
                                                        {{ $email->contact }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#footer-acc-2" aria-expanded="false">
                                {{__('main.fast_links')}}
                            </button>
                        </h2>
                        <div id="footer-acc-2" class="accordion-collapse collapse dont-collapse-sm">
                            <div class="accordion-body">
                                <ul class='text-capitalize'>
                                    <li><a href="{{route('front.about')}}">{{__('main.about_us')}}</a></li>
                                    <li><a href="{{route('front.home')}}">{{__('main.home_title')}}</a></li>
                                    <li><a href="{{route('front.properties')}}">{{__('main.all_properties')}}</a></li>
                                    <li><a href="{{route('front.blogs')}}">{{__('main.blog')}}</a></li>
                                    <li><a href="{{route('front.projects')}}">{{__('main.projects')}}</a></li>
                                    <li><a href="{{route('front.privacies')}}">{{__('main.privcy_policy')}}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#footer-acc-3" aria-expanded="false">
                                {{__('main.properties')}}
                            </button>
                        </h2>
                        <div id="footer-acc-3" class="accordion-collapse collapse dont-collapse-sm">
                            <div class="accordion-body">
                                <ul class='text-capitalize'>
                                    {{-- @foreach($footer_units as $footer_unit)
                                        <li><a href="{{route('front.singleUnit', ['id' => $footer_unit->id,'title' => str_slug($footer_unit->default_title)])}}">{{$footer_unit->title}}</a></li>
                                    @endforeach --}}
                                    @foreach ($offering_types as $offering_type)
                                    <li><a class="dropdown-item" style="--delay:.{{$loop->index}}s"
                                            href="{{ route('front.properties', ['offering_types[]' => $offering_type->id]) }}">{{ $offering_type->offering_type }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#footer-acc-4" aria-expanded="false">
                                {{__('main.projects')}}
                            </button>
                        </h2>
                        <div id="footer-acc-4" class="accordion-collapse collapse dont-collapse-sm">
                            <div class="accordion-body">
                                <ul class='text-capitalize'>
                                    @foreach($footer_projects as $footer_project)
                                    <li><a href="{{ route('front.singleProject', ['id' => $footer_project->id, 'slug' => $footer_project->project]) }}">{{$footer_project->project}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="copyrights text-center">
        <div class="container">
          <p>
                <bdi>
                    {{__('main.all_rights_reserved')}}

                    {{__('main.all_rights_reserved_after')}}
                    <bdi>
                        <i class="ri-heart-fill ri-lg"></i>
                        <a href='' target='_blank' class='eight-worx-webpage'>
                            team
                        </a>
                        &trade;
                    </bdi>
                </bdi>
            </p>
        </div>
    </div>
</footer>
