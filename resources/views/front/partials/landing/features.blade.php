<div class="container">
    <h2 class="section-title">
        <span class="the-dash" data-scroll></span>
        {{-- <span class="the-title" data-splitting data-scroll>01. {{__('main.features')}}</span> --}}
        <span class="the-title" data-scroll data-splitting>01. {{ __('main.features') }}</span>
    </h2>
    <div class="row">
        @foreach ($unit->facilities as $facility)
            <div class="col-md-6 mb-3">
                <div class="feature">
                    <div class="icon mb-3">
                        @if ($facility->svg)
                            {!! $facility->svg !!}
                        @else
                            @if ($facility->attachments)
                                <img class="img-icon"
                                    src="{{ file_exists(public_path('/storage/dimensions/uploads/' .$facility->attachments[0]->file_name_without_extension .'_370x300' .'.' .$facility->attachments[0]->extension))? asset('storage/dimensions/uploads/' .$facility->attachments[0]->file_name_without_extension .'_370x300' .'.' .$facility->attachments[0]->extension): $facility->attachments[0]->url }}"
                                    alt="{{ $facility->facility }}">
                            @else
                                <img src="{{ URL::asset('front/images/placeholder.png') }}" alt="placeholder">
                            @endif

                        @endif
                    </div>
                    <div class="title mb-2">
                        <h5 class="text-capitalize">{{ $facility->facility }}</h5>
                    </div>
                    <div class="desc">
                        <p>{{ $facility->description }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="gate">
        <img src="{{ URL::asset('/front/landing/img/b.jpg') }}" class='img-fluid'
            alt="{{ trans('landing.gate_image') }}">
    </div>
</div>
