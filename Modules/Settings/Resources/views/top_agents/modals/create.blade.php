@extends('dashboard.layouts.basic')
@section('content')
<style>
    .fade:not(.show) {
        opacity: 1
    }
</style>
<!--begin::Form-->
<form action="{{route('settings.top_agents.store')}}" method="POST" id="create_top_agent_form" enctype="multipart/form-data" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator" data-async data-callback="createTopAgentCallback" data-parsley-validate>
    @csrf
    <div class="m-portlet__body">
        <div class="form-group row">
            <div class="col-12">
                <input type="text" id="users_ids" name="user_id" required data-parsley-required data-parsley-required-message="{{__('settings::settings.agents_are_required')}}" data-parsley-trigger="change focusout" class="form-control" data-role="tagsinput" />
            </div>
            <div class="col-12 repeater">
                <div data-repeater-list="socials">
                    <div data-repeater-item class="row">
                        <div class="form-group row">
                            <div class="col-5 mt-5">
                                <label for="link">{{__('socials::social.social')}}</label>
                                <input name="link" id="link" type="text" class="form-control" placeholder="{{__('socials::social.please_enter_the_social_link')}}" required data-parsley-required data-parsley-required-message="{{__('socials::social.please_enter_the_social_link')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('socials::social.social_max_is_150_characters_long')}}">
                            </div>
                            <div class="col-5 mt-5">
                                <label for="icon">{{__('socials::social.icon')}}</label>
                                <input name="icon" id="icon" type="text" autocomplete="off" class="form-control icon-font" placeholder="{{__('socials::social.please_enter_the_social_icon')}}" required data-parsley-required data-parsley-required-message="{{__('socials::social.please_enter_the_social_icon')}}" data-parsley-trigger="change focusout" data-parsley-maxlength="150" data-parsley-maxlength-message="{{__('socials::social.social_max_is_150_characters_long')}}">
                            </div>
                        </div>

                        <div class="col-md-2 col-sm-2 mt-auto">
                            {{-- <label class="control-label">&nbsp;</label> --}}
                            <a href="javascript:;" data-repeater-delete class="btn btn-brand data-repeater-delete">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <a href="javascript:;" data-repeater-create id="repeater_btn" class="btn">
                    <i class="fa fa-plus"></i> {{trans('socials::social.add_social_translation')}}
                </a>
            </div>
        </div>
    </div>
    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
        <div class="m-form__actions m-form__actions--solid">
            <div class="row">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-success">{{__('main.submit')}}</button>
                    <button type="reset" class="btn btn-secondary">{{__('main.reset')}}</button>
                    {{--
                        <a href="{{route('settings.top_agents.create')}}" data-8xload class="btn btn-brand btn-icon-sm">
                    <i class="flaticon2-plus"></i> {{trans('settings::settings.create_new')}}
                    </a>
                    --}}
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

<!--end::Form-->
@push('scripts')
    <!-- Callback function -->
    <script>
        function createTopAgentCallback() {
            // Reload datatable
            $('#fast_modal').modal('toggle');
            var top_agents_table = $('#top_agents_table').DataTable();
            top_agents_table.ajax.reload(null, false);
        }
    </script>
    <script src="{{URL::asset('8x/assets/js/bootstrap-tagsinput.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('8x/assets/packages/bootstrapValidator/js/bootstrapValidator.js')}}" type="text/javascript"></script>
    <script>
        var elt = $('#users_ids');

        var users = new Bloodhound({
              datumTokenizer: Bloodhound.tokenizers.obj.whitespace('id'),
              queryTokenizer: Bloodhound.tokenizers.whitespace,
              remote: {
                    url: '{!!route("users.tagsinput")!!}' + '?needle=%QUERY%',
                    wildcard: '%QUERY%',                
              }
        });
        users.initialize();

        $('#users_ids').tagsinput({
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
                        name: 'users_ids',
                        itemValue: 'id',
                        displayKey: 'name',
                        source: users.ttAdapter(),
                        templates: {
                            empty: [
                                '<ul class="list-group"><li class="list-group-item">{{trans('settings::settings.nothing_found')}}.</li></ul>'
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
    <script src="{{asset('8x/assets/js/repeater.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $('.repeater').repeater({
            // (Required if there is a nested repeater)
            // Specify the configuration of the nested repeaters.
            // Nested configuration follows the same format as the base configuration,
            // supporting options "defaultValues", "show", "hide", etc.
            // Nested repeaters additionally require a "selector" field.
            repeaters: [{
                // (Required)
                // Specify the jQuery selector for this nested repeater
                selector: '.inner-repeater'
            }],
            show:function(){
                $(this).find('.icon-font').iconpicker('refresh');
                // Showing the item
                $(this).show();
            }
        });
    });
</script>
<script>
    // Initialize select picker for repeated items
    $("#repeater_btn").click(function() {
        setTimeout(function() {
            // $(".selectpicker").selectpicker('refresh');
        }, 100);
    });
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/css/fontawesome-iconpicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/js/fontawesome-iconpicker.min.js"></script>
<script>
    setTimeout(function() {
        $('.icon-font').iconpicker('refresh');
    }, 100);
</script>
@endpush