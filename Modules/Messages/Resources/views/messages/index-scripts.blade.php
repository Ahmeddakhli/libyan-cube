<script>
    $('body').addClass('kt-aside--enabled kt-aside--fixed');
</script>
<script>
    function initTable1(url) {
        var table = $('#messages_table');
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
                {
                    extend: 'excel',
                    footer: true,
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8]
                    }
                }
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
                    data: 'sender',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'receiver',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'project',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'phone',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'email',
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'message',
                    orderable: false,
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
            order: [[0, 'desc']],
            columnDefs: [
                {
                    targets: 0,
                    title: "{{trans('messages::message.id')}}",
                    render: function(data, type, full, meta) {
                        return full.id;
                    },
                },
                {
                    targets: 1,
                    title: "{{trans('messages::message.sender')}}",
                    render: function(data, type, full, meta) {
                        return full.sender;
                    },
                },
                {
                    targets: 2,
                    title: "{{trans('messages::message.receiver')}}",
                    render: function(data, type, full, meta) {
                        return full.receiver;
                    },
                },
                {
                    targets: 3,
                    title: "{{trans('messages::message.project')}}",
                    render: function(data, type, full, meta) {
                        return full.project ? full.project.value : 'تم حذف المشروع';
                    },
                },
                {
                    targets: 4,
                    title: "{{trans('messages::message.name')}}",
                    render: function(data, type, full, meta) {
                        return full.name;
                    },
                },
                {
                    targets: 5,
                    title: "{{trans('messages::message.phone')}}",
                    render: function(data, type, full, meta) {
                        return full.phone;
                    },
                },
                {
                    targets: 6,
                    title: "{{trans('messages::message.email')}}",
                    render: function(data, type, full, meta) {
                        return full.email;
                    },
                },
                {
                    targets: 7,
                    title: "{{trans('messages::message.message')}}",
                    render: function(data, type, full, meta) {
                        return full.message;
                    },
                },
                {
                    targets: 8,
                    title: "{{trans('messages::message.created_at')}}",
                    render: function(data, type, full, meta) {
                        return full.created_at;
                    },
                },
                {
                    targets: 9,
                    title: "{{trans('messages::message.last_updated_at')}}",
                    render: function(data, type, full, meta) {
                        return full.last_updated_at;
                    },
                },
                {
                    targets: 10,
                    title: "{{trans('messages::message.readed')}}",
                    render: function(data, type, full, meta) {
                        return full.is_readed ? '<i class="la la-check"></i>' : '';
                    },
                },
                {
                    targets: 11,
                    title: "{{trans('messages::message.actions')}}",
                    orderable: false,
                    render: function(data, type, full, meta) {
                        var delete_url = "{{route('messages.delete','id=:id')}}";
                        delete_url = delete_url.replace(':id',full.id);
                        var read_url = "{{route('messages.read','id=:id')}}";
                        read_url = read_url.replace(':id',full.id);

                        @if(auth()->user()->hasPermission('delete-message'))
                            var value = `
                            <a class="dropdown-item" data-8x-delete-it='{"container":false, "path":"` + delete_url + `", "callback": "deleteMessageCallback"}' href="#"><i class="la la-trash"></i> {{__('messages::message.delete_message')}}</a> `
                            if(!full.is_readed){
                                value+=`<a class="dropdown-item" data-8x-delete-it='{"container":false, "path":"` + read_url + `", "callback": "deleteMessageCallback"}' href="#"><i class="la la-check"></i> {{__('messages::message.readed')}}</a>`;
                            }

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
        messages_table = initTable1("{{ route('messages.index') }}");

        // Search datatable
        $('#m_search').on('click', function(e) {
            e.preventDefault();
            var query = $('#search_message_form').serialize();
            $("#messages_table").dataTable().fnDestroy();
            messages_table = initTable1("{{ route('messages.index') }}" + '?' + query);
        });

        // Reset search form
        $('#m_reset').on('click', function(e) {
            e.preventDefault();
            $(this).closest('form').trigger("reset");
            $("#messages_table").dataTable().fnDestroy();
            messages_table = initTable1("{{ route('messages.index') }}");
        });
    });
</script>
<script>
    function deleteMessageCallback() {
        // Reload datatable with delay to clear cache
        setTimeout(function() {
            messages_table.ajax.reload(function(json) {
                //
            }, false);
        }, 3000);
    }
</script>
