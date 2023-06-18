<script>
    /* Delete It */
    $(document).on('click', '[data-8x-delete-it]', function (e){
        e.preventDefault();
        var data = $(this).data('8x-delete-it');
        var container = (data.container ? data.container : false);
        var path = data.path;
        var callback = data.callback ? data.callback : false;

        swal.fire({
            title: (data.title ? data.title : "{{__('main.swal_title')}}"),
            text: (data.text ? data.text : "{{__('main.swal_text')}}"),
            type: (data.type ? data.type : 'warning'),
            showCancelButton: true,
            confirmButtonText: (data.confirmButtonText ? data.confirmButtonText : "{{__('main.swal_confirm')}}"),
            cancelButtonText: (data.cancelButtonText ? data.cancelButtonText : "{{__('main.swal_cancel')}}"),
            focusCancel: true,
            reverseButtons: true
        }).then(function(result){
            if (result.value){
                postDataRequest(path, container, container);

                // Callback function
                if(callback && typeof window[callback] == "function")
                    window[callback].call();

                /* Delete the element from page */
                if(container){
                    $(container).remove();
                }
            }
        });
    });

</script>

<script>
    /* un suspend It */
    $(document).on('click', '[data-8x-un-suspend-it]', function(e) {
        e.preventDefault();
        var data = $(this).data('8x-un-suspend-it');
        var container = (data.container ? data.container : false);
        var path = data.path;
        var callback = data.callback ? data.callback : false;

        postDataRequest(path, container, container);
        // Callback function
        if (callback && typeof window[callback] == "function")
            window[callback].call();

    });
</script>

<script>
    /* un suspend It */
    $(document).on('click', '[data-8x-publish-it]', function(e) {
        e.preventDefault();
        var data = $(this).data('8x-publish-it');
        var container = (data.container ? data.container : false);
        var path = data.path;
        var callback = data.callback ? data.callback : false;

        postDataRequest(path, container, container);
        // Callback function
        if (callback && typeof window[callback] == "function")
            window[callback].call();

    });
</script>