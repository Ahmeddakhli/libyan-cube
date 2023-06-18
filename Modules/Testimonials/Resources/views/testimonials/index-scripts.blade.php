<script>
    $('body').addClass('kt-aside--enabled kt-aside--fixed');
</script>
<script>
    function initTable1(url) {
        
        var table = $('#testimonials_table');

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
                    data: 'name',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'value',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'created_at',
                    orderable: true,
                    searchable: true,

                },
                {
                    data: 'last_updated_at',
                    orderable: true,
                    searchable: true
                },
            ],
            columnDefs: [{
                    targets: 0,
                    title: "{{trans('testimonials::testimonial.id')}}",
                    render: function(data, type, full, meta) {
                        return full.id;
                    },
                },
                {
                    targets: 1,
                    title: "{{trans('testimonials::testimonial.name')}}",
                    render: function(data, type, full, meta) {
                        return full.name;
                    },
                },
                {
                    targets: 2,
                    title: "{{trans('testimonials::testimonial.testimonial')}}",
                    render: function(data, type, full, meta) {
                        return full.value;
                    },
                },
                {
                    targets: 3,
                    title: "{{trans('testimonials::testimonial.created_at')}}",
                    render: function(data, type, full, meta) {
                        return full.created_at;
                    },
                },
                {
                    targets: 4,
                    title: "{{trans('testimonials::testimonial.last_updated_at')}}",
                    render: function(data, type, full, meta) {
                        return full.last_updated_at;
                    },
                },
                {
                    targets: 5,
                    title: "{{trans('testimonials::testimonial.actions')}}",
                    orderable: false,
                    render: function(data, type, full, meta) {
                        var delete_url = "{{route('testimonials.delete', 'id=:id')}}";
                        delete_url = delete_url.replace(':id', full.id);

                        @if(auth()->user()->hasPermission('update-testimonial') || auth()->user()->hasPermission('delete-testimonial'))
                            var value = `
                                <span class="dropdown">
                                    <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                                        <i class="la la-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                `;
                            @if(auth()->user()->hasPermission('update-testimonial'))
                                value += `
                                            <a href="{{route('testimonials.modals.update')}}" class="dropdown-item" data-toggle="modal" data-target="#fast_modal" data-path="{{route('testimonials.modals.update')}}" data-title="{{trans('testimonials::testimonial.update_testimonial')}}" data-id="` + full.id + `" data-modal-load>
                                                <span>
                                                    <i class="la la-edit"></i>
                                                    <span>{{trans('testimonials::testimonial.update_testimonial')}}</span>
                                                </span>
                                            </a>
                                        `;
                            @endif
                            @if(auth()->user()->hasPermission('delete-testimonial'))
                                value += `
                                            <a class="dropdown-item" data-8x-delete-it='{"container":false, "path":"` + delete_url + `", "callback": "deleteTestimonialCallback"}' href="#"><i class="la la-trash"></i> {{__('testimonials::testimonial.delete_testimonial')}}</a>
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
        testimonials_table = initTable1("{{ route('testimonials.index') }}");

        // Search datatable
        $('#m_search').on('click', function(e) {
            e.preventDefault();
            var query = $('#search_testimonials_form').serialize();
            $("#testimonials_table").dataTable().fnDestroy();
            testimonials_table = initTable1("{{ route('testimonials.index') }}" + '?' + query);
        });

        // Reset search form
        $('#m_reset').on('click', function(e) {
            e.preventDefault();
            $(this).closest('form').trigger("reset");
            $("#testimonials_table").dataTable().fnDestroy();
            testimonials_table = initTable1("{{ route('testimonials.index') }}");
        });
    });
</script>
<script>
    function deleteTestimonialCallback() {
        // Reload datatable with delay to clear cache
        setTimeout(function() {
            testimonials_table.ajax.reload(function(json) {
                //
            }, false);
        }, 3000);
    }
</script>
