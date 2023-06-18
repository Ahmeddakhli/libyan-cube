<script>
    $('body').addClass('kt-aside--enabled kt-aside--fixed');
</script>
<script>
    function initTable1(url) {
        var table = $('#meetings_table');
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
                    data: 'meeting_type',
                    orderable: true,
                    searchable: true
                }, ,
                {
                    data: 'user',
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
                    title: "{{trans('meetings::meeting.id')}}",
                    render: function(data, type, full, meta) {
                        return full.id;
                    },
                },
                {
                    targets: 1,
                    title: "{{trans('meetings::meeting.type')}}",
                    render: function(data, type, full, meta) {
                        return full.meeting_type;
                    },
                },
                {
                    targets: 2,
                    title: "{{trans('meetings::meeting.user')}}",
                    render: function(data, type, full, meta) {
                        return full.user.full_name;
                    },
                },
                {
                    targets: 3,
                    title: "{{trans('meetings::meeting.created_at')}}",
                    render: function(data, type, full, meta) {
                        return full.created_at;
                    },
                },
                {
                    targets: 4,
                    title: "{{trans('meetings::meeting.last_updated_at')}}",
                    render: function(data, type, full, meta) {
                        return full.last_updated_at;
                    },
                },
                {
                    targets: 5,
                    title: "{{trans('meetings::meeting.actions')}}",
                    orderable: false,
                    render: function(data, type, full, meta) {
                        var delete_url = "{{route('meetings.delete','id=:id')}}";
                        delete_url = delete_url.replace(':id',full.id);

                        @if(auth()->user()->hasPermission('delete-meeting'))
                            var value = `
                            <a class="dropdown-item" data-8x-delete-it='{"container":false, "path":"` + delete_url + `", "callback": "deleteMeetingCallback"}' href="#"><i class="la la-trash"></i> {{__('meetings::meeting.delete_meeting')}}</a>`;
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
        meetings_table = initTable1("{{ route('meetings.index') }}");

        // Search datatable
        $('#m_search').on('click', function(e) {
            e.preventDefault();
            var query = $('#search_meeting_form').serialize();
            $("#meetings_table").dataTable().fnDestroy();
            meetings_table = initTable1("{{ route('meetings.index') }}" + '?' + query);
        });

        // Reset search form
        $('#m_reset').on('click', function(e) {
            e.preventDefault();
            $(this).closest('form').trigger("reset");
            $("#meetings_table").dataTable().fnDestroy();
            meetings_table = initTable1("{{ route('meetings.index') }}");
        });
    });
</script>
<script>
    function deleteMeetingCallback() {
        // Reload datatable with delay to clear cache
        setTimeout(function() {
            meetings_table.ajax.reload(function(json) {
                //
            }, false);
        }, 3000);
    }
</script>
