<script>
    $('body').addClass('kt-aside--enabled kt-aside--fixed');
</script>
<script>
    function initTable1(url) {
        var table = $('#about_table');
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
            columns: [
                {data: 'id', orderable: true, searchable: true},
                {data: 'value', orderable: false, searchable: true},
                {data: 'created_at', orderable: true, searchable: true},
                {data: 'last_updated_at', orderable: true, searchable: false},
            ],
            columnDefs: [
                {
                    targets: 0,
                    title: '{{trans('about::about.id')}}',
                    render: function(data, type, full, meta) {
                        return full.id;
                    },
                },
                {
                    targets: 1,
                    title: '{{trans('about::about.title')}}',
                    render: function(data, type, full, meta) {
                        return full.value;
                    },
                },
                {
                    targets: 2,
                    title: '{{trans('about::about.created_at')}}',
                    render: function(data, type, full, meta) {
                        return full.created_at;
                    },
                },
                {
                    targets: 3,
                    title: '{{trans('about::about.last_updated_at')}}',
                    render: function(data, type, full, meta) {
                        return full.last_updated_at;
                    },
                },
                {
                    targets: 4,
                    title: '{{trans('about::about.actions')}}',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        var delete_url = '{{route("about.delete", "id=:id")}}';
                        delete_url = delete_url.replace(':id', full.id);

                        var update_url = '{{route("about.modals.update", "id=:id")}}';
                        update_url = update_url.replace('id=:id', full.id);
                        @if (auth()->user()->hasPermission('update-about-section') || auth()->user()->hasPermission('delete-about-section'))
                            var value = `
                            <span class="dropdown">
                                <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                                    <i class="la la-ellipsis-h"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                            `;
                            @if (auth()->user()->hasPermission('update-about-section'))
                                value += `
                                    <a href="${update_url}" class="dropdown-item">
                                        <span>
                                            <i class="la la-edit"></i>
                                            <span>{{trans('about::about.update_about')}}</span>
                                        </span>
                                    </a>
                                `;
                            @endif
                            @if (auth()->user()->hasPermission('delete-about-section'))
                                value += `
                                    <a class="dropdown-item" data-8x-delete-it='{"container":false, "path":"`+delete_url+`", "callback": "deleteAboutCallback"}' href="#"><i class="la la-trash"></i> {{__('about::about.delete_about')}}</a>
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
        about_table = initTable1('{{ route('about.index') }}');

        // Search datatable
        $('#m_search').on('click', function(e) {
            e.preventDefault();
            var query = $('#search_about_form').serialize();
            $("#about_table").dataTable().fnDestroy();
            about_table = initTable1('{{ route('about.index') }}'+'?'+query);
        });

        // Reset search form
        $('#m_reset').on('click', function(e) {
            e.preventDefault();
            $(this).closest('form').trigger("reset");
            $("#about_table").dataTable().fnDestroy();
            about_table = initTable1('{{ route('about.index') }}');
        });
    });
</script>
<script>
    function deleteAboutCallback() {
        // Reload datatable with delay to clear cache
        setTimeout(function() {
            about_table.ajax.reload(function(json) {
                //
            }, false);
        }, 3000);
    }
</script>