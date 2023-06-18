/* - - - - - ---- 8 W O R X ---- - - - - -
------ G l o b a l  F u n c t i o n s ------ */


/* Refine Original Functions */
/* create a reference to the old `.html()` function */
var htmlOriginal = $.fn.html;

/* refine the `.html()` function to accept a callback */
$.fn.html = function(html,callback){
    /* run the old `.html()` function with the first parameter */
    var ret = htmlOriginal.apply(this, arguments);
    /* run the callback (if it is defined) */
    if(typeof callback == "function"){
        callback();
    }
    /* make sure chaining is not broken */
    return ret;
}

var isMobile = false; //initiate as false
// device detection
if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
    isMobile = true;
}

$(document).ready(function(){

    /* eightx tab */
    $(document).on('click', 'div.eightx-tab-menu>div.list-group>a', function (e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.eightx-tab>div.eightx-tab-content").removeClass("active");
        $("div.eightx-tab>div.eightx-tab-content").eq(index).addClass("active");

        var find_element = $(".lead-profile-qv");
        if ($(find_element).length > 0) {    
            $([document.documentElement, document.body]).animate({
                scrollTop: $(find_element).offset().top
            }, 'slow');
        }
    });

    /* Toggle It */
    $(document).on('click', '[data-toggleit]', function (e) {
        e.preventDefault();
        var target = $(this).data('toggleit');
        $(target).toggle( "fast", function() {
            /* Animation complete. */
            globalFires();
        });
    });

    /* Push It */
    $(document).on('click', '[data-push-it]', function (e) {
        e.preventDefault();
        var data = $(this).data('push-it');
        var target = data.target;
        var type = data.type;
        var html = data.html;
        if(type == 'html'){
            $(target).html(html);
        }
    });

    /* Hide Me */
    $(document).on('click', '[data-hideme]', function (){
        $(this).fadeOut();
    });

    


    /* Set as Active */
    $(document).on('click', '.set-as-active a', function (e){
        e.preventDefault();
        var clicked = $(this);
        clicked.closest('.set-as-active').find('a').removeClass('active');
        clicked.addClass('active');
    });

    /* Set AutoFocus for first input */
    $('[data-set-autofocus]').find('*').filter(':input[type=text]:visible:first').focus();

    $('[data-8xload-it-here]').each(function() {
        var requester = $(this);
        var path = requester.data('path');
        loadItHandler(requester, path, requester);
    });

    /* Chcek if element has html -> Show Section */
    $('[data-if-content-not-empty-show]').each(function() {
        var requester = $(this);
        var hide_ele = requester.data('if-content-not-empty-show');
        if($(requester).html().trim().length){
            $(hide_ele).removeClass('hidden');
        }
    });
    
    /* 8X Load It In */
    $(document).on('click', '[data-8xload-it-in-href]', function (e){
        e.preventDefault();
        var requester = $(this);
        var path = requester.attr('href');
        var target = requester.data('8xload-it-in-href');
        loadItHandler(requester, path, target);
    });

    /* 8X Load It In */
    $(document).on('click', '[data-8xload-it-in]', function (e){
        e.preventDefault();
        var requester = $(this);
        var path = requester.data('path');
        var target = requester.data('8xload-it-in');
        loadItHandler(requester, path, target);
    });

    /* Fast Modal */
    $(document).on('click', '[data-modal-load]', function (e){

        var path = $(this).attr('data-path');
        var title = $(this).attr('data-title');
        var id = $(this).attr('data-id');

        if (id) {
            path = path + '/' + id;
        }
        $.get(path, function( data ){
            if($('#fast_modal').hasClass('show')){
                /* Fast Modal */
                $('#fast_modal .modal-body').html(data);
                $('#fast_modal .modal-header .modal-title').html(title);
            }else if($('#vcxl_modal').hasClass('show')){
                $('#vcxl_modal .modal-body').html(data);
                $('#vcxl_modal .modal-header .modal-title').html(title);
            }else{
                /* Full Modal */
                $('#full_modal .modal-body').html(data);
                $('#full_modal .modal-header .modal-title').html(title);
                $('#fast_modal .modal-body, #full_modal .modal-body,  #vcxl_modal .modal-body').html(data);
                $('#fast_modal .modal-header .modal-title, #full_modal .modal-header .modal-title, #vcxl_modal .modal-header .modal-title').html(title);
            }

        }).done(function(){
            KTApp.unblock("#fast_modal .modal-content, #full_modal .modal-content, #vcxl_modal .modal-content");
        });

        $('#fast_modal, #full_modal, vcxl_modal').on('shown.bs.modal', function(e){
            // Focus on first input
            $('input:text:visible:first', this).focus();
            // Initialize selectpicker
            setTimeout(
            function() 
            {
                $('.m_selectpicker').selectpicker('refresh');
                $('form').parsley();
                $('.datetimepicker-init').datetimepicker({
                    todayHighlight: true,
                    autoclose: true,
                    format: 'yyyy-mm-dd hh:ii',
                    templates: {
                        leftArrow: '<i class="la la-angle-left"></i>',
                        rightArrow: '<i class="la la-angle-right"></i>',
                    },
                });
            }, 2000);
        });
        $('#fast_modal, #full_modal, #vcxl_modal').on('hidden.bs.modal', function(){
            $(this).removeData(); // Empty modal data
            $('#fast_modal .modal-body, #full_modal .modal-body,  #vcxl_modal .modal-body').html('<div class="mid-gray-text-msg kt-spinner kt-spinner--primary kt-spinner--center kt-spinner--lg"></div>');
            $('#fast_modal .modal-header .modal-title, #full_modal .modal-header .modal-title, #vcxl_modal .modal-header .modal-title').html('');
            var originalModal = $(this).clone(); // Clone the modal
            $(this).remove(); // Remove the modal
            $('body').append(originalModal); // Append the modal to the body
        });
    });

    /* Autocomplete for First and Last name */
    $(document).on('keyup','#first_name, #last_name', function(){
        $('#full_name').val($('#first_name').val()+' '+$('#last_name').val());
    });

    /* Refresh Page After XX */
    function refreshPageAfter(secondsCount){
        var seconds = secondsCount * 1000;
        setTimeout(function(){
            location.reload();
        }, seconds);
    }

    /* Handle Single Async */
    $(document).on('click', '[data-8x-single-async]', function (e){
        e.preventDefault();
        var clicked_item = $(this);
        var path = clicked_item.data('8x-single-async');
        var push_selected_value_to = clicked_item.data('push-selected-value');
        var reload_workspace = clicked_item.data('reload-workspace');
        var callbackContainer = clicked_item.data('callback-container');
        var callbackBlock = clicked_item.data('callback-block');
        var selected_text = $(clicked_item).text();

        KTApp.block(callbackBlock, {
            overlayColor: '#000000',
            state: 'primary'
        });

        if (push_selected_value_to) {
            var push_text = {'container':push_selected_value_to, 'value':selected_text, 'reload_workspace':reload_workspace}
            postDataRequest(path, callbackContainer, callbackBlock, push_text);
        }else{
            postDataRequest(path, callbackContainer, callbackBlock);
        }
    });

    /* Handle Single Async */
    $(document).on('click', '[data-scroll-to-element]', function (e){
        e.preventDefault();
        var clicked_item = $(this);
        var jsonData = clicked_item.data('scroll-to-element');
        scrollToElement(jsonData.ele, jsonData.offset);
    });

    /* Apply k Formatter */
    applykFormatter();

    load8xChart();

    /* UX | Place text to Element */
    $(document).on('change', '[data-ux-onchange]', function (e){
        e.preventDefault();
        var clicked_item = $(this);
        var jsonData = clicked_item.data('ux-onchange');
        var method = jsonData.method;
        var if_cond = jsonData.if_cond;
        var target = jsonData.target;
        var text = jsonData.text;
        var type = jsonData.type;
        if($(this).val() == if_cond){
            if(typeof window[method] == "function"){
                window[method].call(jsonData, text, target, type);
            }
        }else{
            if(typeof window[method] == "function"){
                window[method].call(jsonData, "", target, type);
            }
        }
    });

    /* Handle Ajax Submitions */
    $(document).on('submit', '[data-async]', function(e) {
        /* Prevent submitting */
        e.preventDefault();

        /* Get the form */
        var form = $(this).closest('form');
        
        /* Parsley validate front-end */
        if (!form.parsley().isValid()) {  
            
            form.find( '[data-parsley-type]' ).each( function( i , v ){
                $(this).parsley().validate({
                    focusInvalid: false,
                    invalidHandler: function() {
                        $(this).find(":input.error:first").focus();
                    }
                });
                showNotification(jsTrans.oh_snap_change_a_few_thing_up_and_try_submitting_again, jsTrans.error, 'la la-warning', null, 'danger', true, true, true, true);
                showMsg(form, 'danger', jsTrans.oh_snap_change_a_few_thing_up_and_try_submitting_again, true);
                return;
            });
            form.find( '[data-parsley-pattern]' ).each(function( i, v ) {
                $(this).parsley().validate({
                    focusInvalid: false,
                    invalidHandler: function() {
                        $(this).find(":input.error:first").focus();
                    }
                });
                showNotification(jsTrans.oh_snap_change_a_few_thing_up_and_try_submitting_again, jsTrans.error, 'la la-warning', null, 'danger', true, true, true, true);
                showMsg(form, 'danger', jsTrans.oh_snap_change_a_few_thing_up_and_try_submitting_again, true);
                return;
            });
            form.parsley().validate({
                focusInvalid: false,
                invalidHandler: function() {
                    $(this).find(":input.error:first").focus();
                }
            });
            showNotification(jsTrans.oh_snap_change_a_few_thing_up_and_try_submitting_again, jsTrans.error, 'la la-warning', null, 'danger', true, true, true, true);
            showMsg(form, 'danger', jsTrans.oh_snap_change_a_few_thing_up_and_try_submitting_again, true);

            //KTUtil.animateClass('.alert-row', 'fadeIn animated');
            return;
        }

        /* BlockUI */
        KTApp.blockPage({overlayColor:"#000000",type:"loader",state:"success",message:jsTrans.please_wait});

        /* Get form data */
        var formData = new FormData($(this).closest('form')[0]);

        /* Callback function */
        var callback = $(this).attr('data-callback');

        /* Appended data */
        var appended_data = $(this).attr('data-append');
        /* If appended data is a function */
        if (typeof window[appended_data] == "function") {
            /* Call the function to get appended data object */
            var appended_data = window[appended_data].call();
            if (appended_data instanceof Object) {
                /* Appending the appended data to the form data */
                for (key in appended_data) {
                    /* If appended data value is an array, append it to form data as an array */
                    if (Array.isArray(appended_data[key])) {
                        for (var i = 0; i < appended_data[key].length; i++) {
                            formData.append(key, appended_data[key][i]);
                        }
                    } else {
                        formData.append(key, appended_data[key]);
                    }
                }
            }
        }

        $.ajax({
            url: $(this).attr('action'),
            type: "POST",
            processData: false,
            contentType: false,
            data: formData,
            success: function(response) {
                /* Callback */
                if(typeof window[callback] == "function")
                    window[callback].call(response, response.data);

                /* UnblockUI */
                KTApp.unblockPage();

                /* Show notification */
                if (response.status) {
                    /* Check and Reset Form */
                    var resetForm = form.data('reset');
                    if(resetForm){
                        form[0].reset();
                    }
                    showNotification(response.message, jsTrans.well_done, 'la la-warning', null, 'success', true, true, true, true);
                    if ($.support.pjax && response.data && response.data.redirect_to) {
                        $.pjax.defaults.timeout = 5000; // time in milliseconds - to handle timeout error
                        $.pjax.defaults.maxCacheLength = 0; // Disable pjax caching
                        $.pjax({
                            url: response.data.redirect_to,
                            container: '#kt_body',
                        });
                    }
                } else {
                    showNotification(response.message, jsTrans.error, 'la la-warning', null, 'danger', true, true, true, true);
                }

                /* Show message */
                setTimeout(function() {
                    /*window.scrollTo({ top: 0, behavior: 'smooth' });*/
                    showMsg(form, 'success', response.message, true);
                }, 500);

                if (response.data && response.data.redirect_to) {
                    window.location.replace(response.data.redirect_to);
                }
            },
            error: function(xhr, error_text, statusText) {
                /* UnblockUI */
                KTApp.unblockPage();

                if (xhr.status == 401) {
                    /* Unauthorized */
                    if (xhr.responseJSON.error) {                       
                        setTimeout(function() {
                            window.scrollTo({ top: 0, behavior: 'smooth' });
                            showMsg(form, 'danger', xhr.responseJSON.error, true);
                        }, 500);
                        showNotification(xhr.responseJSON.error, jsTrans.error, 'la la-warning', null, 'danger', true, true, true, true);
                    } else {
                        setTimeout(function() {
                            window.scrollTo({ top: 0, behavior: 'smooth' });
                            showMsg(form, 'danger', statusText, true);
                        }, 500);
                        showNotification(statusText, jsTrans.error, 'la la-warning', null, 'danger', true, true, true, true);
                    }
                } else if (xhr.status == 422) {
                    /* HTTP_UNPROCESSABLE_ENTITY */
                    if (xhr.responseJSON.errors) {
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                        $.each(xhr.responseJSON.errors, function(index, error) {
                            setTimeout(function() {
                                if (index === 0) {
                                    var remove_previous_alerts = true;
                                } else {
                                    var remove_previous_alerts = false;
                                }
                                showMsg(form, 'danger', error.message, remove_previous_alerts);
                            }, 500);
                            showNotification(error.message, jsTrans.error, 'la la-warning', null, 'danger', true, true, true, true);
                        });
                    } else {
                        setTimeout(function() {
                            window.scrollTo({ top: 0, behavior: 'smooth' });
                            showMsg(form, 'danger', statusText, true);
                        }, 500);
                        showNotification(statusText, jsTrans.error, 'la la-warning', null, 'danger', true, true, true, true);
                    }
                } else if (xhr.status == 500) {
                    /* Internal Server Error */
                    var error = xhr.responseJSON.message;
                    if (xhr.responseJSON.error) {                       
                        setTimeout(function() {
                            window.scrollTo({ top: 0, behavior: 'smooth' });
                            showMsg(form, 'danger', xhr.responseJSON.error, true);
                        }, 500);
                        showNotification(xhr.responseJSON.error, jsTrans.error, 'la la-warning', null, 'danger', true, true, true, true);
                    } else {
                        setTimeout(function() {
                            window.scrollTo({ top: 0, behavior: 'smooth' });
                            showMsg(form, 'danger', statusText, true);
                        }, 500);
                        showNotification(statusText, jsTrans.error, 'la la-warning', null, 'danger', true, true, true, true);
                    }
                }
            }
        });
    });

    window.addEventListener('offline', function(e){
        showNotification(jsTrans.oops_it_seems_you_are_offline, jsTrans.you_are_offline, 'la la-wifi', null, 'dark', true, true, true, false);
    });
    
    window.addEventListener('online', function(e){
        showNotification(jsTrans.you_are_online, jsTrans.welcome_back, 'la la-wifi', null, 'info', true, true, true, false);
    });

    window.addEventListener("scroll",function(){
        showAfterScroll();
    },false);

    $('#fast_modal').on("scroll", function() {      
        showAfterScroll();
    });
});

