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
	clicked_menu.closest('li').addClass('kt-menu__item--here');

});

$(document).on('pjax:beforeSend', function() {
	KTApp.block('#kt_body', {
		opacity: 0.07,
		overlayColor: '#000000',
		state: 'primary'
	});
	$('.kt-menu__item').removeClass("kt-menu__item--here");
});
	
$(document).on('pjax:complete, pjax:end', function() {
	var new_title = $('[data-8xloadtitle]').text();
	$(document).prop('title', new_title + ' | ' + app_name);

	globalFires();
	KTApp.unblock('#kt_body');
});

$(document).on('pjax:end', function() {
    ga('set', 'location', window.location.href);
    ga('send', 'pageview');
});

$(document).on('pjax:popstate', function() {
	globalFires();
	/* Workaround to fix DataTable Bug with pushState */
	var destroyTable = $('.table').DataTable();
	destroyTable.destroy();
});

$(document).on('pjax:error', function(xhr, textStatus, error) {
	console.log('Oops, Something went wrong!');
	KTApp.unblock('#kt_body');
});

/* Global Load Content */
function globalFires()
{
	KTLayout.init();
	KTApp.initTooltips({
		html: true
	});
	KTApp.initPopovers({
		html: true
	});
	$('.bootstrap-select, .kt-selectpicker').selectpicker('refresh');
	$('.selectpicker').selectpicker();
	$('.m-select2').select2();
	datetimepickerInit();
	daterangepickerInit();
	$('[data-switch=true]').bootstrapSwitch();	

	$('.showmap').each(function(){
		var mapDetails = $(this).data('showmap');
		MapHelper.initMap(false, true, true, false, mapDetails);
	});

	if($("div").hasClass("kt-aside--fixed")){
		$('body').addClass('kt-aside--enabled kt-aside--fixed');
	}else{
		$('body').removeClass('kt-aside--enabled kt-aside--fixed');
	}

	$('[data-editable]').editable();
	
	$('[data-scroll="true"]').each(function() {
		var el = $(this);
		KTUtil.scrollInit(this, {
			disableForMobile: true,
			handleWindowResize: true,
			height: function() {
				if (KTUtil.isInResponsiveRange('tablet-and-mobile') && el.data('mobile-height')) {
					return el.data('mobile-height');
				} else {
					return el.data('height');
				}
			}
		});
	});

	applykFormatter();
	load8xChart();
}

document.addEventListener('DOMContentLoaded', function(){
	$(document).ready(function() {

		/* Handle selecting main activity radio button */
		$('.mainActivity').each(function(){
			$('input[type=radio]:first', this).attr('checked', true);
			loadActivityTypeOutcomes($('input[type=radio]:first', this).attr('value'));
		});

		/* Auto Click Trigger on Load */
		$('.autoClickTrigger').each(function(){
			$(this).trigger("click");
		});

		/* Show Map */
		$('.showmap').each(function(){
			var mapDetails = $(this).data('showmap');
			MapHelper.initMap(false, true, true, false, mapDetails);
		});

		$('[data-editable]').editable();

	});
}, false);

$(function() {  
	$('#loadMoreLCSSProfile').appear();
	$(document.body).on('appear', '#loadMoreLCSSProfile', function(e, $affected) {
		console.log('loadMoreLCSSProfile is visable');
	});
	globalFires();

	/* Digital Clock - Cache some selectors */
	function updateTime() {
		$('#clock').html(moment().format("ddd, Do MMMM YY hh:mm A"), function(){
			$('#clock').addClass('animated bounceIn');
		});
	}

	setInterval(updateTime, 1000);
});

