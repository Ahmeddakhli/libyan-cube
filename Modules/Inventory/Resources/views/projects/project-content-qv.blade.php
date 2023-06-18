<div class="row">
    <div class="col-12">
        <ul class="nav nav-pills nav-fill" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#summary">{{__('inventory::inventory.summary')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#location">{{__('inventory::inventory.location')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#project_gallery">
                    {{__('inventory::inventory.gallery')}}
                    @if($i_project->attachmentables)
                        <span class="kt-badge kt-badge--primary kt-badge--inline kt-badge--pill kt-margin-l-5">{{count($i_project->attachmentables)}}</span>
                    @endif
                </a>
            </li>

        </ul>

        <div class="tab-content">

            <div class="tab-pane active" id="summary" role="tabpanel">

                <!-- Unit Description -->
                @if ($i_project->description)
                    <div class="row">
                        <div class="col-12">
                            <p>{!!$i_project->description!!}</p>
                        </div>
                    </div>
                @endif
                <!-- Unit Description -->

                <div class="row">
                    <div class="col-4">
                        <div class="kt-widget6 kt-widget6-bi">
                            <div class="kt-widget6__body">

                                @if($i_project->project)
                                    <div class="kt-widget6__item">
                                        <span>
                                            {{__('inventory::inventory.project')}}:
                                        </span>
                                        <span class="kt-font-success kt-font-bold">
                                            {{$i_project->project}}
                                        </span>
                                    </div>
                                @endif
                                @if ($i_project->area_from)
                                <div class="kt-widget6__item">
                                        <span>
                                            {{__('inventory::inventory.area_from')}}:
                                        </span>
                                        <span class="kt-font-success kt-font-bold">
                                            {{$i_project->area_unit}} @if ($i_project->area_from) {{$i_project->area_from}} @endif
                                        </span>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="kt-widget6 kt-widget6-bi">
                            <div class="kt-widget6__body">

                                <?php $locations_array = array(); ?>
                                @if ($i_project->country)
                                    <?php array_push($locations_array, $i_project->country->name) ?>
                                @endif
                                @if ($i_project->region)
                                    <?php array_push($locations_array, $i_project->region->name) ?>
                                @endif
                                @if ($i_project->city)
                                    <?php array_push($locations_array, $i_project->city->name) ?>
                                @endif
                                @if ($i_project->area)
                                    <?php array_push($locations_array, $i_project->area->name) ?>
                                @endif

                                @if (count($locations_array))
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.location')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{ implode(', ', $locations_array) }}
                                    </span>
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="kt-widget6 kt-widget6-bi">
                            <div class="kt-widget6__body">

                                @if($i_project->price_from)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.price_from')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{$i_project->full_price_from}}
                                    </span>
                                </div>
                                @endif

                                @if ($i_project->number_of_installments_from)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.number_of_installments_from')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{$i_project->number_of_installments_from}}
                                    </span>
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>

                @if($i_project->facilities)
                <hr>
                <div class="row">
                    <div class="col-12">
                        @foreach($i_project->facilities as $facility)
                        <span class="kt-badge kt-badge--inline kt-badge--brand kt-badge--md kt-badge--tag kt-badge--rounded "><i class="fa-sm fa fa-tag"></i> {{$facility->facility}}</span>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($i_project->amenities)
                <div class="row kt-margin-t-10">
                    <div class="col-12">
                        @foreach($i_project->amenities as $amenity)
                        <span class="kt-badge kt-badge--inline kt-badge--brand kt-badge--md kt-badge--tag kt-badge--rounded "><i class="fa-sm fa fa-tag"></i> {{$amenity->amenity}}</span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <div class="tab-pane" id="location" role="tabpanel">
                <div class="row">
                    <div class="col-7">
                        <div class="kt-widget6 kt-widget6-bi">
                            <div class="kt-widget6__body">
                                @if($i_project->country)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.country')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{$i_project->country->name}}
                                    </span>
                                </div>
                                @endif

                                @if($i_project->region)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.region')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{$i_project->region->name}}
                                    </span>
                                </div>
                                @endif

                                @if ($i_project->city)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.city')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{$i_project->city->name}}
                                    </span>
                                </div>
                                @endif

                                @if ($i_project->area)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.area')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{$i_project->area->name}}
                                    </span>
                                </div>
                                @endif

                                @if ($i_project->address)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.address')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{$i_project->address}}
                                    </span>
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="col-5">
                        @if ($i_project->latitude && $i_project->longitude)
                        <input style="display: hidden;" id="map_search" name="map_search" class="form-control" type="text" placeholder="{{__('inventory::inventory.enter_a_location')}}">
                        <div id="map" style="height:300px; width:100%;"></div>
                        <script>
                            MapHelper.initMap(true, true, true, false, {
                                'lat': '{{$i_project->latitude}}',
                                'lng': '{{$i_project->longitude}}',
                                'id': 'map',
                                'map_search': 'map_search'
                            });
                        </script>
                        @endif
                    </div>
                </div>
                <!-- Location Information -->
            </div>

            <div class="tab-pane col-12" id="project_gallery" role="tabpanel">
                <!-- Project Attachments -->
                @if($i_project->attachmentables)
                    <div class="">
                        <!-- Images -->
                        <div class="m-form__group col-6 ">
                            <label for="attachment" class="h3">{{trans('inventory::inventory.attachments')}}</label>
                            <div class="card-columns" id="attachment">
                                @foreach ($i_project->attachmentables as $attachment)
                                    @if($attachment->type == 'attachment')
                                        <div class="card" id="card-{{$attachment->id}}">
                                            <a class="html5lightbox" title="" data-group="image_group" href="#" data-width="1200" data-height="1200" title="{{trans('inventory::inventory.view_image')}}">
                                                <img class="card-img-top" src="{{$attachment->url}}" alt="{{trans('inventory::inventory.image')}}">
                                            </a>
                                            <div class="card-body" style="text-align: center !important;">
                                                {{-- <h5 class="card-title">Card title that wraps to a new line</h5> --}}
                                                {{-- <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> --}}
                                                <button type="button" class="btn btn-danger" onclick="deleteAttachmentables({{$attachment->id}});"><i class="fas fa-trash-alt"></i> {{trans('inventory::inventory.delete')}}</button>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>

        </div>

    </div>
</div>