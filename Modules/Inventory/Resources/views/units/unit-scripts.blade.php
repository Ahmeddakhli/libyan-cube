@if ($i_unit->latitude && $i_unit->longitude)
    <script>
        MapHelper.initMap(true, true, true, false, {'lat':'{{$i_unit->latitude}}', 'lng':'{{$i_unit->longitude}}', 'id':'map', 'map_search':'map_search'});
    </script>
@endif

<script>
    function deleteAttachment(id) {
        KTApp.blockPage({overlayColor:"#000000",type:"loader",state:"success",message:"{{trans('main.please_wait')}}"});
        $.ajax({
            url: "{{route('delete.attachmentables')}}",
            type: "POST",
            data: {id: id},
            success: function(response) {
                // UnblockUI
                KTApp.unblockPage();

                // Show notification
                if (response.status) {
                    // Remove attachment div
                    $('#card-'+id).remove();
                } else {
                    showNotification(response.message, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
                }
            },
            error: function(xhr, error_text, statusText) {
                // UnblockUI
                KTApp.unblockPage();

                if (xhr.status == 401) {
                    // Unauthorized
                    if (xhr.responseJSON.error) {                       
                        setTimeout(function() {
                            window.scrollTo({ top: 0, behavior: 'smooth' });
                            showMsg(form, 'danger', xhr.responseJSON.error, true);
                        }, 500);
                        showNotification(xhr.responseJSON.error, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
                    } else {
                        setTimeout(function() {
                            window.scrollTo({ top: 0, behavior: 'smooth' });
                            showMsg(form, 'danger', statusText, true);
                        }, 500);
                        showNotification(statusText, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
                    }
                } else if (xhr.status == 422) {
                    // HTTP_UNPROCESSABLE_ENTITY
                    if (xhr.responseJSON.errors) {
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                        $.each(xhr.responseJSON.errors, function(index, error) {
                            setTimeout(function() {
                                if (index === 0) {
                                    var remove_previous_alerts = true;
                                } else {
                                    var remove_previous_alerts = false;
                                }
                                showMsg(form, 'danger', error.message, remove_previous_alerts);
                            }, 500);
                            showNotification(error.message, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
                        });
                    } else {
                        setTimeout(function() {
                            window.scrollTo({ top: 0, behavior: 'smooth' });
                            showMsg(form, 'danger', statusText, true);
                        }, 500);
                        showNotification(statusText, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
                    }
                } else if (xhr.status == 500) {
                    // Internal Server Error
                    var error = xhr.responseJSON.message;
                    if (xhr.responseJSON.error) {                       
                        setTimeout(function() {
                            window.scrollTo({ top: 0, behavior: 'smooth' });
                            showMsg(form, 'danger', xhr.responseJSON.error, true);
                        }, 500);
                        showNotification(xhr.responseJSON.error, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
                    } else {
                        setTimeout(function() {
                            window.scrollTo({ top: 0, behavior: 'smooth' });
                            showMsg(form, 'danger', statusText, true);
                        }, 500);
                        showNotification(statusText, "{{trans('main.error')}}", 'la la-warning', null, 'danger', true, true, true);
                    }
                }
            }
        });
    }
</script>

<!-- Rental Cases -->
<script>
    function initTableRentalCases(url) {
        var table = $('#rental_cases_table');
        return table.DataTable({
            order: [0, 'desc'],
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
            "pageLength": 5,
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
                {data: 'id', visible: false, orderable: false, searchable: true},
                {data: 'renter.full_name', visible: true, orderable: true, searchable: true},
                {data: 'from', visible: true, orderable: true, searchable: true},
                {data: 'to', visible: true, orderable: true, searchable: true},
                {data: 'price', visible: true, orderable: true, searchable: true},
                // {data: 'created_at', visible: true, orderable: true, searchable: true},
                // {data: 'created_by', visible: true, orderable: false, searchable: false},
                {data: 'last_updated_at', visible: true, orderable: true, searchable: true},
                {data: 'last_updated_by', visible: true, orderable: false, searchable: false},
            ],
            columnDefs: [
                {
                    targets: 0,
                    title: '{{trans('inventory::inventory.id')}}',
                    render: function(data, type, full, meta) {
                        return full.id;       
                    },
                },
                {
                    targets: 1,
                    title: '{{trans('inventory::inventory.renter')}}',
                    render: function(data, type, full, meta) {
                        return `<div class="kt-widget5">
                                    <div class="kt-widget5__item kt-margin-b-0 kt-padding-b-0">
                                        <div class="kt-widget5__content">
                                            <div class="kt-widget5__section">
                                                <a href="`+full.renter_url+`" data-8xload class="kt-widget5__title kt-font-info">
                                                    <span class="kt-font-bolder">`+data+`</span><span class="text-muted kt-margin-l-5">`+`</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="kt-widget5__content">
                                            <div class="kt-widget5__stats">`+``+`</div>
                                            <div class="kt-widget5__stats">`+``+`</div>
                                        </div>
                                    </div>
                                </div>`;
                    },
                },
                {
                    targets: 2,
                    title: '{{trans('inventory::inventory.from')}}',
                    render: function(data, type, full, meta) {
                        return data;
                    },
                },
                {
                    targets: 3,
                    title: '{{trans('inventory::inventory.to')}}',
                    render: function(data, type, full, meta) {
                        return data;
                    },
                },
                {
                    targets: 4,
                    title: '{{trans('inventory::inventory.price')}}',
                    render: function(data, type, full, meta) {
                        return data;
                    },
                },
                // {
                //     targets: 5,
                //     title: '{{trans('inventory::inventory.created_at')}}',
                //     render: function(data, type, full, meta) {
                //         return data;
                //     },
                // },
                // {
                //     targets: 6,
                //     title: '{{trans('inventory::inventory.created_by')}}',
                //     render: function(data, type, full, meta) {
                //         return data;
                //     },
                // },
                {
                    targets: 5,
                    title: '{{trans('inventory::inventory.last_updated_at')}}',
                    render: function(data, type, full, meta) {
                        return data;
                    },
                },
                {
                    targets: 6,
                    title: '{{trans('inventory::inventory.last_updated_by')}}',
                    render: function(data, type, full, meta) {
                        return data;
                    },
                },
                {
                    targets: 7,
                    title: '{{trans('inventory::inventory.actions')}}',
                    render: function(data, type, full, meta) {
                        console.log(full, full.id);
                        var delete_url = '{{route("inventory.rental_cases.delete", "id=:id")}}';
                        var update_url = '{{route('inventory.rental_cases.modals.update')}}';
                        delete_url = delete_url.replace(':id', full.id);

                        @if (auth()->user()->hasPermission('update-inventory-rental-case') || auth()->user()->hasPermission('delete-inventory-rental-case'))
                            var value = `
                            <span class="dropdown">
                                <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                                    <i class="la la-ellipsis-h"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                            `;
                            @if (auth()->user()->hasPermission('update-inventory-rental-case'))
                                value += `
                                        <a href="`+update_url+`" class="dropdown-item" data-toggle="modal" data-target="#fast_modal" data-path="`+update_url+`" data-title="{{trans('inventory::inventory.update_rental_case')}}" data-id="`+full.id+`" data-modal-load>
                                            <span>
                                                <i class="la la-edit"></i>
                                                <span>{{trans('inventory::inventory.update_rental_case')}}</span>
                                            </span>
                                        </a>
                                `;
                            @endif
                            @if (auth()->user()->hasPermission('delete-inventory-rental-case'))
                                value += `
                                        <a class="dropdown-item" data-8x-delete-it='{"container":false, "path":"`+delete_url+`", "callback": "deleteRentalCaseCallback"}' href="#"><i class="la la-trash"></i> {{__('inventory::inventory.delete_rental_case')}}</a>
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
                },
            ],
        });
    };
    jQuery(document).ready(function() {
        // Init datatable
        rental_cases_table = initTableRentalCases('{{ route('inventory.rental_cases.index') }}?i_unit_ids[]={{$i_unit->id}}');
    });

    function deleteRentalCaseCallback() {
        // Reload datatable with delay
        setTimeout(function() {
            rental_cases_table.ajax.reload(function(json) {
                //
            }, false);
        }, 3000);
    }

</script>
<!-- Publish Times -->
<script>
    function initTablePublishTimes(url) {
        var table = $('#publish_times_table');
        return table.DataTable({
            order: [0, 'desc'],
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
            "pageLength": 5,
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
                {data: 'id', visible: false, orderable: false, searchable: false},
                {data: 'from', visible: true, orderable: true, searchable: true},
                {data: 'to', visible: true, orderable: true, searchable: true},
                {data: 'creator.full_name', visible: true, orderable: false, searchable: true},
                {data: 'created_at', visible: true, orderable: true, searchable: true},
            ],
            columnDefs: [
                {
                    targets: 0,
                    title: '{{trans('inventory::inventory.id')}}',
                    render: function(data, type, full, meta) {
                        return full.id;       
                    },
                },
                {
                    targets: 1,
                    title: '{{trans('inventory::inventory.from')}}',
                    render: function(data, type, full, meta) {
                        return data;
                    },
                },
                {
                    targets: 2,
                    title: '{{trans('inventory::inventory.to')}}',
                    render: function(data, type, full, meta) {
                        return data;
                    },
                },
                {
                    targets: 3,
                    title: '{{trans('inventory::inventory.publisher')}}',
                    render: function(data, type, full, meta) {
                        return data;
                    },
                },
                {
                    targets: 4,
                    title: '{{trans('inventory::inventory.created_at')}}',
                    render: function(data, type, full, meta) {
                        return data;
                    },
                },
                {
                    targets: 5,
                    title: '{{trans('inventory::inventory.actions')}}',
                    render: function(data, type, full, meta) {
                        var delete_url = '{{route("inventory.publish_times.delete", "id=:id")}}';
                        var update_url = '{{route('inventory.publish_times.modals.update')}}';
                        delete_url = delete_url.replace(':id', full.id);

                        @if (auth()->user()->hasPermission('update-inventory-publish-time') || auth()->user()->hasPermission('delete-inventory-publish-time'))
                            var value = `
                            <span class="dropdown">
                                <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                                    <i class="la la-ellipsis-h"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                            `;
                            @if (auth()->user()->hasPermission('update-inventory-publish-time'))
                                value += `
                                        <a href="`+update_url+`" class="dropdown-item" data-toggle="modal" data-target="#fast_modal" data-path="`+update_url+`" data-title="{{trans('inventory::inventory.update_publish_time')}}" data-id="`+full.id+`" data-modal-load>
                                            <span>
                                                <i class="la la-edit"></i>
                                                <span>{{trans('inventory::inventory.update_publish_time')}}</span>
                                            </span>
                                        </a>
                                `;
                            @endif
                            @if (auth()->user()->hasPermission('delete-inventory-publish-time'))
                                value += `
                                        <a class="dropdown-item" data-8x-delete-it='{"container":false, "path":"`+delete_url+`", "callback": "deletePublishTimeCallback"}' href="#"><i class="la la-trash"></i> {{__('inventory::inventory.delete_publish_time')}}</a>
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
                },
            ],
        });
    };
    jQuery(document).ready(function() {
        // Init datatable
        publish_times_table = initTablePublishTimes('{{ route('inventory.publish_times.index') }}?i_unit_ids[]={{$i_unit->id}}');
    });

    function deletePublishTimeCallback() {
        // Reload datatable with delay
        setTimeout(function() {
            publish_times_table.ajax.reload(function(json) {
                //
            }, false);
        }, 3000);
    }

</script>