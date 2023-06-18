<div class="col-lg-4 col-md-6 mb-4" id="compare-box-{{$compare->id}}">
    <div class="compare-item">
        <unit-card @forelse($compare->unit->attachments as $attachment)
            data-img="{{file_exists(public_path('/storage/dimensionals/uploads/'.$attachment->file_name_without_extension.'_370x300'.'.'.$attachment->extension)) ? asset('storage/dimensionals/uploads/'.$attachment->file_name_without_extension.'_370x300'.'.'.$attachment->extension) : $attachment->url}}"
            @empty
            data-img="{{URL::asset('front/images/placeholder.png')}}"
            @endforelse

            data-title="{{$compare->unit->unit_number}}"
            data-location="<?php $locations = array(); ?>
            @if ($compare->unit->country)
            <?php array_push($locations, $compare->unit->country); ?>
            @endif
            @if ($compare->unit->region)
            <?php array_push($locations, $compare->unit->region); ?>
            @endif
            @if ($compare->unit->city)
            <?php array_push($locations, $compare->unit->city); ?>
            @endif
            @if ($compare->unit->area_place)
            <?php array_push($locations, $compare->unit->area_place); ?>
            @endif
            @if ($compare->unit->address)
            <?php array_push($locations, $compare->unit->address); ?>
            @endif
            <?php echo implode(', ', $locations); ?>"

            data-bed-count="{{$compare->unit->bedroom}}"
            data-bath-count="{{$compare->unit->bathroom}}"
            data-area="{{$compare->unit->area}}"
            data-price="{{$compare->unit->price}}"
            data-video="{{$compare->unit->video}}"
            data-url ="{{route('front.singleUnit', ['id' => $compare->unit->id, 'title' => str_slug($compare->unit->default_title)])}}"
            >
        </unit-card>
        <div class="compare__close--btn">

            <button type="button" class='remove-from-compare' compare-id="{{$compare->id}}">
                <ion-icon name="close-outline"></ion-icon>
            </button>
        </div>
    </div>
</div>