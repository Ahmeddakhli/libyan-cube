$(document).on('click', '[data-8xload]', function (e){
    e.preventDefault();

	var clicked_menu = $(this);
	var path = clicked_menu.attr('href');

    // does current browser support PJAX
    if ($.support.pjax) {
        $.pjax.defaults.timeout = 5000; // time in milliseconds - to handle timeout error
        $.pjax.defaults.maxCacheLength = 0; // Disable pjax caching
        $.pjax({
            // type: 'POST',
            url: path,
            container: '#kt_body',
            // push: true
        });
    } else {
    	// Normal redirect
    	window.location.href = path;
    }
	globalFires();
});

$(document).on('pjax:beforeSend', function() {
	//
});
	
$(document).on('pjax:complete, pjax:end', function() {
	var new_title = $('[data-8xloadtitle]').text();

	$(document).prop('title', new_title);

	globalFires();
});

$(document).on('pjax:end', function() {
    //
});

$(document).on('pjax:popstate', function() {
	globalFires();
});

$(document).on('pjax:error', function(xhr, textStatus, error) {
	console.log('Oops, Something went wrong!');
});

/* Global Load Content */
function globalFires()
{
    // SELECT PICKER PLUGIN INIT

    $('.dropdown-select').selectpicker({

        // text for none selected
        noneSelectedText: 'Nothing selected',

        // shows icons
        showIcon: true,

        // shows content
        showContent: true,

        // auto reposition to fit screen
        dropupAuto: true,

        // adds a header to the dropdown select
        header: false,

        // live filter options
        liveSearch: true,
        liveSearchPlaceholder: 'Search',
        liveSearchNormalize: false,
        liveSearchStyle: 'contains',

        // shows Select All & Deselect All
        actionsBox: true,

        // Set the character displayed in the button that separates selected options
        // multipleSeparator: ',',

        selectedTextFormat: 'count > 2',

        // text on the button that deselects all options
        // deselectAllText: '',

        // text on the button that selects all options
        // selectAllText: ''

        // custom template
        // template: {
        // caret: '<span class="caret"></span>'
        // },

    });

    // SELECT 2 STUFF

    $('#global-search').select2({
        placeholder: "Search by location or building",
        width: "100%",
        allowClear: false,
        maximumSelectionLength: 3,
        multiple: true,
        closeOnSelect: true,
    });
    $('#must-have').select2({
        placeholder: "{{__('main.include')}}",
        width: "100%",
        allowClear: false,
        maximumSelectionLength: 3,
        multiple: true,
        closeOnSelect: true,
    });
    $('#dont-have').select2({
        placeholder: "{{__('main.exclude')}}",
        width: "100%",
        allowClear: false,
        maximumSelectionLength: 3,
        multiple: true,
        closeOnSelect: true,
    });
    $('#loc').select2({
        width: "100%",
        allowClear: false,
        maximumSelectionLength: 3,
        closeOnSelect: true,
    });
    $('#select-type').select2({
        placeholder: "{{__('inventory::inventory.offering_type')}}",
        width: "100%",
        multiple: true,
        allowClear: false,
        maximumSelectionLength: 3,
        closeOnSelect: true,
    });

    // Slick Sliders
	for (let slider in allSliders) {
	  if (allSliders.hasOwnProperty(slider)) {
	    // if($(slider).length == 0) {
	      $(slider).slick('unslick').slick(allSliders[slider])
	    // }
	  }
	}
}