/* Show it After Scroll */
function showAfterScroll(){
    var scrollIt = $('.show-after-scroll');
    var scrollAfter = scrollIt.data('show-after-scroll');

    if(window.pageYOffset > scrollAfter){
        scrollIt[0].style.display = "block";
        
    }
    else if(window.pageYOffset < scrollAfter){
        scrollIt[0].style.display = "none";
    }
    // console.log('PageYOffset = ' + window.pageYOffset);
}

/* Firing Load It Here and Load It In */
function loadItHandler(requester, path, target){
    /* Handle Session Storage */
    var storeit = requester.data('8x-store-it');
    var storeitData = requester.data('8x-sbind');

    if(storeit){
        /* Requester asked to store it or get it from get it from sessionStorage */
        if(storeit.force_get){
            /* Force get is requested */
            getDataRequest(path, target);
            return;
        }else{
            /* Get it from storage or save it there */
            var restoreData = {id: storeit.id, list: storeit.list, bind:storeitData};
            getDataRequest(path, target, restoreData);
            return;
        }
    }else{
        /* Just get it, there is no storing roles here */
        getDataRequest(path, target);
        return;
    }
}

/* Get Data Request */
function getDataRequest(path, target, storeit = null){
    if(!globalForceGet && storeit){
        /* Check if already stored in sessionStorage */
        var restoredData = restoreData(storeit.id, storeit.list);
        if(restoredData){
            /* Data found in sessionStorage */
            $(target).html(restoredData.data, function(){
                if(storeit.bind){
                    if(typeof target === 'object'){
                        target = '#'+target.attr('id');
                    }
                    sbind(target, storeit.bind);
                }
            }).fadeIn("fast");
        }else{
            /* Not saved in sessionStorage! then.... Get it & Store it */
            /* Get it */
            $.get(path, function(data){
                /* Display Data */
                saveData(storeit.id, storeit.list, data);
                $(target).html(data, function(){
                    if(storeit.bind){
                        sbind(target, storeit.bind);
                    }
                }).fadeIn("fast");
                globalFires();
            }).done(function(){
                /* Global Fires */
            }).fail(function(){
                /* Error, Log it for Debug */
                console.log('Oops, Something went wrong! while loading '+path+' should load in '+target);
            });
        }
    }else{
        /* Run Normal Request */
        $.get(path, function(data){
            /* Display Data */
            $(target).html(data).fadeIn("fast");
            globalFires();
        }).done(function(){
            /* Global Fires */
        }).fail(function(){
            /* Error, Log it for Debug */
            console.log('Oops, Something went wrong! while loading '+path+' should load in '+target);
        });
    }
    /* Fire it in all Cases */
    globalFires();
}

