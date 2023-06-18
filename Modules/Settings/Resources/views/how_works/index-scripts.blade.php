<script>
    $('body').addClass('kt-aside--enabled kt-aside--fixed');
</script>
<script>
    function initTable1(url) {
        var table = $('#how_works_table');
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
                    data: 'link',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'image',
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
                    title: "{{trans('settings::settings.title')}}",
                    render: function(data, type, full, meta) {
                        return full.value;
                    },
                },
                {
                    targets: 2,
                    title: "{{trans('settings::settings.image')}}",
                    render: function(data, type, full, meta) {
                        return `<img src="{{asset('storage/'.'${full.image}')}}" alt="" style="width:100px;" srcset="">`;;
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
                        var delete_url = "{{route('settings.how_works.delete', 'id=:id')}}";
                        delete_url = delete_url.replace(':id', full.id);

                        @if(auth()->user()->hasPermission('update-settings-how-work') || auth()->user()->hasPermission('delete-settings-how-work'))
                        var value = `
                            <span class="dropdown">
                                <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                                    <i class="la la-ellipsis-h"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                            `;
                        @if(auth()->user()->hasPermission('update-settings-how-work'))
                        value += `
                                    <a href="{{route('settings.how_works.modals.update')}}" class="dropdown-item" data-toggle="modal" data-target="#fast_modal" data-path="{{route('settings.how_works.modals.update')}}" data-title="{{trans('settings::settings.update_how_work')}}" data-id="` + full.id + `" data-modal-load>
                                        <span>
                                            <i class="la la-edit"></i>
                                            <span>{{trans('settings::settings.update_how_work')}}</span>
                                        </span>
                                    </a>
                                `;
                        @endif
                        @if(auth()->user()->hasPermission('delete-settings-how-work'))
                        value += `
                                    <a class="dropdown-item" data-8x-delete-it='{"container":false, "path":"` + delete_url + `", "callback": "deleteHowWorkCallback"}' href="#"><i class="la la-trash"></i> {{__('settings::settings.delete_how_work')}}</a>
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
        how_works_table = initTable1("{{ route('settings.how_works.index') }}");

        // Search datatable
        $('#m_search').on('click', function(e) {
            e.preventDefault();
            var query = $('#search_how_works_form').serialize();
            $("#how_works_table").dataTable().fnDestroy();
            how_works_table = initTable1("{{ route('settings.how_works.index') }}" + '?' + query);
        });

        // Reset search form
        $('#m_reset').on('click', function(e) {
            e.preventDefault();
            $(this).closest('form').trigger("reset");
            $("#how_works_table").dataTable().fnDestroy();
            how_works_table = initTable1("{{ route('settings.how_works.index') }}");
        });
    });
</script>
<script>
    function deleteHowWorkCallback() {
        // Reload datatable with delay to clear cache
        setTimeout(function() {
            how_works_table.ajax.reload(function(json) {
                //
            }, false);
        }, 3000);
    }
</script>
