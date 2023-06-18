<section class="filter-holder pt-4">
    <div class="filter-types py-5">
        <div class="container">
            <div class="row">
                @foreach($purposes as $purpose)
                <div class="col-md-4">
                    <div class="block">
                    @if($loop->index == 0)
                        <div class="head business-head"></div>
                    @elseif($loop->index == 1) 
                        <div class="head vacation-head"></div>
                    @else 
                        <div class="head resident-head"></div>
                    @endif
                        <button class="filter business-filter" data-toggle="modal" data-target="#filter-modal" @if($loop->index == 0) data-color="rgba(25,27,45,.85)" data-bg="url('{{$purpose->image_url}}')" @elseif($loop->index == 1) data-color="rgba(30,65,104,.85)" data-bg="url('{{$purpose->image_url}}')" @else data-color="rgba(33,107,94,.85)" data-bg="url('{{$purpose->image_url}}')" @endif style="background-image: url({{$purpose->image_url}});" onclick="setPurposeValue({{$purpose->id}})">
                            {{$purpose->purpose}}
                        </button>
                    </div>
                </div>
                @if($loop->index == 2)
                    @break
                @endif
                @endforeach
                <!-- <div class="col-md-4">
                    <div class="block">
                        <div class="head vacation-head"></div>
                        <button class="filter vacation-filter" data-toggle="modal" data-target="#filter-modal" data-color="rgba(30,65,104,.85)" data-bg="url('../images/vac.jpg')">
                            أجـــــازات
                        </button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="block">
                        <div class="head resident-head"></div>
                        <button class="filter resident-filter" data-toggle="modal" data-target="#filter-modal" data-color="rgba(33,107,94,.85)" data-bg="url('../images/res.jpg')">
                            سكـــني
                        </button>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</section>
<!-- /.home-filter -->
@push('scripts')

@endpush