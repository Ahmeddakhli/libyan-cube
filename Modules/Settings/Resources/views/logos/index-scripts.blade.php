<script>
    $('body').addClass('kt-aside--enabled kt-aside--fixed');
</script>
<script>
    function initTable1(url) {
        var table = $('#logos_table');
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
                    data: 'type',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'value',
                    orderable: false,
                    searchable: false
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
                    title: "{{trans('settings::settings.id')}}",
                    render: function(data, type, full, meta) {
                        return full.id;
                    },
                },
                {
                    targets: 1,
                    title: "{{trans('settings::settings.type')}}",
                    render: function(data, type, full, meta) {
                        return full.type;
                    },
                },
                {
                    targets: 2,
                    title: "{{trans('settings::settings.logo')}}",
                    render: function(data, type, full, meta) {
                        return `<img src="{{asset('storage/'.'${full.value}')}}" alt="" style="width:100px;" srcset="">`;
                    },
                },
                {
                    targets: 3,
                    title: "{{trans('settings::settings.created_at')}}",
                    render: function(data, type, full, meta) {
                        return full.created_at;
                    },
                },
                {
                    targets: 4,
                    title: "{{trans('settings::settings.last_updated_at')}}",
                    render: function(data, type, full, meta) {
                        return full.last_updated_at;
                    },
                },
                {
                    targets: 5,
                    title: "{{trans('settings::settings.actions')}}",
                    orderable: false,
                    render: function(data, type, full, meta) {
                        var delete_url = "{{route('settings.logos.delete', 'id=:id')}}";
                        delete_url = delete_url.replace(':id', full.id);

                        @if(auth()->user()->hasPermission('update-settings-logo') || auth()->user()->hasPermission('delete-settings-logo'))
                        var value = `
                            <span class="dropdown">
                                <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                                    <i class="la la-ellipsis-h"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                            `;
                        @if(auth()->user()->hasPermission('update-settings-logo'))
                        value += `
                                    <a href="{{route('settings.logos.modals.update')}}" class="dropdown-item" data-toggle="modal" data-target="#fast_modal" data-path="{{route('settings.logos.modals.update')}}" data-title="{{trans('settings::settings.update_logo')}}" data-id="` + full.id + `" data-modal-load>
                                        <span>
                                            <i class="la la-edit"></i>
                                            <span>{{trans('settings::settings.update_logo')}}</span>
                                        </span>
                                    </a>
                                `;
                        @endif
                        @if(auth()->user()->hasPermission('delete-settings-logo'))
                        value += `
                                    <a class="dropdown-item" data-8x-delete-it='{"container":false, "path":"` + delete_url + `", "callback": "deleteLogoCallback"}' href="#"><i class="la la-trash"></i> {{__('settings::settings.delete_logo')}}</a>
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
        logos_table = initTable1("{{ route('settings.logos.index') }}");

        // Search datatable
        $('#m_search').on('click', function(e) {
            e.preventDefault();
            var query = $('#search_logos_form').serialize();
            $("#logos_table").dataTable().fnDestroy();
            logos_table = initTable1("{{ route('settings.logos.index') }}" + '?' + query);
        });

        // Reset search form
        $('#m_reset').on('click', function(e) {
            e.preventDefault();
            $(this).closest('form').trigger("reset");
            $("#logos_table").dataTable().fnDestroy();
            logos_table = initTable1("{{ route('settings.logos.index') }}");
        });
    });
</script>
<script>
    function deleteLogoCallback() {
        // Reload datatable with delay to clear cache
        setTimeout(function() {
            logos_table.ajax.reload(function(json) {
                //
            }, false);
        }, 3000);
    }
</script>
