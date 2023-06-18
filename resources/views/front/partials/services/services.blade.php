@section('title', trans('services::services.services'))


@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('front.home') }}">
                        {{ __('main.home_title') }}
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('main.services') }}</li>
            </ol>
        </div>
    </nav>
@endsection
<section class="services-page pb-5">

    <div class="container">

        <div class="section-title">
            <div class="section-title">
                <h1 class="title h2">{{ __('main.our_services') }}</h1>
            </div>
            {{-- <p class="text-capitalize">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam
          repudiandae saepe, fuga, facere eveniet adipisci recusandae voluptatem animi eligendi, laborum incidunt
          necessitatibus. Qui voluptatum repellat dignissimos, quam velit ex tenetur. Corrupti officia repellat
          repellendus! Eum amet eos asperiores quia autem nemo quisquam, soluta unde beatae fugit magni inventore a
          sint.</p> --}}
        </div>

        <div class="grid-container">
          @foreach($services as $service)
            <div class="service-card">
                <div class="logo">
                    <i class="{{ $service->icon }} fa-2x"></i>
                </div>
                <span class="service-title">{{ $service->service }}</span>
                <p class='desc'>{{ $service->description }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
