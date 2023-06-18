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
          // maxTags: 1,
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