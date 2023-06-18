@section('title', trans('blog::blog.blog_categories'))

@include('dashboard.components.fast_modal')
@include('dashboard.styles.custom')

<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

    <!-- begin:: Content -->
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <!-- begin:: Content -->
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand fa fa-list"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            <span data-8xloadtitle>{{trans('blog::blog.blog_categories')}}</span>
                            <small>{{trans('blog::blog.list')}}</small>
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            {{--
                            <!-- Full creation form -->
                            <a href="{{route('blogs.create')}}" data-8xload class="btn btn-brand btn-icon-sm">
                            <i class="flaticon2-plus"></i> {{trans('blog::blog.create_new')}}
                            </a>
                            --}}
                            @if (auth()->user()->hasPermission('create-blog-category'))
                            <a href="{{route('blog.categories.create')}}" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#fast_modal" data-path="{{route('blog.categories.modals.create')}}" data-title="{{trans('blog::blog.create_blog_category')}}" data-modal-load>
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>{{trans('blog::blog.create_blog_category')}}</span>
                                </span>
                            </a>
                            @endif

                        </div>
                    </div>
                </div>

                <div class="kt-portlet__body">


                    <!--begin: Datatable -->
                    <table class="table table-striped- table-bordered table-hover table-checkable datatable" id="blog_categories_table">
                        <thead>
                            <tr>
                                <th>{{__('blog::blog.id')}}</th>
                                <th>{{__('blog::blog.blog_category')}}</th>
                                <th>{{__('blog::blog.created_at')}}</th>
                                <th>{{__('blog::blog.last_updated_at')}}</th>
                                <th>{{__('blog::blog.actions')}}</th>
                            </tr>
                        </thead>
                    </table>
                    <!--end: Datatable -->
                </div>
            </div>
        </div>

        <!-- end:: Content -->
    </div>
    <!-- end:: Content -->
</div>