<script>
    $.fn.dataTable.Api.register('column().title()', function() {
        return $(this.header()).text().trim();
    });

    function initTable1(url) {
        // begin table
        return $('#index_groups_table').DataTable({
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

            language: {
                'lengthMenu': '{{trans('datatables.display')}} _MENU_',
                search: "_INPUT_",
                searchPlaceholder: "{{trans('datatables.search')}}",
                "sLengthMenu": "{{trans('datatables.display')}} _MENU_ {{trans('datatables.records')}}",
                "paginate": {
                    "info": "{{trans('datatables.showing_page')}} _PAGE_ {{trans('datatables.of')}} _PAGES_",
                    "infoEmpty": "{{trans('datatables.no_records_available')}}"
                }
            },

            ajax: {
                url: url,
                type: 'POST',
                data: {
                    // Parameters
                    columnsDef: [
                        // 'id', 'group_name', 'parent_group_name', 'users'
                    ],
                },
            },

            columns: [
                {data: 'id', orderable: true, searchable: true},
                {data: 'name', orderable: true, searchable: true},
                // {data: 'description', orderable: false, searchable: true},
                {data: 'parent', orderable: false, searchable: false},
                {data: 'created_at', orderable: true, searchable: true},
                {data: 'updated_at', orderable: true, searchable: true},
                {data: 'Actions', orderable: false, searchable: false},
            ],

            initComplete: function() {
                this.api().columns().every(function() {
                    var column = this;

                    switch (column.title()) {
                        //
                    }
                });
            },

            columnDefs: [
                {
                    targets: 0
                },
                {
                    targets: 1,
                    title: '{{trans('groups.group_name')}}'
                },
                // {
                //     targets: 2,
                //     title: '{{trans('groups.group_description')}}'
                // },
                {
                    targets: 2,
                    title: '{{trans('groups.parent_group_name')}}',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return data ? data.name : null;
                    },
                },
                {
                    targets: 3,
                    title: '{{trans('groups.created_at')}}'
                },
                {
                    targets: 4,
                    title: '{{trans('groups.updated_at')}}'
                },
                {
                    targets: -1,
                    title: '{{trans('groups.actions')}}',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        // Exclude front end groups from update/delete/update permissions
                        var front_users_groups = ['brokers', 'developers', 'owners', 'buyers'];
                        if (front_users_groups.includes(full.slug)) {
                            return ``;
                        }

                        {{--
                                <a href="#" class="dropdown-item" data-path="{{route('groups.delete')}}" data-title="{{trans('groups.delete_group')}}" data-msg="{{trans('groups.are_you_sure_you_want_to_delete_the_group')}}" data-true="{{trans('groups.sure')}}" data-false="{{trans('groups.cancel')}}" data-id="`+full.id+`" data-callback="deleteGroupCallback" data-delete>
                                    <span>
                                        <i class="la la-trash"></i>
                                        <span>{{trans('groups.delete_group')}}</span>
                                    </span>
                                </a>
                        --}}
                        var delete_url = '{{route("groups.delete", "id=:id")}}';
                        delete_url = delete_url.replace(':id', full.id);

                        @if (auth()->user()->hasPermission('update-group')
                            || auth()->user()->hasPermission('update-group-permissions')
                            || auth()->user()->hasPermission('delete-group'))
                            var value = `
                            <span class="dropdown">
                                <a href="#" class="btn btn-metal m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                                  <i class="la la-ellipsis-h"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                            `;
                                    @haspermission('update-group')
                            value += `
                                    <a href="{{route('groups.modals.update')}}" class="dropdown-item" data-toggle="modal" data-target="#fast_modal" data-path="{{route('groups.modals.update')}}" data-title="{{trans('groups.update_group')}}" data-id="`+full.id+`" data-modal-load>
                                        <span>
                                            <i class="la la-edit"></i>
                                            <span>{{trans('groups.update_group')}}</span>
                                        </span>
                                    </a>
                            `;
                                    @endhaspermission
                                    @haspermission('update-group-permissions')
                            if (full.id != 1 && full.id != 2) {
                                value += `
                                    <a href="{{route('groups.modals.updatePermissions')}}" class="dropdown-item" data-toggle="modal" data-target="#vcxl_modal" data-path="{{route('groups.modals.updatePermissions')}}" data-title="{{trans('groups.update_group_permissions')}}" data-id="`+full.id+`" data-modal-load>
                                        <span>
                                            <i class="la la-leaf"></i>
                                            <span>{{trans('groups.update_group_permissions')}}</span>
                                        </span>
                                    </a>
                                `;
                            }
                                    @endhaspermission
                                    @haspermission('delete-group')
                            if (full.id != 1 && full.id != 2) {
                                value += `
                                    <a class="dropdown-item" data-8x-delete-it='{"container":false, "path":"`+delete_url+`", "callback": "deleteGroupCallback"}' href="#"><i class="la la-trash"></i> {{trans('groups.delete_group')}}</a>
                                `;
                            }
                                    @endhaspermission
                            value += `
                                </div>
                            </span>`;
                            return value;
                        @else
                            return ``;
                        @endif
                    },
                },
            ],
        });

        var filter = function() {
            var val = $.fn.dataTable.util.escapeRegex($(this).val());
            table.column($(this).data('col-index')).search(val ? val : '', false, false).draw();
        };

        var asdasd = function(value, index) {
            var val = $.fn.dataTable.util.escapeRegex(value);
            table.column(index).search(val ? val : '', false, true);
        };

        $('#m_datepicker').datepicker({
            todayHighlight: true,
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>',
            },
        });

    };

    jQuery(document).ready(function() {
        // Init datatable
        groups_table = initTable1('{{ route('groups.index') }}');

        // Search datatable
        $('#m_search').on('click', function(e) {
            e.preventDefault();
            var query = $('#search_groups_form').serialize();
            groups_table.destroy();
            groups_table = initTable1('{{ route('groups.index') }}'+'?'+query);
        });

        // Reset search form
        $('#m_reset').on('click', function(e) {
            e.preventDefault();
            $(this).closest('form').trigger("reset");
            groups_table.destroy();
            groups_table = initTable1('{{ route('groups.index') }}');
        });
    });

    function deleteGroupCallback() {
        // Reload datatable with delay
        setTimeout(function() {
            groups_table.ajax.reload(function(json) {
                //
            }, false);
        }, 3000);
    }
</script>