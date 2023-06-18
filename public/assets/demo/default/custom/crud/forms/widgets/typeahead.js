//== Class definition
var Typeahead = function() {
    //== Private functions
    var leads = function() {
        var elt = $('#leads');

        var leads = new Bloodhound({
              datumTokenizer: Bloodhound.tokenizers.obj.whitespace('id'),
              queryTokenizer: Bloodhound.tokenizers.whitespace,
              remote: {
                    url: '{{route("leads.tagsinput")}}' + '?needle=%QUERY%',
                    wildcard: '%QUERY%',                
              }
        });
        leads.initialize();

        $('#leads').tagsinput({
              itemValue : 'id',
              itemText  : 'name',
              maxChars: 10,
              trimValue: true,
              allowDuplicates : false,   
              freeInput: false,
              focusClass: 'form-control',
              tagClass: function(item) {
                  if(item.display)
                     return 'label label-' + item.display;
                  else
                      return 'label label-default';

              },
              onTagExists: function(item, $tag) {
                  $tag.hide().fadeIn();
              },
              typeaheadjs: [{
                hint: false,
                        highlight: true
                    },
                    {
                        name: 'leads',
                        itemValue: 'id',
                        displayKey: 'name',
                        source: leads.ttAdapter(),
                        templates: {
                            empty: [
                                '<ul class="list-group"><li class="list-group-item">Nothing found.</li></ul>'
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
    }

    return {
        // public functions
        init: function() {
            leads();
        }
    };
}();

jQuery(document).ready(function() {
    Typeahead.init();
});