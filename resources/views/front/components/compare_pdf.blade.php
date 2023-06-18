<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        .master-div {
            background-color: #1B2B36;
        }

        .master-plans {
            margin-left: 20%;
            margin-top: 10%;
        }

        .table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            min-width: 400px;
            width: 100%;
            height: 100%;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        }

        .table th,
        .table td {
            padding: 12px 15px;
        }

        /* .table tr td img {
            width:100px;
            height: 100px;
        } */
        .image {
            width: 100px;
            height: 100px;
        }

        .table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        .table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
        }

        .floor-plans {
            margin: 1rem;
            width: 40%;
            height: 40%;
        }

        .attachments {
            margin: 1rem;
            width: 40%;
            height: 40%;
        }

        h3 {
            position: absolute;
            top: 40%;
            left: 40%;
            text-align: center;
        }

        div {
            width: 100%;
        }

        body {
            font-family: 'XB Riyaz';
        }

    </style>
</head>

<body>

    <div class="master-div w-100 justify-content-center text-center" style="position: relative; height: 100%">
        <img class="master-plans" src="{{ URL::asset('/front/images/logo.png') }}" alt="logo">
    </div>

    <!-- Start Comparison Table -->
    <table class="table table-dark">
        <!-- Start Table Head -->
        <thead>
            <tr>
                <th></th>
                @if (count($data) >= 1)
                    <th>
                        {{ $data[0]->unit->title ? $data[0]->unit->title : '--' }}
                    </th>
                @endif
                @if (count($data) >= 2)
                    <th>
                        {{ $data[1]->unit->title ? $data[1]->unit->title : '--' }}
                    </th>
                @endif
                @if (count($data) >= 3)
                    <th>
                        {{ $data[2]->unit->title ? $data[2]->unit->title : '--' }}
                    </th>
                @endif
            </tr>
        </thead>
        <!-- End Table Head -->
        <!-- Start Table Body -->
        <tbody>
            <!-- Start Image Row -->

            <!-- End Image Row -->
            <!-- Start Developer Row -->
            <tr>
                <td>{{ trans('front.developer') }}</td>
                @if (count($data) >= 1)
                    <td>
                        {{ $data[0]->unit->developer ? $data[0]->unit->developer : '--' }}
                    </td>
                @endif
                @if (count($data) >= 2)
                    <td>
                        {{ $data[1]->unit->developer ? $data[1]->unit->developer : '--' }}
                    </td>
                @endif
                @if (count($data) >= 3)
                    <td>
                        {{ $data[2]->unit->developer ? $data[2]->unit->developer : '--' }}
                    </td>
                @endif
            </tr>
            <!-- End Developer Row -->
            <!-- Start Location Row -->
            <tr>
                <td>{{ trans('front.location') }}</td>
                @if (count($data) >= 1)
                    <td>
                        {{ $data[0]->unit->location ? $data[0]->unit->location : '--' }}
                    </td>
                @endif
                @if (count($data) >= 2)
                    <td>
                        {{ $data[1]->unit->location ? $data[1]->unit->location : '--' }}
                    </td>
                @endif
                @if (count($data) >= 3)
                    <td>
                        {{ $data[2]->unit->location ? $data[2]->unit->location : '--' }}
                    </td>
                @endif
            </tr>
            <!-- End Location Row -->
            <!-- Start Compound Size Row -->
            <tr>
                <td>{{ trans('front.compound_size') }}</td>
                @if (count($data) >= 1)
                    <td>
                        {{ $data[0]->unit->compound_size ? $data[0]->unit->compound_size : '--' }}
                    </td>
                @endif
                @if (count($data) >= 2)
                    <td>
                        {{ $data[1]->unit->compound_size ? $data[1]->unit->compound_size : '--' }}
                    </td>
                @endif
                @if (count($data) >= 3)
                    <td>
                        {{ $data[2]->unit->compound_size ? $data[2]->unit->compound_size : '--' }}
                    </td>
                @endif
            </tr>
            <!-- End Compound Size Row -->
            <!-- Start Furnishing Row -->
            <tr>
                <td>{{ trans('front.furnishing') }}</td>
                @if (count($data) >= 1)
                    <td>
                        {{ $data[0]->unit->furnishing_status ? $data[0]->unit->furnishing_status : '--' }}
                    </td>
                @endif
                @if (count($data) >= 2)
                    <td>
                        {{ $data[1]->unit->furnishing_status ? $data[1]->unit->furnishing_status : '--' }}
                    </td>
                @endif
                @if (count($data) >= 3)
                    <td>
                        {{ $data[2]->unit->furnishing_status ? $data[2]->unit->furnishing_status : '--' }}
                    </td>
                @endif
            </tr>
            <!-- End Furnishing Row -->
            <!-- Start Delivery Date Row -->
            <tr>
                <td>{{ trans('front.delivery_date') }}</td>
                @if (count($data) >= 1)
                    <td>
                        {{ $data[0]->unit->delivery_date ? $data[0]->unit->delivery_date : '--' }}
                    </td>
                @endif
                @if (count($data) >= 2)
                    <td>
                        {{ $data[1]->unit->delivery_date ? $data[1]->unit->delivery_date : '--' }}
                    </td>
                @endif
                @if (count($data) >= 3)
                    <td>
                        {{ $data[2]->unit->delivery_date ? $data[2]->unit->delivery_date : '--' }}
                    </td>
                @endif
            </tr>
            <!-- End Delivery Date Row -->
            <!-- Start Price Per Area Unit Row -->
            <tr>
                <td>{{ trans('front.price_per_area_unit') }}</td>
                @if (count($data) >= 1)
                    <td>
                        {{ $data[0]->unit->price_per_area_unit ? $data[0]->unit->price_per_area_unit : '--' }}
                    </td>
                @endif
                @if (count($data) >= 2)
                    <td>
                        {{ $data[1]->unit->price_per_area_unit ? $data[1]->unit->price_per_area_unit : '--' }}
                    </td>
                @endif
                @if (count($data) >= 3)
                    <td>
                        {{ $data[2]->unit->price_per_area_unit ? $data[2]->unit->price_per_area_unit : '--' }}
                    </td>
                @endif
            </tr>
            <!-- End Price Per Area Unit Row -->
            {{-- <!-- Start Unit Name Row -->
                <tr>
                    <td>{{ trans('front.unit_name') }}</td>
            @if (count($data) >= 1)
            <td>
                {{$data[0]->unit->title ? $data[0]->unit->title : '--'}}
            </td>
            @endif
            @if (count($data) >= 2)
            <td>
                {{$data[1]->unit->title ? $data[1]->unit->title : '--'}}
            </td>
            @endif
            @if (count($data) >= 3)
            <td>
                {{$data[2]->unit->title ? $data[2]->unit->title : '--'}}
            </td>
            @endif
            </tr>

            <!-- End Unit Name Row --> --}}
            <!-- Start Unit Type Row -->
            <tr>
                <td>{{ trans('front.unit_type') }}</td>
                @if (count($data) >= 1)
                    <td>
                        {{ $data[0]->unit->purpose_type ? $data[0]->unit->purpose_type : '--' }}
                    </td>
                @endif
                @if (count($data) >= 2)
                    <td>
                        {{ $data[1]->unit->purpose_type ? $data[1]->unit->purpose_type : '--' }}
                    </td>
                @endif
                @if (count($data) >= 3)
                    <td>
                        {{ $data[2]->unit->purpose_type ? $data[2]->unit->purpose_type : '--' }}
                    </td>
                @endif
            </tr>
            <!-- End Unit Type Row -->
            <!-- Start Down Payment Row -->
            {{-- <tr>
                <td>{{ trans('front.down_payment') }}</td>
                @if (count($data) >= 1)
                <td>
                    {{$data[0]->unit->down_payment_string ? $data[0]->unit->down_payment_string : '--'}}
                </td>
                @endif
                @if (count($data) >= 2)
                <td>
                    {{$data[1]->unit->down_payment_string ? $data[1]->unit->down_payment_string : '--'}}
                </td>
                @endif
                @if (count($data) >= 3)
                <td>
                    {{$data[2]->unit->down_payment_string ? $data[2]->unit->down_payment_string : '--'}}
                </td>
                @endif
            </tr> --}}
            <!-- End Down Payment Row -->
            <!-- Start Installment Row -->
            <tr>
                <td>{{ trans('front.installment') }}</td>
                @if (count($data) >= 1)
                    <td>
                        {{ $data[0]->unit->installments ? $data[0]->unit->installments . ' ' . trans('front.installments') : '--' }}
                    </td>
                @endif
                @if (count($data) >= 2)
                    <td>
                        {{ $data[1]->unit->installments ? $data[1]->unit->installments . ' ' . trans('front.installments') : '--' }}
                    </td>
                @endif
                @if (count($data) >= 3)
                    <td>
                        {{ $data[2]->unit->installments ? $data[2]->unit->installments . ' ' . trans('front.installments') : '--' }}
                    </td>
                @endif
            </tr>
            <!-- End Installment Row -->
            <!-- Start Garden Row -->

            <!-- End Garden Row -->
            <!-- Start Rooms Row -->
            <tr>
                <td>{{ trans('front.rooms') }}</td>
                @if (count($data) >= 1)
                    <td>
                        {{ $data[0]->unit->rooms ? $data[0]->unit->rooms : '--' }}
                    </td>
                @endif
                @if (count($data) >= 2)
                    <td>
                        {{ $data[1]->unit->rooms ? $data[1]->unit->rooms : '--' }}
                    </td>
                @endif
                @if (count($data) >= 3)
                    <td>
                        {{ $data[2]->unit->rooms ? $data[2]->unit->rooms : '--' }}
                    </td>
                @endif
            </tr>
            <!-- End Rooms Row -->
            <!-- Start Baths Row -->
            <tr>
                <td>{{ trans('front.baths') }}</td>
                @if (count($data) >= 1)
                    <td>
                        {{ $data[0]->unit->baths ? $data[0]->unit->baths : '--' }}
                    </td>
                @endif
                @if (count($data) >= 2)
                    <td>
                        {{ $data[1]->unit->baths ? $data[1]->unit->baths : '--' }}
                    </td>
                @endif
                @if (count($data) >= 3)
                    <td>
                        {{ $data[2]->unit->baths ? $data[2]->unit->baths : '--' }}
                    </td>
                @endif
            </tr>
            <!-- End Baths Row -->
            <!-- Start Agent Row -->
            <tr>
                <td>البائع</td>
                @if (count($data) >= 1)
                    <td>
                        {{ $data[0]->unit->seller ? $data[0]->unit->seller->full_name : '--' }}
                        ,{{ $data[0]->unit->seller ? $data[0]->unit->seller->mobile_number : '--' }}
                    </td>
                @endif
                @if (count($data) >= 2)
                    <td>
                        {{ $data[1]->unit->seller ? $data[1]->unit->seller->full_name : '--' }}
                        ,{{ $data[1]->unit->seller ? $data[1]->unit->seller->mobile_number : '--' }}
                    </td>
                @endif
                @if (count($data) >= 3)
                    <td>
                        {{ $data[2]->unit->seller ? $data[2]->unit->seller->full_name : '--' }}
                        ,{{ $data[2]->unit->seller ? $data[2]->unit->seller->mobile_number : '--' }}
                    </td>
                @endif
            </tr>
            <tr>
                <td>{{ trans('front.image') }}</td>
                @if (count($data) >= 1)
                    <td>
                        @foreach ($data[0]->unit->attachments as $attachment)
                            @if ($attachment->type == 'attachment')
                                <img class="image" src="{{ $attachment->url }}"
                                    alt="{{ $attachment->file_name }}">
                            @break
                        @endif
                @endforeach
                </td>
                @endif
                @if (count($data) >= 2)
                    <td>
                        @foreach ($data[1]->unit->attachments as $attachment)
                            @if ($attachment->type == 'attachment')
                                <img class="image" src="{{ $attachment->url }}"
                                    alt="{{ $attachment->file_name }}">
                            @break
                        @endif
                @endforeach
                </td>
                @endif
                @if (count($data) >= 3)
                    <td>
                        @foreach ($data[2]->unit->attachments as $attachment)
                            @if ($attachment->type == 'attachment')
                                <img class="image" src="{{ $attachment->url }}"
                                    alt="{{ $attachment->file_name }}">
                            @break
                        @endif
                @endforeach
                </td>
                @endif
            </tr>
            <!-- End Agent Row -->
        </tbody>
        <!-- End Table Body -->
    </table>
    <!-- End Comparison Table -->

    @foreach ($data as $compare)

        <div class="master-div w-100 justify-content-center text-center" style="position: relative; height: 95%">
            <h3 style="position: absolute; top: 50%; left:28%;font-size: 3rem;color:white"
                class="justify-content-center text-center">{{ $compare->unit->title }}</h3>
        </div>
        <div>
            <div class="w-100 h-100 master-div" style="position: relative; height: 95%">
                <h3 style="position: absolute; top: 50%; left:28%;font-size: 3rem;color:white"
                    class="justify-content-center text-center">{{ __('inventory::inventory.attachments') }}</h3>
            </div>
            @foreach ($compare->unit->attachments as $attachment)
                @if ($attachment->type == 'attachment')
                    <img class="attachments" src="{{ $attachment->url }}" alt="{{ $attachment->file_name }}">
                @endif
            @endforeach
        </div>
        <div>
            <div class="w-100 h-100 master-div" style="position: relative; height: 95%">
                <h3 style="position: absolute; top: 50%; left:28%;font-size: 3rem;color:white"
                    class="justify-content-center text-center">{{ __('inventory::inventory.floor_plans') }}</h3>
            </div>
            @foreach ($compare->unit->attachments as $attachment)
                @if ($attachment->type == 'floorplan')
                    <img class="floor-plans w-90 h-50" src="{{ $attachment->url }}"
                        alt="{{ $attachment->file_name }}">
                @endif
            @endforeach
        </div>

        {{-- <div class="w-100 h-100 master-div" style="position: relative; height: 95%">
                <h3 style="position: absolute; top: 50%; left:28%;font-size: 3rem;color:white" class="justify-content-center text-center">{{__('inventory::inventory.unit_information')}}</h3>
    </div>
    <table class="table table-dark">
        <thead>
            <tr>
                <th>{{__('inventory::inventory.purpose_type')}}</th>
                <th>{{__('inventory::inventory.bedrooms')}}</th>
                <th>{{__('inventory::inventory.bathrooms')}}</th>
                <th>{{__('inventory::inventory.area')}}</th>
                <th>{{__('inventory::inventory.price')}}</th>
                <th>{{__('inventory::inventory.number_of_installments')}}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $compare->unit->purpose_type }}</td>
                <td>{{ $compare->unit->bedroom }}</td>
                <td>{{$compare->unit->bathroom}}</td>
                <td>{{$compare->unit->area}}<sup>{{$compare->unit->area_unit}}</sup></td>
                <td>{{$compare->unit->price}}</td>
                <td>{{ $compare->unit->number_of_installments}}</td>
            </tr>
        </tbody>
    </table> --}}
        <hr>
    @endforeach
    <hr>
    <div class="master-div w-100 justify-content-center text-center" style="position: relative; height: 100%">
        <img class="master-plans" src="{{ URL::asset('/front/images/logo.png') }}" alt="logo">
    </div>

</body>

</html>
