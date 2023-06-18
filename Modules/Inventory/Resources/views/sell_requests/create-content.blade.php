<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title" data-8xloadtitle>{{__('inventory::inventory.'.'create_sell_request')}}</h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="{{route('home')}}" class="kt-subheader__breadcrumbs-home"><i class="fa fa-home"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>

                <a href="{{route('inventory.sell_requests.index')}}" data-8xload class="kt-subheader__breadcrumbs-link">{{trans('inventory::inventory.sell_requests')}}</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>

                <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">{{__('inventory::inventory.create_sell_request')}}</span>
            </div>
        </div>
    </div>
    <!-- end:: Subheader -->

    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Portlet-->
                <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">{{__('inventory::inventory.create_sell_request')}}</h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a href="{{url()->previous()}}" data-8xload class="btn btn-clean kt-margin-r-10">
                                <i class="la la-arrow-left"></i>
                                <span class="kt-hidden-mobile">{{__('main.back')}}</span>
                            </a>
                        </div>
                    </div>


                    <div class="kt-portlet__body">
                        <!-- Create LCC Form -->
                        <form action="{{route('inventory.sell_requests.store')}}" data-async data-reset="true" data-set-autofocus method="POST" id="create_sell_request_form" class="kt-form" data-parsley-validate>
                            @csrf
                            <div class="row">
                                <div class="col-xl-2"></div>
                                <div class="col-xl-10">
                                    <div class="kt-section kt-section--first">
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label for="compound">{{__('inventory::inventory.compound')}}</label>
                                                <input name="compound" id="compound" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_compound')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_enter_the_compound')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.title_max_is_150_characters_long')}}">
                                            </div>
                                            <!-- Purpose -->
                                            <div class="col-4">
                                                <label for="i_purpose_id">{{__('inventory::inventory.purpose')}}</label>
                                                <select class="form-control selectpicker" data-live-search="true" id="i_purpose_id" name="i_purpose_id" data-parsley-trigger="change focusout" onchange="getPurposePurposeTypes([$(this).find(':selected').val()])" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_select_the_purpose')}}">
                                                    <option value="" selected disabled>{{__('inventory::inventory.select_purpose')}}</option>
                                                    @foreach ($purposes as $purpose)
                                                    <option value="{{$purpose->id}}">{{$purpose->purpose}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Purpose Type -->
                                            <div class="col-4">
                                                <label for="i_purpose_type_id">{{__('inventory::inventory.purpose_type')}}</label>
                                                <select class="form-control selectpicker" data-live-search="true" id="i_purpose_type_id" name="i_purpose_type_id" data-parsley-trigger="change focusout" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_select_the_purpose_type')}}">
                                                    <option value="" selected disabled>{{__('inventory::inventory.select_purpose_type')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label for="unit_name">{{__('inventory::inventory.unit_name')}}</label>
                                                <input name="unit_name" id="unit_name" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_unit_name')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_enter_the_unit_name')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.title_max_is_150_characters_long')}}">
                                            </div>
                                            <div class="col-6">
                                                <label for="comments">{{__('inventory::inventory.comments')}}</label>
                                                <input name="comments" id="comments" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_comments')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_enter_the_comments')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.title_max_is_150_characters_long')}}">
                                            </div>
                                            <div class="col-6">
                                                <label for="name">{{__('inventory::inventory.name')}}</label>
                                                <input name="name" id="name" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_name')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_enter_the_name')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.title_max_is_150_characters_long')}}">
                                            </div>
                                            <div class="col-6">
                                                <label for="email">{{__('inventory::inventory.email')}}</label>
                                                <input name="email" id="email" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_email')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.title_max_is_150_characters_long')}}">
                                            </div>
                                            <div class="col-6">
                                                <label for="phone">{{__('inventory::inventory.phone')}}</label>
                                                <input name="phone" id="phone" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_phone')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_enter_the_phone')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.title_max_is_150_characters_long')}}">
                                            </div>
                                            <div class="col-6">
                                                <label for="comments">{{__('inventory::inventory.comments')}}</label>
                                                <textarea name="comments" id="comments" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_comments')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="4294967295" data-parsley-maxlength-message="{{__('inventory::inventory.comments_max_is_4294967295_characters_long')}}"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                {{-- <div class="form-group">
                                                        <h4 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{__('inventory::inventory.unit_attachments')}}:</h4>
                                            </div> --}}
                                            <div class="row">
                                                <div class="box">
                                                    <label for="description">{{__('inventory::inventory.attachments')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                                                    <input type="file" name="attachments[]" class="inputfile inputfile-5" id="file-6" multilpe />
                                                    <label for="file-6">
                                                        <figure>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                                                                <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" />
                                                            </svg>
                                                        </figure>
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end:: Content -->

</div>