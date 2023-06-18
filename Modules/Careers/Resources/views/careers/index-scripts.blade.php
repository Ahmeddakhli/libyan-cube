<script>
    $('.m_selectpicker').selectpicker();
</script>
<script>
    $('body').addClass('kt-aside--enabled kt-aside--fixed');
</script>
<script>
    function initTable1(url) {
        var table = $('#careers_table');
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
                {data: 'value', orderable: true, searchable: true},
                {data: 'created_at', orderable: true, searchable: true},
                {data: 'last_updated_at', orderable: true, searchable: true},
            ],
            columnDefs: [
                {
                    targets: 0,
                    title: '{{trans('careers::career.id')}}',
                    render: function(data, type, full, meta) {
                        return full.id;
                    },
                },
                {
                    targets: 1,
                    title: '{{trans('careers::career.title')}}',
                    render: function(data, type, full, meta) {
                        return full.value;
                    },
                },
                {
                    targets: 2,
                    title: '{{trans('careers::career.created_at')}}',
                    render: function(data, type, full, meta) {
                        return full.created_at;
                    },
                },
                {
                    targets: 3,
                    title: '{{trans('careers::career.last_updated_at')}}',
                    render: function(data, type, full, meta) {
                        return full.last_updated_at;
                    },
                },
                {
                    targets: 4,
                    title: '{{trans('careers::career.actions')}}',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        var delete_url = '{{route("careers.delete", "id=:id")}}';
                        delete_url = delete_url.replace(':id', full.id);

                        @if (auth()->user()->hasPermission('update-career') || auth()->user()->hasPermission('delete-career'))
                            var value = `
                            <span class="dropdown">
                                <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                                    <i class="la la-ellipsis-h"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                            `;
                            @if (auth()->user()->hasPermission('update-career'))
                                value += `
                                    <a href="{{route('careers.modals.update')}}" class="dropdown-item" data-toggle="modal" data-target="#fast_modal" data-path="{{route('careers.modals.update')}}" data-title="{{trans('careers::career.update_career')}}" data-id="`+full.id+`" data-modal-load>
                                        <span>
                                            <i class="la la-edit"></i>
                                            <span>{{trans('careers::career.update_career')}}</span>
                                        </span>
                                    </a>
                                `;
                            @endif
                            @if (auth()->user()->hasPermission('delete-career'))
                                value += `
                                    <a class="dropdown-item" data-8x-delete-it='{"container":false, "path":"`+delete_url+`", "callback": "deleteCareerCallback"}' href="#"><i class="la la-trash"></i> {{__('careers::career.delete_career')}}</a>
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
        careers_table = initTable1('{{ route('careers.index') }}');

        // Search datatable
        $('#m_search').on('click', function(e) {
            e.prcareerDefault();
            var query = $('#search_careers_form').serialize();
            $("#careers_table").dataTable().fnDestroy();
            careers_table = initTable1('{{ route('careers.index') }}'+'?'+query);
        });

        // Reset search form
        $('#m_reset').on('click', function(e) {
            e.prcareerDefault();
            $(this).closest('form').trigger("reset");
            $("#careers_table").dataTable().fnDestroy();
            careers_table = initTable1('{{ route('careers.index') }}');
        });
    });
</script>
<script>
    function deleteCareerCallback() {
        // Reload datatable with delay to clear cache
        setTimeout(function() {
            careers_table.ajax.reload(function(json) {
                //
            }, false);
        }, 3000);
    }
</script>