/* Post Data Request */
function postDataRequest(path, callbackContainer, callbackBlock, push_text = false){
    $.post(path, function(response){
        /* Display Response */
        /* Show notification */
        if (response.status) {
            showNotification(response.message, jsTrans.well_done, 'la la-warning', null, 'success', true, true, true, true);
            if(push_text){
                $(push_text.container).text(push_text.value);
            }

            if (push_text.reload_workspace && (typeof globalQueryURL !== 'undefined') && globalQueryURL && (typeof workSpaceView !== 'undefined') && workSpaceView) {
                reload_table(globalQueryURL);
                todos_counter();
            }
        } else {
            showNotification(response.message, jsTrans.error, 'la la-warning', null, 'danger', true, true, true, true);
        }
        if(response.data){
            $(callbackContainer).html(response.data);
            KTApp.unblock(callbackBlock);
        }
    }).done(function(){
        /* Place some code here if needed */
    }).fail(function(){
        /* Error, Log it for Debug */
        console.log('Oops, Something went wrong! while posting to ' + path);
    });

    /* Global Fires */
    globalFires();
}

/* 8X S-BIND (Inputs) | bind by input name (Value) | "data" must be an object */
function sbind(target, data){
    for (var key in data) {
        var inputName = target + ' [name="'+key+'"]';
        $(inputName).val(data[key]);
    }
    /* Push csrfToken to the Form */
    var csrfTokenInput = target + ' [name="_token"]';
    $(csrfTokenInput).val(window.Laravel.csrfToken);
}

