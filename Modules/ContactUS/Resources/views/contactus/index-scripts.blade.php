<script>
    $('.m_selectpicker').selectpicker();
</script>
<script>
    $('body').addClass('kt-aside--enabled kt-aside--fixed');
</script>
<script>
    function initTable1(url) {
        var table = $('#contact_us_table');
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
                @if (auth()->user()->hasPermission('export-contact-us-messages'))
                {
                    extend: 'excel',
                    footer: true,
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6]
                    }
                }
                @endif
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
                {data: 'full_name', orderable: true, searchable: true},
                {data: 'phone', orderable: true, searchable: true},
                {data: 'email', orderable: true, searchable: true},
                {data: 'message', orderable: false, searchable: false},
                {data: 'link', orderable: false, searchable: true},
                {data: 'created_at', orderable: true, searchable: true},
                {data: 'is_readed', orderable: false, searchable: false},
            ],
            order: [[0, 'desc']],

            columnDefs: [
                {
                    targets: 0,
                    title: '{{trans('contactus::contact_us.id')}}',
                    render: function(data, type, full, meta) {
                        return full.id;
                    },
                },
                {
                    targets: 1,
                    title: '{{trans('contactus::contact_us.name')}}',
                    render: function(data, type, full, meta) {
                        return full.full_name;
                    },
                },
                {
                    targets: 2,
                    title: '{{trans('contactus::contact_us.phone')}}',
                    render: function(data, type, full, meta) {
                        return full.phone;
                    },
                },
                {
                    targets: 3,
                    title: '{{trans('contactus::contact_us.email')}}',
                    render: function(data, type, full, meta) {
                        return full.email;
                    },
                },
                {
                    targets: 4,
                    title: '{{trans('contactus::contact_us.message')}}',
                    render: function(data, type, full, meta) {
                        return full.message;
                    },
                },
                {
                    targets: 5,
                    title: '{{trans('contactus::contact_us.link')}}',
                    render: function(data, type, full, meta) {
                        return full.link;
                    },
                },
                {
                    targets: 6,
                    title: '{{trans('contactus::contact_us.type')}}',
                    render: function(data, type, full, meta) {
                        return full.type;
                    },
                },
                {
                    targets: 7,
                    title: '{{trans('contactus::contact_us.best_from')}}',
                    render: function(data, type, full, meta) {
                        return full.best_time_to_call_from;
                    },
                },
                // {
                //     targets: 7,
                //     title: '{{trans('contactus::contact_us.best_to')}}',
                //     render: function(data, type, full, meta) {
                //         return full.best_time_to_call_to;
                //     },
                // },
                {
                    targets: 8,
                    title: '{{trans('contactus::contact_us.created_at')}}',
                    render: function(data, type, full, meta) {
                        return full.created_at;
                    },
                },
                {
                    targets: 9,
                    title: '{{trans('contactus::contact_us.readed')}}',
                    render: function(data, type, full, meta) {
                        return full.is_readed ? '<i class="la la-check"></i>' : '' ;
                    },
                },
                {
                    targets: 10,
                    title: '{{trans('contactus::contact_us.actions')}}',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        var delete_url = '{{route("contact_us.contact_us.read", "id=:id")}}';
                        delete_url = delete_url.replace(':id', full.id);

                        @if (auth()->user()->hasPermission('update-contact-us') || auth()->user()->hasPermission('delete-contact-us'))
                            var value = `

                            `;
                            if(!full.is_readed){
                            @if (auth()->user()->hasPermission('delete-contact-us'))
                                value += `
                                    <a class="dropdown-item" data-8x-delete-it='{"container":false, "path":"`+delete_url+`", "callback": "deleteContactUsCallback"}' href="#"><i class="la la-check"></i> {{__('contactus::contact_us.readed')}}</a>
                                `;
                            @endif
                            }
                            value += `

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
        contact_us = initTable1('{{ route('contact_us.contact_us.index') }}');

        // Search datatable
        $('#m_search').on('click', function(e) {
            e.preventDefault();
            var query = $('#search_contactus_form').serialize();
            $("#contact_us").dataTable().fnDestroy();
            contact_us = initTable1('{{ route('contact_us.contact_us.index') }}'+'?'+query);
        });

        // Reset search form
        $('#m_reset').on('click', function(e) {
            e.preventDefault();
            $(this).closest('form').trigger("reset");
            $("#contact_us").dataTable().fnDestroy();
            contact_us = initTable1('{{ route('contact_us.contact_us.index') }}');
        });
    });
</script>
<script>
    function deleteContactUsCallback() {
        // Reload datatable with delay to clear cache
        setTimeout(function() {
            contact_us.ajax.reload(function(json) {
                //
            }, false);
        }, 3000);
    }
</script>