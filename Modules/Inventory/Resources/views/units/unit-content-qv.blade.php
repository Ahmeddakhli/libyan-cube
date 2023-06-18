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
                <a class="nav-link" data-toggle="tab" href="#unit_gallery">
                    {{__('inventory::inventory.gallery')}}
                    @if($i_unit->attachments)
                        <span class="kt-badge kt-badge--primary kt-badge--inline kt-badge--pill kt-margin-l-5">{{count($i_unit->attachments)}}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#rental_cases">{{__('inventory::inventory.rental_cases')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#publish_times">{{__('inventory::inventory.publish_times')}}</a>
            </li>
        </ul>
        <div class="tab-content">

            <div class="tab-pane active" id="summary" role="tabpanel">

                <!-- Unit Description -->
                @if ($i_unit->description)
                <div class="row">
                    <div class="col-12">
                        <p>{!!$i_unit->description!!}</p>
                    </div>
                </div>
                @endif
                <!-- Unit Description -->

                <div class="row">
                    <div class="col-4">
                        <div class="kt-widget6 kt-widget6-bi">
                            <div class="kt-widget6__body">

                                @if($i_unit->availability)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.availability')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{$i_unit->availability}}
                                    </span>
                                </div>
                                @endif

                                @if($i_unit->building_number)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.building_number')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{$i_unit->building_number}}
                                    </span>
                                </div>
                                @endif

                                @if($i_unit->project)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.project')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{$i_unit->project}}
                                    </span>
                                </div>
                                @endif

                                @if ($i_unit->position)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.position')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{$i_unit->position}}
                                    </span>
                                </div>
                                @endif

                                @if ($i_unit->view)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.view')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{$i_unit->view}}
                                    </span>
                                </div>
                                @endif

                                @if ($i_unit->area)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.area')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{$i_unit->area}} @if ($i_unit->area_unit) {{$i_unit->area_unit}} @endif
                                    </span>
                                </div>
                                @endif
                                @if ($i_unit->roof_area)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.roof_area')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{$i_unit->roof_area}} @if ($i_unit->area_unit) {{$i_unit->area_unit}} @endif
                                    </span>
                                </div>
                                @endif
                                @if ($i_unit->terrace_area)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.terrace_area')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{$i_unit->terrace_area}} @if ($i_unit->area_unit) {{$i_unit->area_unit}} @endif
                                    </span>
                                </div>
                                @endif

                                @if ($i_unit->plot_area)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.plot_area')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{$i_unit->plot_area}}
                                    </span>
                                </div>
                                @endif

                                @if ($i_unit->build_up_area)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.build_up_area')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{$i_unit->build_up_area}}
                                    </span>
                                </div>
                                @endif

                                @if ($i_unit->garden_area)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.garden_area')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{$i_unit->garden_area}} @if ($i_unit->garden_area_unit) {{$i_unit->garden_area_unit}} @endif
                                    </span>
                                </div>
                                @endif

                                @if ($i_unit->bedroom)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.bedroom')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{$i_unit->bedroom}}
                                    </span>
                                </div>
                                @endif

                                @if ($i_unit->bathroom)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.bathroom')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{$i_unit->bathroom}}
                                    </span>
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="kt-widget6 kt-widget6-bi">
                            <div class="kt-widget6__body">

                                @if($i_unit->seller)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.seller')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        <a href="#" target="_blank">{{$i_unit->seller->full_name}}</a>
                                    </span>
                                </div>
                                @endif

                                @if ($i_unit->buyer)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.buyer')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        <a href="#" target="_blank">{{$i_unit->buyer->full_name}}</a>
                                    </span>
                                </div>
                                @endif


                                @if ($i_unit->purpose)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.purpose')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{$i_unit->purpose}}
                                    </span>
                                </div>
                                @endif

                                @if ($i_unit->purpose_type)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.purpose_type')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{$i_unit->purpose_type}}
                                    </span>
                                </div>
                                @endif

                                @if ($i_unit->furnishing_status)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.furnishing_status')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{$i_unit->furnishing_status}}
                                    </span>
                                </div>
                                @endif

                                @if ($i_unit->finishing_type)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.finishing_type')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{$i_unit->finishing_type}}
                                    </span>
                                </div>
                                @endif

                                <?php $locations_array = array(); ?>
                                @if ($i_unit->country)
                                    <?php array_push($locations_array, $i_unit->country->name) ?>
                                @endif
                                @if ($i_unit->region)
                                    <?php array_push($locations_array, $i_unit->region->name) ?>
                                @endif
                                @if ($i_unit->city)
                                    <?php array_push($locations_array, $i_unit->city->name) ?>
                                @endif
                                @if ($i_unit->area_place)
                                    <?php array_push($locations_array, $i_unit->area_place->name) ?>
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

                                @if($i_unit->full_price)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.price')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{$i_unit->full_price}}
                                    </span>
                                </div>
                                @endif

                                @if ($i_unit->down_payment_string)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.down_payment')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{$i_unit->down_payment_string}}
                                    </span>
                                </div>
                                @endif

                                @if ($i_unit->payment_method)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.payment_method')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{$i_unit->payment_method}}
                                    </span>
                                </div>
                                @endif

                                @if ($i_unit->offering_type)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.offering_type')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{$i_unit->offering_type}}
                                    </span>
                                </div>
                                @endif


                                @if ($i_unit->number_of_installments)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.number_of_installments')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{$i_unit->number_of_installments}}
                                    </span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @if($i_unit->facilities)
                <hr>
                <div class="row">
                    <div class="col-12">
                        @foreach($i_unit->facilities as $facility)
                        <span class="kt-badge kt-badge--inline kt-badge--brand kt-badge--md kt-badge--tag kt-badge--rounded "><i class="fa-sm fa fa-tag"></i> {{$facility->facility}}</span>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($i_unit->amenities)
                <div class="row kt-margin-t-10">
                    <div class="col-12">
                        @foreach($i_unit->amenities as $amenity)
                        <span class="kt-badge kt-badge--inline kt-badge--brand kt-badge--md kt-badge--tag kt-badge--rounded "><i class="fa-sm fa fa-tag"></i> {{$amenity->amenity}}</span>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($i_unit->tags)
                <div class="row kt-margin-t-10">
                    <div class="col-12">
                        @foreach($i_unit->tags as $tag)
                        <span class="kt-badge kt-badge--inline kt-badge--brand kt-badge--md kt-badge--tag kt-badge--rounded "><i class="fa-sm fa fa-tag"></i> {{$tag->tag}}</span>
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

                                @if($i_unit->country)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.country')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{$i_unit->country->name}}
                                    </span>
                                </div>
                                @endif

                                @if($i_unit->region)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.region')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{$i_unit->region->name}}
                                    </span>
                                </div>
                                @endif

                                @if ($i_unit->city)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.city')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{$i_unit->city->name}}
                                    </span>
                                </div>
                                @endif

                                @if ($i_unit->area_place)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.area')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{$i_unit->area_place->name}}
                                    </span>
                                </div>
                                @endif

                                @if ($i_unit->address)
                                <div class="kt-widget6__item">
                                    <span>
                                        {{__('inventory::inventory.address')}}:
                                    </span>
                                    <span class="kt-font-success kt-font-bold">
                                        {{$i_unit->address}}
                                    </span>
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="col-5">
                        @if ($i_unit->latitude && $i_unit->longitude)
                        <input style="display: hidden;" id="map_search" name="map_search" class="form-control" type="text" placeholder="{{__('inventory::inventory.enter_a_location')}}">
                        <div id="map" style="height:300px; width:100%;"></div>
                        <script>
                            MapHelper.initMap(true, true, true, false, {
                                'lat': '{{$i_unit->latitude}}',
                                'lng': '{{$i_unit->longitude}}',
                                'id': 'map',
                                'map_search': 'map_search'
                            });
                        </script>
                        @endif
                    </div>
                </div>


                <!-- Location Information -->
            </div>

            <div class="tab-pane" id="unit_gallery" role="tabpanel">
                <!-- Unit Attachments -->
                @if($i_unit->attachmentables)
                <!-- Images -->
                <div class="">
                    @if($i_unit->attachmentables)
                    <div class="">
                        <!-- Images -->
                        @if ($i_unit->attachments)
                            <div class="m-form__group col-6 ">
                                <label for="attachment" class="h3">{{trans('inventory::inventory.attachments')}}</label>
                                <div class="card-columns" id="attachment">
                                    @foreach ($i_unit->attachments as $attachment)
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
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if ($i_unit->floor_plans)
                            <div class="m-form__group col-6 row">
                                <label for="floorplans" class="h3">{{trans('inventory::inventory.floor_plans')}}</label>
                                <div class="card-columns" id="floorplans">
                                    @foreach ($i_unit->floor_plans as $attachment)
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
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if ($i_unit->master_plans)
                            <div class="m-form__group col-6 ">
                                <label for="masterplans" class="h3">{{trans('inventory::inventory.master_plans')}}</label>
                                <div class="card-columns" id="masterplans">
                                    @foreach ($i_unit->master_plans as $attachment)
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
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                    @endif
                </div>

                @else
                <div class="mid-gray-text-msg">
                    {{__('inventory::inventory.there_is_no_data')}}
                    <p>{{__('inventory::inventory.but_u_can_update_this_unit')}}</p>
                </div>
                @endif
                <!-- Unit Attachments -->
            </div>

            <div class="tab-pane" id="rental_cases" role="tabpanel">
                @if (auth()->user()->hasPermission('index-inventory-rental-cases'))
                <!-- Rental Cases -->
                <div class="row">
                    <div class="col-12">
                        <!--begin: Datatable -->
                        <table class="table table-striped table-bordered table-hover table-checkable datatable" id="rental_cases_table">
                            <thead>
                                <tr>
                                    <th style="display:none;">{{__('inventory::inventory.id')}}</th>
                                    <th>{{__('inventory::inventory.renter')}}</th>
                                    <th>{{__('inventory::inventory.from')}}</th>
                                    <th>{{__('inventory::inventory.to')}}</th>
                                    <th>{{__('inventory::inventory.price')}}</th>
                                    {{-- <th>{{__('inventory::inventory.created_at')}}</th> --}}
                                    {{-- <th>{{__('inventory::inventory.created_by')}}</th> --}}
                                    <th>{{__('inventory::inventory.last_updated_at')}}</th>
                                    <th>{{__('inventory::inventory.last_updated_by')}}</th>
                                    <th>{{__('inventory::inventory.actions')}}</th>
                                </tr>
                            </thead>
                        </table>
                        <!--end: Datatable -->
                    </div>
                    <div class="col-12 text-right kt-margin-t-10">
                        @if (auth()->user()->hasPermission('create-inventory-rental-case'))
                        <a href="{{route('inventory.rental_cases.modals.create')}}?i_unit_id={{$i_unit->id}}" class="btn btn-brand btn-sm" data-path="{{route('inventory.rental_cases.modals.create')}}?i_unit_id={{$i_unit->id}}" data-title="{{trans('inventory::inventory.create_rental_case')}}" data-8xload-it-in-href="#addRentalCase">
                            <span>
                                <i class="la la-plus"></i>
                                <span>{{trans('inventory::inventory.create_rental_case')}}</span>
                            </span>
                        </a>
                        @endif
                    </div>
                </div>
                <!-- Rental Cases -->
                <div id="addRentalCase"></div>
                @endif
            </div>

            <div class="tab-pane" id="publish_times" role="tabpanel">
                <!-- Publish Times -->
                @if (auth()->user()->hasPermission('index-inventory-publish-times'))
                <div class="row">
                    <div class="col-12">
                        <!--begin: Datatable -->
                        <table class="table table-striped table-bordered table-hover table-checkable datatable" id="publish_times_table">
                            <thead>
                                <tr>
                                    <th style="display:none;">{{__('inventory::inventory.id')}}</th>
                                    <th>{{__('inventory::inventory.from')}}</th>
                                    <th>{{__('inventory::inventory.to')}}</th>
                                    <th>{{__('inventory::inventory.publisher')}}</th>
                                    <th>{{__('inventory::inventory.created_at')}}</th>
                                    {{-- <th>{{__('inventory::inventory.last_updated_at')}}</th> --}}
                                    {{-- <th>{{__('inventory::inventory.last_updated_by')}}</th> --}}
                                    <th>{{__('inventory::inventory.actions')}}</th>
                                </tr>
                            </thead>
                        </table>
                        <!--end: Datatable -->
                    </div>
                    <div class="col-12 text-right kt-margin-t-10">
                        @if (auth()->user()->hasPermission('create-inventory-publish-time'))
                        <a href="{{route('inventory.publish_times.modals.create')}}?i_unit_id={{$i_unit->id}}" class="btn btn-brand btn-sm" data-toggle="modal" data-target="#fast_modal" data-path="{{route('inventory.publish_times.modals.create')}}?i_unit_id={{$i_unit->id}}" data-title="{{trans('inventory::inventory.create_publish_time')}}" data-path="{{route('inventory.rental_cases.modals.create')}}?i_unit_id={{$i_unit->id}}" data-title="{{trans('inventory::inventory.create_rental_case')}}" data-8xload-it-in-href="#addPT">
                            <span>
                                <i class="la la-plus"></i>
                                <span>{{trans('inventory::inventory.create_publish_time')}}</span>
                            </span>
                        </a>
                        @endif
                    </div>
                    <div id="addPT"></div>
                </div>
                @endif
                <!-- Publish Times -->
            </div>

        </div>

    </div>
</div>