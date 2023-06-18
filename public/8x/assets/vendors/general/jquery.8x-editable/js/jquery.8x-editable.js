/*
 * 8X Quick Edit - Version 1.0.0
 * Copyright (c) 2018-2019 Mostafa Megahed, 8WORX
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 */


$(document).on("change", '.swal2-select', function(event) { 
    Swal_selected_option = $(this).find("option:selected").text();
});

$(document).on("click", '[data-qedit]', function(e) { 
    e.preventDefault();
    var target = "#"+$(this).data('qedit');
    $(target + ' .editable-normal').removeClass("editable-normal").addClass('editable-active');
});


(function($) {

    $.fn.editable = function(options) {

        var options = $.extend({}, $.fn.editable.defaults, options);

        return this.each(function(){

            /* Define Required Data */
            var self = $(this);
            /* Types: text, textarea, select */
            var data = self.data('editable');
            var type = self.data('editable-type');
            var select_data = self.data('editable-select');
            var oldValue = data.update_value;
            var path = self.data('editable-path');

            self.click(function (){
                if(!self.hasClass('editable-normal')){
                    if(type == 'select'){
                        var sel_opt = '.swal2-select option[value="'+oldValue+'"]';
                        $(sel_opt).attr("selected", "selected");
                    }
                    Swal.fire({
                        input: type,
                        inputValue: oldValue,
                        inputOptions: eval(select_data),
                        inputValidator: (value) => {
                            if (!value) {
                            return 'You need to write something!'
                            }
                        },
                        inputAttributes: {
                        autocapitalize: 'off'
                        },
                        showCancelButton: true,
                        confirmButtonText: (jsTrans.save ? jsTrans.save : 'Save'),
                        cancelButtonText: (jsTrans.cancel ? jsTrans.cancel : 'Cancel'),
                        focusCancel: true,
                        showLoaderOnConfirm: true,
                        reverseButtons: true
                    }).then((result) => {
                        if(result.value){
                            /* Update data.value with new entered value */
                            data.update_value = result.value;

                            $.post(path, data, function(response){
                                /* Show notification */
                                if (response.status){
                                    // Update Current Values
                                    if(type == 'select'){
                                        self.text(Swal_selected_option).addClass('animated fadeIn');
                                        oldValue = result.value;
                                    }else{
                                        self.text(result.value).addClass('animated fadeIn');
                                        oldValue = result.value;
                                    }
                                    self.attr('data-editable', JSON.stringify(data));
                                    showNotification(response.message, jsTrans.well_done, 'la la-warning', null, 'success', true, true, true, true);
                                }else{
                                    showNotification(response.message, jsTrans.error, 'la la-warning', null, 'danger', true, true, true, true);
                                }
                            });
                        }
                    });
                }
            });
        });
    };

    // publicly accessible defaults
    $.fn.editable.defaults = {
        name       : 'value',
        id         : 'id',
        type       : 'text',
        width      : 'auto',
        height     : 'auto',
        event      : 'click.editable',
        onblur     : 'cancel',
        loadtype   : 'GET',
        loadtext   : 'Loading...',
        placeholder: 'Click to edit',
        loaddata   : {},
        submitdata : {},
        ajaxoptions: {}
    };

})(jQuery);