/* 8X S-BIND (Text) | bind by element ID (HTML) | "data" must be an object  */
function sbindText(target, data){
    for (var key in data) {
        var inputName = target + '#'+key;
        $(inputName).html(data[key]);
    }
}

/* Scroll to Element */
function uxTextToElement(text, target, type){
    switch (type)
    {
        case "input": 
            $(target).attr("value",text);
    }
}

/* Scroll to Element */
function scrollToElement(element, offset){
    var find_element = $('body').find(element);
    if ($(find_element).length > 0) {    
        $([document.documentElement, document.body]).animate({
            scrollTop: $(find_element).offset().top + offset
        }, 'slow');
    }
    
    /* Bug Issue
    $(document).ajaxComplete(function() {
        if (find_element.length) {
            $([document.documentElement, document.body]).animate({
                scrollTop: $(find_element).offset().top + offset
            }, 'slow');
        }else{
            $([document.documentElement, document.body]).animate({
                scrollTop: $('body').offset().top + offset
            }, 'slow');
        }
    });
    */
}

/* init Datetime Picker */
function datetimepickerInit(){
    $('.datetimepicker-init').datetimepicker({
        todayHighlight: true,
        autoclose: true,
        format: 'yyyy-mm-dd hh:ii',
        showMeridian: true,
        templates: {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>',
        },
    });

    $('.datepicker-init').datetimepicker({
        todayHighlight: true,
        autoclose: true,
        minView: 2, 
        pickTime: false, 
        language: 'pt-BR',
        format: 'yyyy-mm-dd',
        templates: {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>',
        },
    });
}

