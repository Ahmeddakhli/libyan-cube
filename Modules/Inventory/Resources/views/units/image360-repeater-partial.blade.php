<div class="repeater-images-360 form-group col-12">
    <div class="form-group col-12">
        <h4 class="kt-section__title kt-section__title-lg kt-margin-b-0">{{__('inventory::inventory.image_360')}}:</h4>
    </div>
    <div data-repeater-list="images">
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
                            <button data-repeater-delete type="button" class="btn btn-brand data-repeater-delete my-3" value="Delete"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                </div>
                <button data-repeater-create type="button" class="btn" value="Add"> <i class="fa fa-plus"></i> {{trans('inventory::inventory.add_image_360_trans')}}</button>
            </div>
            <div class="col-6">
                <label for="link">{{__('inventory::inventory.link')}}</label>
                <input name="link" value="" id="link" type="text" class="form-control" placeholder="{{__('inventory::inventory.please_enter_the_link')}}" data-parsley-required-message="{{__('inventory::inventory.please_enter_the_link')}}" data-parsley-trigger="change focusout">
            </div>
            <div class="col-md-2 col-sm-2">
                <button data-repeater-delete type="button" class="btn btn-brand data-repeater-delete my-3 " value="Delete"><i class="fa fa-times"></i></button>
            </div>
        </div>
    </div>
    <button data-repeater-create type="button" class="btn" value="Add"> <i class="fa fa-plus"></i> {{trans('inventory::inventory.image_360')}}</button>
</div>