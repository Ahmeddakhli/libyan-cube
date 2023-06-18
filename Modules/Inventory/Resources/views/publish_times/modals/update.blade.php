@extends('dashboard.layouts.basic')
<link rel="stylesheet" href="{{URL::asset('8x/assets/css/upload_button.css')}}" />
<link href="{{asset('8x/assets/vendors/general/select2/dist/css/select2.css')}}" rel="stylesheet" type="text/css" />
@section('content')
    <!--begin::Form-->
    <form action="{{route('inventory.publish_times.update')}}" method="POST" id="update_publish_time_form" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="updatePublishTimeCallback" data-parsley-validate>
        @csrf
        <input type="hidden" name="id" value="{{$i_publish_time->id}}"/>
        <div class="m-portlet__body">
            <!-- Unit -->
            <div class="form-group row">
                <div class="col-12">
                    <label class="col-12 control-label" for="i_unit_id">{{__('inventory::inventory.unit')}}</label>
                    <div class="col-12">
                        <input type="text" id="i_unit_id" name="i_unit_id" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.unit_is_required')}}" data-parsley-trigger="change focusout" class="form-control" data-role="tagsinput"/>
                    </div>
                </div>
            </div>
            <!-- From -->
            <div class="form-group m-form__group row">
                <div class="col-lg-8">
                    <label>{{trans('inventory::inventory.from_date')}}</label>
                    <input name="from" autocomplete="off" class="form-control datetimepicker-init" placeholder="{{trans('inventory::inventory.select_from_date')}}" required data-parsley-required data-parsley-required-message="{{__('inventory::inventory.from_date_is_required')}}" data-parsley-trigger="change focusout" value="{{$i_publish_time->from}}" />
                </div>
            </div>
            <!-- To -->
            <div class="form-group m-form__group row">
                <div class="col-lg-8">
                    <label>{{trans('inventory::inventory.to_date')}} <small class="text-muted"> - {{__('inventory::inventory.optional')}}</small></label>
                    <input name="to" autocomplete="off" class="form-control datetimepicker-init" placeholder="{{trans('inventory::inventory.select_to_date')}}" data-parsley-trigger="change focusout" value="{{$i_publish_time->to}}" />
                </div>
            </div>
        </div>
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-success btn-brand">{{trans('inventory::inventory.update_publish_time')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

<!--end::Form-->

<script src="{{asset('8x/assets/vendors/general/select2/dist/js/select2.full.js')}}" type="text/javascript"></script>
<script>
    $('.m-select2').select2();
</script>
<script>
    $('.datetimepicker-init').datetimepicker("refresh");
</script>
<!-- Callback function -->
<script>
    function updatePublishTimeCallback() {
        // Close modal
        $('#fast_modal').modal('toggle');

        if ((typeof(publish_times_table) !== "undefined")) {
            // Reload datatable if in index page
            publish_times_table.ajax.reload(null, false);
        }
    }
</script>
<script src="{{URL::asset('8x/assets/js/bootstrap-tagsinput.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('8x/assets/packages/bootstrapValidator/js/bootstrapValidator.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('8x/assets/js/upload_button.js')}}" type="text/javascript"></script>

<script>
    var elt = $('#i_unit_id');

    var units = new Bloodhound({
          datumTokenizer: Bloodhound.tokenizers.obj.whitespace('id'),
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          remote: {
                url: '{!!route("inventory.units.tagsinput")!!}' + '?needle=%QUERY%',
                wildcard: '%QUERY%',                
          }
    });
    units.initialize();

    $('#i_unit_id').tagsinput({
          itemValue : 'id',
          itemText  : 'name',
          maxChars: 100,
          maxTags: 1,
          trimValue: true,
          allowDuplicates : false,   
          freeInput: false,
          focusClass: 'form-control',
          tagClass: function(item) {
              if(item.display)
                 return 'kt-badge kt-badge--inline kt-badge--' + item.display;
              else
                  return 'kt-badge kt-badge--inline kt-badge--info';

          },
          onTagExists: function(item, $tag) {
              $tag.hide().fadeIn();
          },
          typeaheadjs: [{
            hint: false,
                    highlight: true
                },
                {
                    name: 'i_unit_id',
                    itemValue: 'id',
                    displayKey: 'name',
                    source: units.ttAdapter(),
                    templates: {
                        empty: [
                            '<ul class="list-group"><li class="list-group-item">{{trans('inventory::inventory.nothing_found')}}.</li></ul>'
                        ],
                        header: [
                            '<ul class="list-group">'
                        ],
                        suggestion: function (data) {
                            return '<li class="list-group-item">' + data.name + '</li>'
                        }
                    }
                }
            ]
    });
</script>
<script>
    // pre-loading unit
    @if ($i_publish_time->unit)
        $('#i_unit_id').tagsinput('add', {"id":"{{$i_publish_time->unit->id}}","name":"{{$i_publish_time->unit->unit_number}}"});  
    @endif
</script>
<script>
    // Re-initialize select pickers
    $(".m_selectpicker").selectpicker("refresh");
</script>