<script>
    $.fn.dataTable.Api.register('column().title()', function() {
        return $(this.header()).text().trim();
    });

    function initTable1(url) {
        // begin table
        return $('#index_users_table').DataTable({

            language: {
                'lengthMenu': '{{trans('datatables.display')}} _MENU_',
                search: "_INPUT_",
                searchPlaceholder: "{{trans('datatables.search')}}",
                "sLengthMenu": "{{trans('datatables.display')}} _MENU_ {{trans('datatables.records')}}",
                "paginate": {
                    "previous": "{{trans('datatables.previous')}}",
                    "next": "{{trans('datatables.next')}}",
                    "info": "{{trans('datatables.showing_page')}} _PAGE_ {{trans('datatables.of')}} _PAGES_",
                    "infoEmpty": "{{trans('datatables.no_records_available')}}"
                }
            },

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
                {data: 'image', orderable: false, searchable: false},
                {data: 'full_name', orderable: true, searchable: true},
                // {data: 'username', orderable: true, searchable: true},
                {data: 'email', orderable: true, searchable: true},
                {data: 'mobile_number', orderable: true, searchable: true},
                // {data: 'job_title', orderable: true, searchable: true},
                {data: 'group.name', orderable: true, searchable: true},
                // {data: 'last_assignment_date'},
                // {data: 'connection_id'},
                {data: 'is_suspended', orderable: true, searchable: false},
                // {data: 'age', orderable: true, searchable: true},
                // {data: 'gender', orderable: true, searchable: true},
                // {data: 'last_login_at', orderable: true, searchable: true},
                // {data: 'last_login_ip', orderable: true, searchable: true},
                // {data: 'created_at', orderable: true, searchable: true},
                // {data: 'updated_at', orderable: true, searchable: true},
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
                    targets: 0,
                    title: '{{trans('users.user_id')}}'
                },
                {
                    targets: 1,
                    title: '{{trans('users.image')}}',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return `
                            <div class="m-card-user m-card-user--sm">
                                <div class="m-card-user__pic">
                                    <img style="height:50% !important;width:50% !important;" src="{{url('/')}}/` + full.image + `" class="m--img-rounded m--marginless" alt="{{trans('users.image')}}">
                                </div>
                            </div>`;
                    },
                },
                {
                    targets: 2,
                    title: '{{trans('users.full_name')}}'
                },
                // {
                //     targets: 3,
                //     title: '{{trans('users.username')}}'
                // },
                {
                    targets: 3,
                    title: '{{trans('users.email')}}'
                },
                {
                    targets: 4,
                    title: '{{trans('users.mobile_number')}}'
                },
                // {
                //     targets: 5,
                //     title: '{{trans('users.job_title')}}'
                // },
                {
                    targets: 5,
                    title: '{{trans('users.group_name')}}',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return data;
                    },
                },
                // {
                //     targets: 8,
                //     title: '{{trans('users.last_assignment_date')}}'
                // },
                // {
                //     targets: 9,
                //     title: '{{trans('users.connection_status')}}',
                //     render: function(data, type, full, meta) {
                //         return full.connection_id ? '{{trans('users.connected')}}' : '{{trans('users.disconnected')}}';
                //     }
                // },
                {
                    targets:6,
                    title: '{{trans('users.suspension_status')}}',
                    render: function(data, type, full, meta) {
                        return full.is_suspended ? '{{trans('users.suspended')}}' : '{{trans('users.active')}}';
                    }
                },
                // {
                //     targets: 11,
                //     title: '{{trans('users.age')}}'
                // },
                // {
                //     targets: 12,
                //     title: '{{trans('users.gender')}}',
                //     render: function(data, type, full, meta) {
                //         return full.gender == 1 ? '{{trans('users.male')}}' : (full.gender == 2 ? '{{trans('users.female')}}' : '{{trans('users.unknown')}}');
                //     }
                // },
                // {
                //     targets: 13,
                //     title: '{{trans('users.last_login_at')}}'
                // },
                // {
                //     targets: 14,
                //     title: '{{trans('users.last_login_ip')}}'
                // },
                // {
                //     targets: 15,
                //     title: '{{trans('users.created_at')}}'
                // },
                // {
                //     targets: 16,
                //     title: '{{trans('users.updated_at')}}'
                // },
                {
                    targets: -1,
                    title: '{{trans('users.actions')}}',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        var delete_url = '{{route("users.delete", "id=:id")}}';
                        delete_url = delete_url.replace(':id', full.id);
                        var un_suspend_url = '{{route("users.unSuspend", "id=:id")}}';
                        un_suspend_url = un_suspend_url.replace(':id', full.id);

                        /*
                                <a href="#" class="dropdown-item" data-path="{{route('users.delete')}}" data-title="{{trans('users.delete_user')}}" data-msg="{{trans('users.are_you_sure_you_want_to_delete_the_user')}}" data-true="{{trans('users.sure')}}" data-false="{{trans('users.cancel')}}" data-id="`+full.id+`" data-callback="deleteUserCallback" data-delete>
                                    <span>
                                        <i class="la la-trash"></i>
                                        <span>{{trans('users.delete_user')}}</span>
                                    </span>
                                </a>
                         */

                        @if (auth()->user()->hasPermission('delete-user'))
                            var delete_btn = `<a class="dropdown-item" data-8x-delete-it='{"container":false, "path":"`+delete_url+`", "callback": "deleteUserCallback"}' href="#"><i class="la la-trash"></i> {{trans('users.delete_user')}}</a>`;
                        @endif
                        if(full.is_suspended == 0){
                        @if (auth()->user()->hasPermission('update-user')
                            || auth()->user()->hasPermission('update-user-permissions')
                            || auth()->user()->hasPermission('suspend-user'))
                            return `
                            <span class="dropdown">
                                <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                                  <i class="la la-ellipsis-h"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    @if (auth()->user()->hasPermission('update-user'))
                                    <a href="{{route('users.modals.update')}}" class="dropdown-item" data-toggle="modal" data-target="#fast_modal" data-path="{{route('users.modals.update')}}" data-title="{{trans('users.update_user')}}" data-id="`+full.id+`" data-modal-load>
                                        <span>
                                            <i class="la la-edit"></i>
                                            <span>{{trans('users.update_user')}}</span>
                                        </span>
                                    </a>
                                    @endif
                                    @if (auth()->user()->hasPermission('update-user-permissions'))
                                    <a href="{{route('users.modals.updatePermissions')}}" class="dropdown-item" data-toggle="modal" data-target="#vcxl_modal" data-path="{{route('users.modals.updatePermissions')}}" data-title="{{trans('users.update_user_permissions')}}" data-id="`+full.id+`" data-modal-load>
                                        <span>
                                            <i class="la la-leaf"></i>
                                            <span>{{trans('users.update_user_permissions')}}</span>
                                        </span>
                                    </a>
                                    @endif
                                    @if (auth()->user()->hasPermission('suspend-user'))
                                    <a href="{{route('users.modals.suspend')}}" class="dropdown-item" data-toggle="modal" data-target="#fast_modal" data-path="{{route('users.modals.suspend')}}" data-title="{{trans('users.suspend_user_account')}}" data-id="`+full.id+`" data-modal-load>
                                        <span>
                                            <i class="la la-edit"></i>
                                            <span>{{trans('users.suspend_user_account')}}</span>
                                        </span>
                                    </a>
                                    @endif
                                </div>
                            </span>`;
                        @endif
                        }else{
                            return `
                                    <span class="dropdown">
                                        <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                                        <i class="la la-ellipsis-h"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" data-8x-un-suspend-it='{"container":false, "path":"`+un_suspend_url+`", "callback": "unSuspendUserCallback"}' href="#"><i class="la la-edit"></i> {{trans('users.un_suspend_user_account')}}</a>
                                        </div>
                                </span>`;
                        }
                        
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
        users_table = initTable1('{{ route('users.index') }}');

        // Search datatable
        $('#m_search').on('click', function(e) {
            e.preventDefault();
            var query = $('#search_users_form').serialize();
            users_table.destroy();
            users_table = initTable1('{{ route('users.index') }}'+'?'+query);
        });

        // Reset search form
        $('#m_reset').on('click', function(e) {
            e.preventDefault();
            $(this).closest('form').trigger("reset");
            users_table.destroy();
            users_table = initTable1('{{ route('users.index') }}');
        });
    });

    function deleteUserCallback() {
        // Reload datatable with delay
        setTimeout(function() {
            users_table.ajax.reload(function(json) {
                //
            }, false);
        }, 3000);
    }
    function unSuspendUserCallback() {
        // Reload datatable with delay
        setTimeout(function() {
            users_table.ajax.reload(function(json) {
                //
            }, false);
        }, 3000);
    }
</script>