/* init Datetime Picker */
function daterangepickerInit(){
    $('.daterangepicker-init').daterangepicker({
        buttonClasses: ' btn',
        // drops: 'up',
        // startDate: '01/06/2019',
        applyClass: 'btn-primary',
        cancelClass: 'btn-secondary',
        locale: {
            format: 'YYYY-MM-DD',
            separator: ' / ',
        }
    }, function(start, end, label) {
        $('.daterangepicker-init .form-control').val( start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
    });
    $('.daterangepicker-init').val('');
}

/* Check if givin value is Empty */
function empty(data)
{
  if(typeof(data) == 'number' || typeof(data) == 'boolean')
  { 
    return false; 
  }
  if(typeof(data) == 'undefined' || data === null)
  {
    return true; 
  }
  if(typeof(data.length) != 'undefined')
  {
    return data.length == 0;
  }
  var count = 0;
  for(var i in data)
  {
    if(data.hasOwnProperty(i))
    {
      count ++;
    }
  }
  return count == 0;
}

function saveData(id, list, data){
    /* Check if sessionStorage is Enabled */
    if (!sessionStorage)
        return;
    
    /* Saving Data to sessionStorage */
    var data = {id: id, list: list, data: data};
    var selector = list + '_' + id;
    sessionStorage.setItem(selector,JSON.stringify(data));
};

function restoreData(id, list) {
    /* Check if sessionStorage is Enabled */
    if (!sessionStorage)
        return;
    
    /* Check if Data is stored in sessionStorage */
    var selector = list + '_' + id;
    var data = sessionStorage.getItem(selector);
    if (!data)
        return null;

    /* Returing Data */
    return JSON.parse(data);
};

/* Show Notifications */
function showNotification(message, title, icon, url, type, allow_dismiss, newest_on_top, pause_on_hover, autoHide) {
    var content = {};

    content.message = message;
    if (title) {
        content.title = title;
    }
    if (icon) {
        content.icon = 'icon ' + icon;
    }
    if (url) {
        content.url = url;
        content.target = '_blank';
    }

    var notify = $.notify(content, { 
        type: type,
        autoHide: autoHide,
        allow_dismiss: allow_dismiss,
        newest_on_top: newest_on_top,
        mouse_over:  pause_on_hover
    });
    runSound();
}

/* Temp Empty Space */
function tempEmptySpace(html){
    $("#tempEmptySpace").html(html);
}

function emptyTempEmptySpace(){
    $("#tempEmptySpace").html("");
}

function kFormatter(num) {
    return Math.abs(num) > 999 ? Math.sign(num)*((Math.abs(num)/1000).toFixed(1)) + 'k' : Math.sign(num)*Math.abs(num)
}

function applykFormatter(){
    $('.k-formatter').each(function() {
        var num_int = $(this).text();
        var num = kFormatter(num_int);
        $(this).attr('title', num_int);
        $(this).text(num);
    });
}

/* Set Cookie */
function setCookie(cname, cvalue, exdays){
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

/* Get Cookie */
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
        c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
        }
    }
    return "";
}

