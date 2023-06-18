<script>
    $('body').addClass('kt-aside--enabled kt-aside--fixed');
</script>
<script>
    function initTable1(url) {
        var table = $('#sell_requests_table');
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
                    data: 'compound',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'unit_name',
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
                    title: "{{trans('inventory::inventory.compound')}}",
                    render: function(data, type, full, meta) {

                        return full.compound;
                    },
                },
                {
                    targets: 2,
                    title: "{{trans('inventory::inventory.unit_name')}}",
                    render: function(data, type, full, meta) {

                        return full.unit_name;
                    },
                },
                {
                    targets: 3,
                    title: "{{trans('inventory::inventory.is_seen')}}",
                    render: function(data, type, full, meta) {
                        if(full.is_seen == 1){
                            return '{{trans('inventory::inventory.seen')}}';
                        }
                        return '{{trans('inventory::inventory.not_seen')}}';
                    },
                },
                {
                    targets: 4,
                    title: "{{trans('inventory::inventory.created_at')}}",
                    render: function(data, type, full, meta) {
                        return full.created_at;
                    },
                },
                {
                    targets: 5,
                    title: "{{trans('inventory::inventory.last_updated_at')}}",
                    render: function(data, type, full, meta) {
                        return full.last_updated_at;
                    },
                },
                {
                    targets: 6,
                    title: "{{trans('inventory::inventory.actions')}}",
                    orderable: false,
                    render: function(data, type, full, meta) {
                        var delete_url = "{{route('inventory.sell_requests.delete', 'id=:id')}}";
                        delete_url = delete_url.replace(':id', full.id);

                        var view_url = "{{route('inventory.sell_requests.show', ':id')}}";
                        view_url = view_url.replace(':id', full.id);

                        @if(auth()->user()->hasPermission('update-inventory-sell-request') || auth()->user()->hasPermission('delete-inventory-sell-request'))
                            var value = `
                                <span class="dropdown">
                                    <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                                        <i class="la la-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                `;
                            value += `
                                    <a href="`+view_url+`" class="dropdown-item" data-toggle="modal" data-target="#vcxl_modal" data-path="`+view_url+`" data-title="{{trans('inventory::inventory.view_details')}}" data-modal-load>
                                        <span>
                                            <i class="fas fa-info-circle"></i>
                                            <span>{{trans('inventory::inventory.view_details')}}</span>
                                        </span>
                                    </a>
                                    `;

                            @haspermission('update-inventory-sell-request')
                                value += `
                                            <a href="{{route('inventory.sell_requests.modals.update')}}" class="dropdown-item" data-toggle="modal" data-target="#fast_modal" data-path="{{route('inventory.sell_requests.modals.update')}}" data-title="{{trans('inventory::inventory.update_sell_request')}}" data-id="` + full.id + `" data-modal-load>
                                                <span>
                                                    <i class="la la-edit"></i>
                                                    <span>{{trans('inventory::inventory.update_sell_request')}}</span>
                                                </span>
                                            </a>
                                        `;
                            @endhaspermission

                            @haspermission('delete-inventory-sell-request')
                                value += `
                                                <a class="dropdown-item" data-8x-delete-it='{"container":false, "path":"` + delete_url + `", "callback": "DeleteSellRequestCallback"}' href="#"><i class="la la-trash"></i> {{__('inventory::inventory.delete_sell_request')}}</a>
                                            `;
                            @endhaspermission

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
        sell_requests_table = initTable1("{{ route('inventory.sell_requests.index') }}");

        // Search datatable
        $('#m_search').on('click', function(e) {
            e.preventDefault();
            var query = $('#search_sell_requests_form').serialize();
            $("#sell_requests_table").dataTable().fnDestroy();
            sell_requests_table = initTable1("{{ route('inventory.sell_requests.index') }}" + '?' + query);
        });

        // Reset search form
        $('#m_reset').on('click', function(e) {
            e.preventDefault();
            $(this).closest('form').trigger("reset");
            $("#sell_requests_table").dataTable().fnDestroy();
            sell_requests_table = initTable1("{{ route('inventory.sell_requests.index') }}");
        });
    });
</script>
<script>
    function DeleteSellRequestCallback() {
        // Reload datatable with delay to clear cache
        setTimeout(function() {
            sell_requests_table.ajax.reload(function(json) {
                //
            }, false);
        }, 3000);
    }
</script>