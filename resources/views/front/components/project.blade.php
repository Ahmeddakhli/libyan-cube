<div class="card-item project-card">
    <div class="card-item__content">

        <div class="card-item__header">
            @if ($project->developer)
                <a class="dev-logo"
                    href="{{route('front.developers.show',['id' => $project->developer->id,'slug'=>$project->developer->slug])}}"
                    target="_blank" itemprop="url">
                    @forelse($project->developer->attachments as $attachment)
                        @if ($loop->index == 0)
                            <img onerror="this.remove()" src="{{ file_exists(public_path('/storage/dimensions/uploads/' . $attachment->file_name_without_extension . '_125x125' . '.' . $attachment->extension)) ? asset('storage/dimensions/uploads/' . $attachment->file_name_without_extension . '_125x125' . '.' . $attachment->extension) : $attachment->url }}"
                                alt="{{ $attachment->file_name }}" itemprop="logo">
                        @break
                    @endif
                @empty
                    <img onerror="this.remove()" src="{{ URL::asset('front/images/placeholder.png') }}"
                        alt="{{ $project->developer->developer_name }}" itemprop="logo">
                @endforelse
            </a>
        @else
        <a class="dev-logo"
        href="#"
        target="_blank" itemprop="url">
            <img onerror="this.remove()" src="{{ URL::asset('front/images/placeholder.png') }}" alt="No Developer" itemprop="logo">
        </a>
        @endif


        <div class="card-img">
            @forelse($project->attachments as $attachment)
                @if (file_exists(public_path('/storage/' . $attachment->path)))
                    <meta itemprop="{{ $project->project }}" content="{{ $attachment->url }}" />
                    <img onerror="this.remove()" src="{{ $attachment->url }}" alt="{{ $attachment->alt }}"
                        itemprop="{{ $project->project }}">
                @break
            @endif
        @empty
            <img onerror="this.remove()" src="{{ URL::asset('front/images/placeholder.png') }}" alt="{{ $project->project }}">
        @endforelse
    </div>
</div>

<div class="card-item__footer">
    <h4 class="card-title text-truncate" title="{{ $project->project }}">
        <a href="{{ route('front.singleProject', ['id' => $project->id, 'slug' => $project->slug]) }}">{{ $project->project }}</a>
    </h4>
    @if ($project->city)

        <address class="address" class="text-truncate">
            <i class="ri-map-pin-line"></i>
            <?php $locations_array = []; ?>
            @if ($project->city)
                <?php array_push($locations_array, $project->city->name); ?>
            @endif
            @if (count($locations_array))
                {{ implode(', ', $locations_array) }}
            @endif
        </address>
    @endif

    <ul class="card-info">
        @if ($project->area_from)
            <li>
                <small>{{ __('main.area_from') }}:</small>
                <strong>{{ $project->area_from }}</strong> m<sup>2</sup>
            </li>
        @endif
        @if ($project->price_from)
            <li>
                <small>{{ __('main.starting_price') }}:</small>
                <strong>{{ $project->price_from }} EGP</strong>
            </li>
        @endif
        @if ($project->number_of_installments_from)
            <li>
                <small>{{ __('main.installments') }}:</small>
                <strong>{{ $project->number_of_installments_from }}</strong> Years
            </li>
        @endif

        @if ($project->tags)
            <li class="card-tags">
                @foreach ($project->tags as $tag)
                    <a href="{{ route('front.projects', ['tag_id' => $tag->id]) }}"
                        class="tag type">{{ $tag->tag }}</a>
                @endforeach
            </li>
        @endif
    </ul>

</div>

</div>

<div class="mt-3">
<a class="site-btn d-block text-center stretched-link"
    href="{{ route('front.singleProject', ['id' => $project->id, 'slug' => $project->slug]) }}"
    target="_blank" rel="noopener" noreferrer>
    {{ __('main.read_more') }}...
</a>
</div>
</div>
