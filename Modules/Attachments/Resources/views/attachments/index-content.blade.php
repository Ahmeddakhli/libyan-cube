@section('title', trans('blog::blog.attachments'))

<style>
    .card-img-top{
        min-height: 300px;
        max-height: 300px;
    }
</style>
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

    <!-- begin:: Content -->
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <!-- begin:: Content -->
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand fa fa-list"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            <span data-8xloadtitle>{{trans('blog::blog.attachments')}}</span>
                            <small>{{trans('blog::blog.list')}}</small>
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">


                        </div>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    <div class="row">

                        @foreach($attachments['attachments'] as $attachment)
                        <div class="col-3 my-3">
                            <div class="card">
                                <img class="card-img-top" src="{{$attachment->url}}">
                                <div class="card-body">
                                    <p id="input-{{$attachment->id}}"> {{$attachment->url}}</p>
                                    <input type="hidden" id="input-{{$attachment->id}}" value="{{$attachment->url}}">
                                    <button class="btn btn-primary" onclick="copyToClipboard('#input-{{$attachment->id}}')">copy</button>
                                </div>
                              </div>
                        </div>
                        @endforeach
                        @foreach($attachments['media'] as $media)
                        <div class="col-3 my-3">
                            <div class="card">
                                <img class="card-img-top" src="{{$media->url}}">
                                <div class="card-body">
                                    <p id="input-{{$media->id}}"> {{$media->url}}</p>
                                    <input type="hidden" id="input-{{$media->id}}" value="{{$media->url}}">
                                    <button class="btn btn-primary" onclick="copyToClipboard('#input-{{$media->id}}')">copy</button>
                                </div>
                              </div>
                        </div>
                        @endforeach

                        {{$attachments['attachments']->appends(request()->input())->links('front.partials.primary.pagination')}}

                    </div>
                </div>
            </div>
        </div>

        <!-- end:: Content -->
    </div>
    <!-- end:: Content -->
</div>