@extends('front.layouts.main')

@section('title', trans('main.search_results'))
@php
       $page_name ='';
      @endphp
@section('content')
    <section class="index-page index-property index-primary  my-5">
        <div class="container">
            <div class="flex-box d-flex flex-wrap align-items-center justify-content-between">
                <nav id="breadcrumb" class='mb-4'>
                    <ul>
                        <li><a href="{{route('front.home')}}">
                                <ion-icon name="home-outline"></ion-icon>
                            </a></li>
                        <li class="active"><a>{{__('main.search')}}</a></li>
                    </ul>
                </nav> <!-- #/ breadcrumb -->
                @include('front.partials.search.view-map')
                <!-- ./ map-view -->
            </div> <!-- ./ flex-box -->
        </div> <!-- ./ container -->
        <div class="container">
            <div class="row">
                <!-- Projects -->
                <div class="col-xl-8 data-div">
                    @if (count($results))
                        @include('front.partials.search.search-result')
                    @else
                        <section class="contact-page py-5">
                            <div class="container">
                                <h3 class="text-capitalize mb-4">{{__('main.no_search_result')}}</h3>
                                <div class="row">
                                    <div class="col-lg-12 mb-5">
                                        @include('front.components.contact_form',['type'=>'contact'])
                                    </div>
                                </div>
                            </div> <!-- ./ container -->
                        </section>
                    @endif
                </div>  
                <!-- ./ col-xl-8 -->
                <div class="col-xl-4 mt-5 mt-xl-0">
                    <div class="sidebar position-sticky">
                        <!-- ./ contact__form -->
                        @include('front.components.contact')
                        <!-- ./ sidebar__filter -->
                        @include('front.components.filter')

                    </div> <!-- ./ sidebar -->
                </div> <!-- ./ col-xl-4 mt-5 mt-xl-0 -->
            </div> <!-- ./ row -->
            <!-- ./ map-loc -->
        </div> <!-- ./ container -->
    </section>
@endsection

@push('scripts')
    <script>
        // SELECT PICKER PLUGIN INIT

        $('.dropdown-select').selectpicker({

            // text for none selected
            noneSelectedText: 'Nothing selected',

            // shows icons
            showIcon: true,

            // shows content
            showContent: true,

            // auto reposition to fit screen
            dropupAuto: true,

            // adds a header to the dropdown select
            header: false,

            // live filter options
            liveSearch: true,
            liveSearchPlaceholder: 'Search',
            liveSearchNormalize: false,
            liveSearchStyle: 'contains',

            // shows Select All & Deselect All
            actionsBox: true,

            // Set the character displayed in the button that separates selected options
            // multipleSeparator: ',',

            selectedTextFormat: 'count > 2',

            // text on the button that deselects all options
            // deselectAllText: '',

            // text on the button that selects all options
            // selectAllText: ''

            // custom template
            // template: {
            // caret: '<span class="caret"></span>'
            // },

        });

        // SELECT 2 STUFF

        $('#global-search').select2({
            placeholder: "Search by location or building",
            width: "100%",
            allowClear: false,
            maximumSelectionLength: 3,
            multiple: true,
            closeOnSelect: true,
        });
        $('#must-have').select2({
            placeholder: "{{__('main.include')}}",
            width: "100%",
            allowClear: false,
            maximumSelectionLength: 3,
            multiple: true,
            closeOnSelect: true,
        });
        $('#dont-have').select2({
            placeholder: "{{__('main.exclude')}}",
            width: "100%",
            allowClear: false,
            maximumSelectionLength: 3,
            multiple: true,
            closeOnSelect: true,
        });
        $('#loc').select2({
            width: "100%",
            allowClear: false,
            maximumSelectionLength: 3,
            closeOnSelect: true,
        });
        $('#select-type').select2({
            placeholder: "{{__('inventory::inventory.offering_type')}}",
            width: "100%",
            multiple: true,
            allowClear: false,
            maximumSelectionLength: 3,
            closeOnSelect: true,
        });
    </script>
    <!-- Add to Compare -->
@endpush