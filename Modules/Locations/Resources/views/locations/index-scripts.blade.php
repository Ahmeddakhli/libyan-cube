<script>
    $('body').addClass('kt-aside--enabled kt-aside--fixed');
</script>
<script>
    function initTable1(url) {
        var table = $('#locations_table');
        return table.DataTable({
            dom: '<"top"i>Bfrtip',
            buttons: [
                // {
                //     extend: 'pdf',
                //     footer: true,
                //     exportOptions: {
                //         columns: [0,1,2]
                //     }
                // },
                // {
                //     extend: 'csv',
                //     footer: true,
                //     exportOptions: {
                //         columns: [0,1,2]
                //     }
                // },
                // {
                //     extend: 'excel',
                //     footer: true,
                //     exportOptions: {
                //         columns: [0,1,2]
                //     }
                // }
            ],
            responsive: true,
            searchDelay: 500,
            processing: true,
                        serverSide: true,
            language:{
                search:"{{__('datatables.search')}}",
                emptyTable:"{{__('datatables.no_records_available')}}",
                info:"{{__('datatables.showing_page')}} _START_ {{__('datatables.of')}} _END_ {{__('datatables.of')}} _TOTAL_ ",

                infoEmpty:"{{__('datatables.showing_page')}} _START_ {{__('datatables.of')}} _END_ {{__('datatables.of')}} _TOTAL_",
            },
            ajax: {
                url: url,
                type: 'POST',
                data: {

                    columnsDef: [
                        //
                    ],
                },
            },
            columns: [{
                    data: 'id',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'value',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'created_at',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'last_updated_at',
                    orderable: true,
                    searchable: true
                },
            ],
            columnDefs: [{
                    targets: 0,
                    title: "{{trans('locations::location.id')}}",
                    render: function(data, type, full, meta) {
                        return full.id;
                    },
                },
                {
                    targets: 1,
                    title: "{{trans('locations::location.title')}}",
                    render: function(data, type, full, meta) {
                        var view_url = "{{route('locations.index','id=:id')}}"
                        view_url = view_url.replace('id=:id', `${full.id}`)
                        var view_url = "{{route('locations.index','id=:id')}}"
                        view_url = view_url.replace('id=:id', `${full.id}`)

                        if (full.parent.parent != null && full.parent.parent.parent == null) {
                            return `
                                    <a href="${view_url}">
                                        ${full.value}
                                    </a>
                                `;
                        } else if (full.parent.parent != null && full.parent.parent.parent != null && full.parent.parent.parent.parent_id == null) {
                            return `
                            <a href="${view_url}">
                                ${full.value}
                                    </a>
                                `;
                        } else if (full.parent.parent_id == null) {
                            return `
                            <a href="${view_url}">
                                ${full.value}
                                    </a>
                                `;
                        }else{
                            return full.value;

                        }
                    },
                },
                {
                    targets: 2,
                    title: "{{trans('locations::location.created_at')}}",
                    render: function(data, type, full, meta) {
                        return full.created_at;
                    },
                },
                {
                    targets: 3,
                    title: "{{trans('locations::location.last_updated_at')}}",
                    render: function(data, type, full, meta) {
                        return full.last_updated_at;
                    },
                },
                {
                    targets: 4,
                    title: "{{trans('locations::location.actions')}}",
                    orderable: false,
                    render: function(data, type, full, meta) {

                        var delete_url = "{{route('locations.delete','id=:id')}}";
                        delete_url = delete_url.replace(':id', full.id);

                        var update_url = "{{route('locations.modals.update','id=:id')}}";
                        update_url = update_url.replace('id=:id', full.id);
                        var location_url = "{{route('front.locations.show',['id' => 'id' , 'type' => 'unit' , 'slug' => 'slug'])}}";

                        location_url = location_url.replace('id', `${full.id}`);
                        location_url = location_url.replace('slug', `${full.value.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'')}`);
                        // if (full.parent.parent != null) {
                        //     $('.kt-portlet__head-title >small').html('<strong>' + full.parent.parent.value + '  :  ' + full.parent.value + '</strong>')
                        // } else {
                        //     // $('.kt-portlet__head-title >small').html('<strong>' + full.parent.value + '</strong>')
                        // }

                        if (full.parent.parent != null && full.parent.parent.parent != null) {
                            var parent_url  = "{{route('locations.index','id=:id')}}";
                            parent_url = parent_url.replace('id=:id',full.parent.parent.id);
                            var parent_parent_url  = "{{route('locations.index','id=:id')}}";
                            parent_parent_url = parent_parent_url.replace('id=:id',full.parent.parent.parent.id);
                        //     var view_url2 = "{{route('locations.index','id=:id')}}"
                        // view_url2 = view_url2.replace('id=:id', `${full.parent.id}`)
                        // var view_url1 = "{{route('locations.index','id=:id')}}"
                        // view_url1 = view_url1.replace('id=:id', `${full.parent.parent.id}`)
                            // $('.kt-portlet__head-title >small').html(`<strong><a href="{{route('locations.index',)}}"> ${full.parent.parent.value} </a>:  <a href="{{route('locations.index',)}}"> ${full.parent.value} </a></strong>`)
                            $('.kt-portlet__head-title >small').html(`<strong><a href="${parent_parent_url}"> ${full.parent.parent.value} </a>:  <a href="${parent_url}"> ${full.parent.value} </a></strong>`)

                        }

                        @if(auth()->user()->hasPermission('update-location') || auth()->user()->hasPermission('delete-location'))
                        var value = `
                            <span class="dropdown">
                                <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                                    <i class="la la-ellipsis-h"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                            `;
                        @if(auth()->user()->hasPermission('update-location'))
                        value += `
                                    <a href="${update_url}" class="dropdown-item">
                                        <span>
                                            <i class="la la-edit"></i>
                                            <span>{{trans('locations::location.update_location')}}</span>
                                        </span>
                                    </a>
                                `;
                        @endif
                        @if(auth()->user()->hasPermission('index-locations'))
                        if (full.parent.parent != null && full.parent.parent.parent != null && full.parent.parent.parent.parent_id == null) {
                            value += `
                                    <a href="${location_url}" class="dropdown-item"   data-title="{{trans('locations::location.view_location')}}" >
                                        <span>
                                            <i class="la la-edit"></i>
                                            <span>{{trans('locations::location.view_location')}}</span>
                                        </span>
                                    </a>
                                `;
                        }
                        // } else if (full.parent.parent != null && full.parent.parent.parent != null && full.parent.parent.parent.parent_id == null) {
                        //     value += `
                        //             <a href="${view_url}" class="dropdown-item"   data-title="{{trans('locations::location.view_location')}}"  data-modal-load>
                        //                 <span>
                        //                     <i class="la la-edit"></i>
                        //                     <span>{{trans('locations::location.view_location')}}</span>
                        //                 </span>
                        //             </a>
                        //         `;
                        // } else if (full.parent.parent_id == null) {
                        //     value += `
                        //             <a href="${view_url}" class="dropdown-item"   data-title="{{trans('locations::location.view_location')}}"  data-modal-load>
                        //                 <span>
                        //                     <i class="la la-edit"></i>
                        //                     <span>{{trans('locations::location.view_location')}}</span>
                        //                 </span>
                        //             </a>
                        //         `;
                        // }

                        @endif
                        @if(auth()->user()->hasPermission('delete-location'))
                        value += `
                                    <a class="dropdown-item" data-8x-delete-it='{"container":false, "path":"` + delete_url + `", "callback": "deleteFacilityCallback"}' href="#"><i class="la la-trash"></i> {{__('locations::location.delete_location')}}</a>
                                `;
                        @endif
                        value += `
                                </div>
                            </span>
                            `;
                        return value;
                        @else
                        return ``;
                        @endif
                    },
                }
            ],
        });
    };
    jQuery(document).ready(function() {
        // Init datatable
        var urlParams = window.location.href;
        var id = parseInt(urlParams.substring(urlParams.lastIndexOf('/') + 1));
        if (id) {
            var location_url = "{{route('locations.index','id=:id')}}"
            location_url = location_url.replace("id=:id", `${id}`)
            locations_table = initTable1(location_url);
            $('.creatingbutton').attr('data-path', $('.creatingbutton').attr('data-path') + `?id=${id}`);

        } else {
            locations_table = initTable1("{{ route('locations.index')}}");
        }

        // Search datatable
        $('#m_search').on('click', function(e) {
            e.preventDefault();
            var query = $('#search_locations_form').serialize();
            $("#locations_table").dataTable().fnDestroy();
            locations_table = initTable1("{{ route('locations.index') }}" + '?' + query);
        });

        // Reset search form
        $('#m_reset').on('click', function(e) {
            e.preventDefault();
            $(this).closest('form').trigger("reset");
            $("#locations_table").dataTable().fnDestroy();
            locations_table = initTable1("{{ route('locations.index') }}");
        });
    });
</script>
<script>
    function deleteFacilityCallback() {
        // Reload datatable with delay to clear cache
        setTimeout(function() {
            locations_table.ajax.reload(function(json) {
                //
            }, false);
        }, 3000);
    }
</script>
