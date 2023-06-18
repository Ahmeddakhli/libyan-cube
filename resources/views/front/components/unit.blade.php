


<div class="card-item unit-card">
    <div class="card-item__content">

      <div class="card-item__header">
        @if($unit->project)
        @if($unit->project->developer)
        <a href="{{route('front.developers.show',['id' => $unit->project->developer->id,'slug'=>$unit->project->developer->slug])}}" class="dev-logo">
            @forelse($unit->project->developer->attachments as $attachment)
                        @if ($loop->index == 0)
                            <img onerror="this.remove()" src="{{ file_exists(public_path('/storage/dimensions/uploads/' . $attachment->file_name_without_extension . '_125x125' . '.' . $attachment->extension)) ? asset('storage/dimensions/uploads/' . $attachment->file_name_without_extension . '_125x125' . '.' . $attachment->extension) : $attachment->url }}"
                                alt="{{ $attachment->file_name }}" itemprop="logo">
                        @break
                    @endif
            @empty
                <img onerror="this.remove()" src="{{ URL::asset('front/images/placeholder.png') }}"
                    alt="{{ $unit->project->developer->developer_name }}" itemprop="logo">
            @endforelse
        </a>
        @endif
        @endif

        <div class="card-img">
            @forelse($unit->attachments as $attachment)
            @if ($loop->index == 0)
            <meta itemprop="image" content="{{file_exists(public_path('/storage/dimensionals/uploads/'.$attachment->file_name_without_extension.'_280x300'.'.'.$attachment->extension)) ? asset('storage/dimensionals/uploads/'.$attachment->file_name_without_extension.'_280x300'.'.'.$attachment->extension) : $attachment->url}}" />
            <img class="unit-img" onerror="this.remove()" src="{{file_exists(public_path('/storage/dimensionals/uploads/'.$attachment->file_name_without_extension.'_280x300'.'.'.$attachment->extension)) ? asset('storage/dimensionals/uploads/'.$attachment->file_name_without_extension.'_280x300'.'.'.$attachment->extension) : $attachment->url}}" alt="{{$attachment->alt}}" itemprop="image">
            @break
            @endif
            @empty
            <meta itemprop="image" content="{{URL::asset('front/images/placeholder.png')}}" />
            <img class="unit-img placeholder-img" onerror="this.remove()" src="{{URL::asset('front/images/placeholder.png')}}" alt="{{$unit->title}}" itemprop="image">
            @endforelse
        </div>

        <div class="commercial-tag">
          <a href="{{ route('front.properties', ['offering_types[]'=>$unit->offering_type_id]) }}">{{$unit->offering_type}}</a>
        </div>
      </div>

      <div class="card-item__footer">
        <h4 class="card-title text-truncate" title="{{$unit->title}}">
          <a href="{{route('front.singleUnit', ['id' => $unit->id,'title' => str_slug($unit->default_title)])}}">{{$unit->title}}</a>
        </h4>

        <ul class="card-info">
            @if($unit->purpose ||
            $unit->purpose_type)
          <li>
            <small>{{$unit->purpose}}</small>
            <strong>{{$unit->purpose_type}}</strong>
          </li>
          @endif
          @if($unit->price)
          <li>
            <small>{{__('main.price')}}</small>
            <strong>{{$unit->price}} EGP</strong>
          </li>
          @endif
          @if ($unit->tags)
            <li class="card-tags">
                @foreach ($unit->tags as $tag)
                    <a href="{{ route('front.properties', ['tag_id'=>$tag->id]) }}"
                        class="tag type">{{ $tag->tag }}</a>
                @endforeach
            </li>
      @endif
        </ul>

        <ul class="mt-2 d-flex flex-wrap gap-3">
            @if($unit->bedroom)

          <li title="Bedrooms">
            <svg width="18" viewBox="0 0 24 24">
              <path fill="currentColor"
                d="M20 9.557V3h-2v2H6V3H4v6.557C2.81 10.25 2 11.525 2 13v4a1 1 0 0 0 1 1h1v4h2v-4h12v4h2v-4h1a1 1 0 0 0 1-1v-4c0-1.475-.811-2.75-2-3.443zM18 7v2h-5V7h5zM6 7h5v2H6V7zm14 9H4v-3c0-1.103.897-2 2-2h12c1.103 0 2 .897 2 2v3z">
              </path>
            </svg>
            <strong>{{$unit->bedroom}}</strong>
          </li>
                      @endif
            @if($unit->bathroom)

          <li title="Bathrooms">
            <svg width="18" viewBox="0 0 512 512">
              <path fill="currentColor"
                d="M464 280H80V100a51.258 51.258 0 0 1 15.113-36.485l.4-.4a51.691 51.691 0 0 1 58.6-10.162a79.1 79.1 0 0 0 11.778 96.627l10.951 10.951l-20.157 20.158l22.626 22.626l20.157-20.157L311.157 71.471l20.157-20.157l-22.627-22.627l-20.158 20.157l-10.951-10.951a79.086 79.086 0 0 0-100.929-8.976A83.61 83.61 0 0 0 72.887 40.485l-.4.4A83.054 83.054 0 0 0 48 100v180H16v32h32v30.7a23.95 23.95 0 0 0 1.232 7.589L79 439.589A23.969 23.969 0 0 0 101.766 456h12.9L103 496h33.333L148 456h208.1l12 40h33.4l-12-40h20.73A23.969 23.969 0 0 0 433 439.589l29.766-89.3A23.982 23.982 0 0 0 464 342.7V312h32v-32ZM188.52 60.52a47.025 47.025 0 0 1 66.431 0L265.9 71.471L199.471 137.9l-10.951-10.949a47.027 47.027 0 0 1 0-66.431ZM432 341.4L404.468 424H107.532L80 341.4V312h352Z">
              </path>
            </svg>
            <strong>{{$unit->bathroom}}</strong>
          </li>
            @endif

            @if($unit->area)
          <li title="Area">
            <svg width="18" viewBox="0 0 32 32">
              <path fill="currentColor"
                d="M27 22.142V9.858A3.992 3.992 0 1 0 22.142 5H9.858A3.992 3.992 0 1 0 5 9.858v12.284A3.992 3.992 0 1 0 9.858 27h12.284A3.992 3.992 0 1 0 27 22.142ZM26 4a2 2 0 1 1-2 2a2.002 2.002 0 0 1 2-2ZM4 6a2 2 0 1 1 2 2a2.002 2.002 0 0 1-2-2Zm2 22a2 2 0 1 1 2-2a2.002 2.002 0 0 1-2 2Zm16.142-3H9.858A3.994 3.994 0 0 0 7 22.142V9.858A3.995 3.995 0 0 0 9.858 7h12.284A3.994 3.994 0 0 0 25 9.858v12.284A3.993 3.993 0 0 0 22.142 25ZM26 28a2 2 0 1 1 2-2a2.003 2.003 0 0 1-2 2Z" />
            </svg>
            <strong>{{$unit->area}} {{$unit->area_unit}}
         </strong>   <!--m<sup>2</sup>-->
          </li>
          @endif
        </ul>

      </div>

    </div>

    <div class="mt-3">
      <a class="site-btn d-block text-center stretched-link" href="{{route('front.singleUnit', ['id' => $unit->id,'title' => str_slug($unit->default_title)])}}" target="_blank" rel="noopener" noreferrer>
        {{__('main.read_more')}}...
      </a>
    </div>
  </div>