/* Show Message */
function showMsg(form, type, msg, remove_previous_alerts = null){

    if (type == 'success') {
        var status = 'alert-success';
        var icon = 'la la-check';
        var text = jsTrans.well_done;
        
    } else if (type == 'danger') {
        var status = 'alert-danger';
        var icon = 'la la-warning';
        var text = jsTrans.error;
    }

    var return_msg = $('\
        <div class="alert '+status+' fade show alert-row" role="alert">\
            <div class="alert-icon"><i class="'+icon+'"></i></div>\
            <div class="alert-text">'+msg+'</div>\
            <div class="alert-close">\
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
                    <span aria-hidden="true"><i class="la la-close"></i></span>\
                </button>\
            </div>\
        </div>\
    ');

    if (remove_previous_alerts !== false) {
        form.find('.alert-row').remove();
    }

    //return_msg.prependTo(form);
    //KTUtil.animateClass(return_msg[0], 'fadeIn animated');
}

/* Run Sound */
function runSound(soundPath = '/8x/assets/media/sounds/light.mp3'){

    var audio = new Audio(soundPath);
    audio.play();
}

/* Toast */
function toast(message, type = 'success'){
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "positionClass": "toast-top-right",
        "showDuration": "1000",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        iconClasses: {
            error: 'alert-error',
            info: 'alert-info',
            success: 'alert-success',
            warning: 'alert-warning'
        }
    }

    if (type == 'success') {
        toastr.options.onShown = runSound();
        toastr.success(message, {timeOut: 5000});
    } else if (type == 'error') {
        toastr.options.onShown = runSound();
        toastr.error(message, {timeOut: 5000});
    }
}

