@section('title', trans('key_words::key_words.key_words'))

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
                            <span data-8xloadtitle>{{trans('key_words::key_words.key_words')}}</span>
                            <small>{{trans('key_words::key_words.list')}}</small>
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">

                            @if (auth()->user()->hasPermission('create-key-word'))
                            <a href="{{route('key_words.create')}}"  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#fast_modal" data-path="{{route('key_words.modals.create')}}" data-title="{{trans('key_words::key_words.create_key_word')}}" data-modal-load>
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>{{trans('key_words::key_words.create_key_word')}}</span>
                                </span>
                            </a>
                            
                            @endif

                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <!--begin: Datatable -->
                    <table class="table table-striped- table-bordered table-hover table-checkable datatable" id="key_words_table">
                        <thead>
                            <tr>
                                <th>{{__('key_words::key_words.id')}}</th>
                                <th>{{__('key_words::key_words.key_word')}}</th>
                                <th>{{__('key_words::key_words.created_at')}}</th>
                                <th>{{__('key_words::key_words.last_updated_at')}}</th>
                                <th>{{__('key_words::key_words.actions')}}</th>
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