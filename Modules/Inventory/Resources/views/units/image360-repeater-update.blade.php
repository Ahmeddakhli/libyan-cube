<div class="repeater-images-360 form-group col-12">
    <div class="form-group col-12">
        <h4 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{__('inventory::inventory.image_360')}}:</h4>
    </div>
    <div data-repeater-list="images">
        @if(count($i_unit->images) > 0)
        @foreach($i_unit->images as $image)
        <div data-repeater-item>
            <!-- innner repeater -->
            <input type="hidden" name="i_unit_image_id" value="{{$image->id}}">
            <div class="inner-repeater">
                <div data-repeater-list="translations">
                    @foreach($image->translations as $translation)
                    <div data-repeater-item>
                        <div class="form-group col-12">
                            <div class="col-lg-12">
                                <label for="language_id">{{__('inventory::inventory.language')}}</label>
                                <select class="form-control" id="language_id" name="language_id" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_select_the_language')}}" data-parsley-trigger="change focusout">
                                    <option value="" selected disabled>{{__('inventory::inventory.language')}}</option>
                                    @foreach ($languages as $language)
                                    <option value="{{$language->id}}" @if($translation->language_id == $language->id) selected @endif>{{$language->code}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <label for="title">{{__('inventory::inventory.title')}}</label>
                                <input name="title" value="{{$translation->title}}" id="title" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_title')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.please_enter_the_title')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.title_max_is_150_characters_long')}}">
                            </div>
                            <button data-repeater-delete type="button" class="btn btn-brand data-repeater-delete" value="Delete"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button data-repeater-create type="button" class="btn" value="Add"> <i class="fa fa-plus"></i> {{trans('inventory::inventory.add_image_360_trans')}}</button>
            </div>
            <div class="col-lg-12 w-100">
                <label for="link">{{__('inventory::inventory.link')}}</label>
                <input name="link" value="{{$image->link}}" id="link" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_link')}}" data-parsley-required-message="{{__('inventory::inventory.please_enter_the_link')}}" data-parsley-trigger="change focusout">
            </div>
            <div class="col-md-2 col-sm-2">
                <button data-repeater-delete type="button" class="btn btn-brand data-repeater-delete" value="Delete"><i class="fa fa-times"></i></button>
            </div>
        </div>
        @endforeach
        @else
        <div data-repeater-item>
            <!-- innner repeater -->
            <div class="inner-repeater">
                <div data-repeater-list="translations">
                    <div data-repeater-item>
                        <div class="form-group col-12">
                            <div class="col-lg-12">
                                <label for="language_id">{{__('inventory::inventory.language')}}</label>
                                <select class="form-control" id="language_id" name="language_id" data-parsley-trigger="change focusout">
                                    <option value="" selected disabled>{{__('inventory::inventory.language')}}</option>
                                    @foreach ($languages as $language)
                                    <option value="{{$language->id}}" @if($language->id == 1) selected @endif>{{$language->code}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <label for="title">{{__('inventory::inventory.title')}}</label>
                                <input name="title" value="" id="title" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_title')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('inventory::inventory.title_max_is_150_characters_long')}}">
                            </div>
                            <button data-repeater-delete type="button" class="btn btn-brand data-repeater-delete" value="Delete"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                </div>
                <button data-repeater-create type="button" class="btn" value="Add"> <i class="fa fa-plus"></i> {{trans('inventory::inventory.add_image_360_trans')}}</button>
            </div>
            <div class="col-lg-12 w-100">
                <label for="link">{{__('inventory::inventory.link')}}</label>
                <input name="link" value="" id="link" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_link')}}" data-parsley-required-message="{{__('inventory::inventory.please_enter_the_link')}}" data-parsley-trigger="change focusout">
            </div>
            <div class="col-md-2 col-sm-2">
                <button data-repeater-delete type="button" class="btn btn-brand data-repeater-delete" value="Delete"><i class="fa fa-times"></i></button>
            </div>
        </div>
        @endif
    </div>
    <button data-repeater-create type="button" class="btn" value="Add"> <i class="fa fa-plus"></i> {{trans('inventory::inventory.image_360')}}</button>
</div>