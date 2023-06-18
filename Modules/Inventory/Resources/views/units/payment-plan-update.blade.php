<hr>
<h5>{{ __('inventory::inventory.payment_plans') }}</h5>
<div class="repeater_payment_plans">
    <div data-repeater-list="payment_plans">
        @if (count($i_unit->paymentPlans))
            @foreach ($i_unit->paymentPlans as $payment_plan)
                <div data-repeater-item class="row">
                    <!-- innner repeater -->
                    <input type="hidden" name="payment_plan_id" value="{{$payment_plan->id}}">
                    <div class="col-md-4 col-sm-12">
                        <label for="title">{{__('inventory::inventory.title')}}</label>
                        <input name="title" value="{{$payment_plan->title}}" id="title" type="text" class="form-control" placeholder="{{__('inventory::inventory.title')}}" data-parsley-trigger="change focusout">
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="down_payment">{{ __('inventory::inventory.down_payment') }} %</label>
                        <input name="down_payment" id="down_payment" value="{{ $payment_plan->down_payment }}" type="number"
                            class="form-control" placeholder="{{ __('inventory::inventory.enter_down_payment') }}"
                            data-parsley-trigger="change focusout">
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label>{{ trans('inventory::inventory.delivery_date') }}</label>
                        <input name="delivery_date" autocomplete="off" value="{{ date('Y-m',strtotime($payment_plan->delivery_date)) }}"
                            class="form-control payment_plan_delivery_date"
                            placeholder="{{ trans('inventory::inventory.select_delivery_date') }}"
                            data-parsley-trigger="change focusout" />
                    </div>
                    {{-- <div class="col-md-4 col-sm-12">
                        <label for="years_of_installments">{{__('inventory::inventory.years_of_installments')}}</label>
                        <input name="years_of_installments" id="years_of_installments" value="{{$payment_plan->years_of_installments}}" type="number" step="0.1" class="form-control" placeholder="{{__('inventory::inventory.enter_years_of_installments')}}" data-parsley-trigger="change focusout">
                    </div> --}}
                    <div class="col-md-4 col-sm-12">
                        <label for="installment_amount">{{ __('inventory::inventory.installment_amount') }} <small>{{__('main.per_month')}}</small></label>
                        <input name="installment_amount" id="installment_amount"
                            value="{{ $payment_plan->installment_amount }}" type="number" step="0.1" class="form-control"
                            placeholder="{{ __('inventory::inventory.enter_installment_amount') }}"
                            data-parsley-trigger="change focusout">
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="discount">{{ __('inventory::inventory.discount') }} <small>%</small></label>
                        <input name="discount" id="discount"
                            value="{{ $payment_plan->discount }}" type="number" step="0.1" class="form-control"
                            placeholder="{{ __('inventory::inventory.enter_discount') }}"
                            data-parsley-trigger="change focusout">
                    </div>
                    <div class="col-md-2 col-sm-2 mt-3">
                        <button data-repeater-delete type="button" class="btn btn-brand" value="Delete"><i
                                class="fa fa-times"></i></button>
                    </div>

                </div>
            @endforeach
        @else
            <div data-repeater-item class="row">
                <!-- innner repeater -->
                <div class="col-md-4 col-sm-12">
                    <label for="title">{{__('inventory::inventory.title')}}</label>
                    <input name="title" id="title" type="text" class="form-control" placeholder="{{__('inventory::inventory.title')}}" data-parsley-trigger="change focusout">
                </div>
                <div class="col-md-4 col-sm-12">
                    <label for="down_payment">{{ __('inventory::inventory.down_payment') }} %</label>
                    <input name="down_payment" id="down_payment" type="number" class="form-control"
                        placeholder="{{ __('inventory::inventory.enter_down_payment') }}"
                        data-parsley-trigger="change focusout">
                </div>
                <div class="col-md-4 col-sm-12">
                    <label>{{ trans('inventory::inventory.delivery_date') }}</label>
                    <input name="delivery_date" autocomplete="off" class="form-control payment_plan_delivery_date"
                        placeholder="{{ trans('inventory::inventory.select_delivery_date') }}"
                        data-parsley-trigger="change focusout" />
                </div>
                {{-- <div class="col-md-4 col-sm-12">
                    <label for="years_of_installments">{{__('inventory::inventory.years_of_installments')}}</label>
                    <input name="years_of_installments" id="years_of_installments" type="number" step="0.1" class="form-control" placeholder="{{__('inventory::inventory.enter_years_of_installments')}}" data-parsley-trigger="change focusout">
                </div> --}}
                <div class="col-md-4 col-sm-12">
                    <label for="installment_amount">{{ __('inventory::inventory.installment_amount') }} <small>{{__('main.per_month')}}</small></label>
                    <input name="installment_amount" id="installment_amount" type="number" step="0.1"
                        class="form-control" placeholder="{{ __('inventory::inventory.enter_installment_amount') }}"
                        data-parsley-trigger="change focusout">
                </div>
                <div class="col-md-4 col-sm-12">
                    <label for="discount">{{ __('inventory::inventory.discount') }} <small>%</small></label>
                    <input name="discount" id="discount" type="number" step="0.1"
                        class="form-control" placeholder="{{ __('inventory::inventory.enter_discount') }}"
                        data-parsley-trigger="change focusout">
                </div>
                <div class="col-md-2 col-sm-2 mt-3">
                    <button data-repeater-delete type="button" class="btn btn-brand" value="Delete"><i
                            class="fa fa-times"></i></button>
                </div>

            </div>
        @endif
    </div>
    <button data-repeater-create type="button" class="btn" value="Add"> <i class="fa fa-plus"></i>
        {{ trans('inventory::inventory.add_payment_plan') }}</button>
</div>