// Custom Colors
function getCustomColor(color) {
    colors = {
        error: '#f4516c',
        success: '#34bfa3'
    }

    return colors[color];
}

function logout(){
	var form = $('#logout-form');
	form.ajaxSubmit({
		url: form.action,
		success: function(response, status, xhr, $form) {
			// Success
			if (response.success) {            		
				setTimeout(function() {
					btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
					showErrorMsg(form, 'success', response.success);
				}, 2000);
			} else {
				setTimeout(function() {
					btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
					showErrorMsg(form, 'success', 'Logged-out successfully');
				}, 2000);
			}
			location.reload();
		},
		error: function (xhr, error_text, statusText) {
			if (xhr.status == 401) {
				// Unauthorized
				if (xhr.responseJSON.error) {            			
					setTimeout(function() {
						btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
						showErrorMsg(form, 'danger', xhr.responseJSON.error);
					}, 2000);
				} else {
					setTimeout(function() {
						btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
						showErrorMsg(form, 'danger', statusText);
					}, 2000);
				}
			} else if (xhr.status == 422) {
				// HTTP_UNPROCESSABLE_ENTITY
				if (xhr.responseJSON.errors) {            			
					// Remove previous alers
					form.find('.alert').remove();

					btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
					$.each(xhr.responseJSON.errors, function(index, error) {
						setTimeout(function() {
							showErrorMsg(form, 'danger', error.message, false);
						}, 2000);
					});
				} else {
					setTimeout(function() {
						btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
						showErrorMsg(form, 'danger', statusText);
					}, 2000);
				}
			} else if (xhr.status == 500) {
				// Internal Server Error
				var error = xhr.responseJSON.message;
				if (xhr.responseJSON.error) {            			
					setTimeout(function() {
						btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
						showErrorMsg(form, 'danger', xhr.responseJSON.error);
					}, 2000);
				} else {
					setTimeout(function() {
						btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
						showErrorMsg(form, 'danger', statusText);
					}, 2000);
				}
			}
		}
	});
}

/* Reports */

function load8xChart(){
    $('[data-8x-load-chart]').each(function(){
        var target = $(this);
        var path = target.data('8x-load-chart');
        $.get(path, function(data){
            /* Display Data */
            $(target).html(data);
            //globalFires();
        }).done(function(){
            /* Global Fires */
        }).fail(function(){
            /* Error, Log it for Debug */
            console.log('Oops, Something went wrong! while loading chart: '+path);
        });
    });
}

function digits(num){
    return num.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
}

$.fn.digits = function(){ 
    return this.each(function(){ 
        $(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") ); 
    })
}

function formToJSON(f) {
    var fd = $(f).serializeArray();
    var d = {};
    $(fd).each(function() {
        if (d[this.name] !== undefined){
            if (!Array.isArray(d[this.name])) {
                d[this.name] = [d[this.name]];
            }
            d[this.name].push(this.value);
        }else{
            d[this.name] = this.value;
        }
    });
    return d;
}