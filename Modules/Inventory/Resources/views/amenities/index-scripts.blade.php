<script>
    $('body').addClass('kt-aside--enabled kt-aside--fixed');
</script>
<script>
    function initTable1(url) {
        var table = $('#amenities_table');
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
                    // Parameters
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
                    title: "{{trans('inventory::inventory.id')}}",
                    render: function(data, type, full, meta) {
                        return full.id;
                    },
                },
                {
                    targets: 1,
                    title: "{{trans('inventory::inventory.amenity')}}",
                    render: function(data, type, full, meta) {
                        return full.value;
                    },
                },
                {
                    targets: 2,
                    title: "{{trans('inventory::inventory.created_at')}}",
                    render: function(data, type, full, meta) {
                        return full.created_at;
                    },
                },
                {
                    targets: 3,
                    title: "{{trans('inventory::inventory.last_updated_at')}}",
                    render: function(data, type, full, meta) {
                        return full.last_updated_at;
                    },
                },
                {
                    targets: 4,
                    title: "{{trans('inventory::inventory.actions')}}",
                    orderable: false,
                    render: function(data, type, full, meta) {
                        var delete_url = "{{route('inventory.amenities.delete', 'id=:id')}}";
                        delete_url = delete_url.replace(':id', full.id);

                        @if(auth()->user()->hasPermission('update-inventory-amenity') || auth()->user()->hasPermission('delete-inventory-amenity'))
                            var value = `
                                <span class="dropdown">
                                    <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                                        <i class="la la-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                `;
                        @if(auth()->user()->hasPermission('update-inventory-amenity'))
                            value += `
                                        <a href="{{route('inventory.amenities.modals.update')}}" class="dropdown-item" data-toggle="modal" data-target="#fast_modal" data-path="{{route('inventory.amenities.modals.update')}}" data-title="{{trans('inventory::inventory.update_amenity')}}" data-id="` + full.id + `" data-modal-load>
                                            <span>
                                                <i class="la la-edit"></i>
                                                <span>{{trans('inventory::inventory.update_amenity')}}</span>
                                            </span>
                                        </a>
                                    `;
                        @endif
                        @if(auth()->user()->hasPermission('delete-inventory-amenity'))
                            value += `
                                        <a class="dropdown-item" data-8x-delete-it='{"container":false, "path":"` + delete_url + `", "callback": "deleteAmenityCallback"}' href="#"><i class="la la-trash"></i> {{__('inventory::inventory.delete_amenity')}}</a>
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
        amenities_table = initTable1("{{ route('inventory.amenities.index') }}");

        // Search datatable
        $('#m_search').on('click', function(e) {
            e.preventDefault();
            var query = $('#search_amenities_form').serialize();
            $("#amenities_table").dataTable().fnDestroy();
            amenities_table = initTable1("{{ route('inventory.amenities.index') }}" + '?' + query);
        });

        // Reset search form
        $('#m_reset').on('click', function(e) {
            e.preventDefault();
            $(this).closest('form').trigger("reset");
            $("#amenities_table").dataTable().fnDestroy();
            amenities_table = initTable1("{{ route('inventory.amenities.index') }}");
        });
    });
</script>
<script>
    function deleteAmenityCallback() {
        // Reload datatable with delay to clear cache
        setTimeout(function() {
            amenities_table.ajax.reload(function(json) {
                //
            }, false);
        }, 3000);
    }
</script>