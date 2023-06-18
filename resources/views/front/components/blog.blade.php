<div class='blog'>
  <div class="row g-0">
    <div class="col-sm-5">
      <a href="{{route('front.single_blog',['id' => $blog->id,'slug' =>$blog->slug])}}" class="blog__image" target="_blank" rel="noopener" noreferrer>
        @if ($blog->attachments && isset($blog->attachments[0]))
        <img src="{{$blog->attachments[0]->url}}" alt="{{$blog->attachments[0]->file_name}}" />
        @else
        <img src="{{URL::asset('front/images/placeholder.png')}}" alt="placeholder image" />
        @endif
      </a>
    </div>

    <div class="col-sm-7">
      <div class="blog__info">
        <div class="blog__content">
          <h5 class='blog-title text-capitalize'>
            <a href="{{route('front.single_blog',['id' => $blog->id,'slug' =>$blog->slug])}}" title="{{ $blog->title}}" target="_blank" rel="noopener" noreferrer>
              {{ $blog->title}}
            </a>
          </h5>
          <p>
            <span class="icon-link me-3">
              <i class="ri-edit-2-line"></i>
              <span class="author">{{$blog->creator->full_name}}</span>
            </span>
            {{-- <span class="icon-link">
              <i class="ri-message-2-line"></i>
              <span class="msg-count">${attr("msg")}</span>
            </span> --}}
          </p>
        </div>
        <div class="text-end">
          <a href="{{route('front.single_blog',['id' => $blog->id,'slug' =>$blog->slug])}}" class="link-primary text-decoration-underline mt-3" target="_blank" rel="noopener" noreferrer>Read more...</a>
        </div>
      </div>
    </div>
  </div>
</div>