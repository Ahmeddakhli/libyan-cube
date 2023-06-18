<script>
    $('.m_selectpicker').selectpicker();
</script>
<script src="{{ URL::asset('8x/assets/js/repeater.js') }}" type="text/javascript"></script>
<script src="{{ asset('8x/assets/js/summernote-image-attributes.js') }}"></script>
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
            show: function() {
                // Get items count
                var items_count = $('.repeater').repeaterVal().translations.length;
                var current_index = items_count - 1;

                /* Summernote */
                // Update the textarea id
                $(this).find('.note-editor').remove(); // Remove repeated summernote
                $(this).find('.short_description').attr('id', 'short_description-' + current_index);

                $('#short_description-' + current_index).summernote({
                    imageTitle: {
                        specificAltField: true,
                    },
                    popover: {
                        image: [
                            ['imagesize', ['imageSize100', 'imageSize50',
                                'imageSize25'
                            ]],
                            ['float', ['floatLeft', 'floatRight', 'floatNone']],
                            ['remove', ['removeMedia']],
                            ['custom', ['imageAttributes']],
                        ],
                    },
                    height: '300px',
                });

                // Showing the item
                $(this).show();
            }
        });
        $('#short_description-' + '0').summernote({
            height: 150, //set editable area's height
            imageTitle: {
                specificAltField: true,
            },
            popover: {
                image: [
                    ['imagesize', ['imageSize100', 'imageSize50',
                        'imageSize25'
                    ]],
                    ['float', ['floatLeft', 'floatRight', 'floatNone']],
                    ['remove', ['removeMedia']],
                    ['custom', ['imageAttributes']],
                ],
            },
        });
    });
</script>
