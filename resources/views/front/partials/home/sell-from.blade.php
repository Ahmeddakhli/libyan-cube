<!-- START BREADCRUMB -->
<nav aria-label="breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('front.home')}}">{{__('main.home_title')}}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{__('main.sell_your_unit')}}
            </li>
        </ol>
    </div>
</nav>
<!-- END BREADCRUMB -->

<!-- START price-unit-page -->
<div class="price-unit-page">
    <div class="container">
        <div class="section-title mb-2">
            <h1 class="title">{{__('main.unit_details')}}</h1>
        </div>
        <div class="price-holder py-3">
            <form action="{{route('front.home.sell_request.store')}}" method="POST" id="sell-from" data-parsley-validate>
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <select class="dd-select" name="compound" placeholder="{{__('main.compound')}}">
                                <option selected disabled>{{__('main.compound')}}</option>
                                @foreach($projects as $project)
                                <option value="{{$project->project}}">{{$project->project}}</option>
                                @endforeach
                                <option value="other-choose">{{__('main.other')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <select class="dd-select" name="i_purpose_id" placeholder="{{__('main.purpose')}}" onchange="getPurposePurposeTypesRequest([$(this).val()], 'sell-from')">
                                <option selected disabled>{{__('main.purpose')}}</option>
                                @foreach($purposes as $purpose)
                                <option value="{{$purpose->id}}">{{$purpose->purpose}}</option>
                                @endforeach
                            </select>
                            <div id="purpose_error_container" class="error_container"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <select class="dd-selectSell" name="i_purpose_type_id" placeholder="{{__('main.purpose_type')}}" id="i_purpose_type_id_sell">
                                <option selected disabled>{{__('main.purpose_type')}}</option>
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="unit_name" placeholder="{{__('inventory::inventory.unit_name')}}" required data-parsley-required data-parsley-required-message="{{__('main.please_enter_your_unit_name')}}" data-parsley-trigger="change focusout">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="custom-file">
                                <input id='upload-img' type="file" class="custom-file-input" name="attachments[]" multiple class="form-control" required data-parsley-required data-parsley-required-message="{{__('main.please_enter_your_attachments')}}" data-parsley-trigger="change focusout" data-parsley-errors-container="#attachments_error_container">
                                <label class="custom-file-label" for="upload-img">
                                    {{__('main.attach_unit_pic')}}
                                </label>
                            </div>
                            <div id="attachments_error_container" class="error_container"></div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <textarea class='form-control' name="comments" id="" rows="3" placeholder="{{__('main.extra_info')}}"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="{{__('inventory::inventory.name')}}" required data-parsley-required data-parsley-required-message="{{__('main.please_enter_your_name')}}" data-parsley-trigger="change focusout">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="{{__('inventory::inventory.email')}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" class="form-control" name="phone" placeholder="{{__('users.mobile_number')}}" required data-parsley-required data-parsley-required-message="{{__('main.please_enter_your_mobile_number')}}" data-parsley-trigger="change focusout">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-0">
                            <button type="submit" class="site-btn submit-sell-request"> {{__('main.send')}}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.container -->
</div>
<!-- END price-unit-page -->




@push('scripts')
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#374afb",
                "light": "#ffffff",
                "dark": "#282a3c",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };
    //history.replaceState(null, "@yield('title') | {{env('APP_NAME')}}", "{{Request::url()}}");
</script>

<script>
    $('.submit-sell-request').on('click', function(e) {
        e.preventDefault();
        var form = $(this).closest('form');

        $.blockUI({
            overlayColor: "#000000",
            type: "loader",
            state: "success",
            message: "<img src='{{URL::asset('front/images/loader.gif')}}'/>"
        });

        /* Parsley validate front-end */
        if (!form.parsley().isValid()) {
            // Display notification
            $.unblockUI();
            // Display notificaction
            $.alert("{{__('main.oh_snap_change_a_few_thing_up_and_try_submitting_again')}}", {
                title: '',
                type: 'warning',
                position: ['top-right', [0, 20]],
            });
            form.find('[data-parsley-type]').each(function(i, v) {
                $(this).parsley().validate({
                    focusInvalid: false,
                    invalidHandler: function() {
                        $(this).find(":input.error:first").focus();
                    }
                });

                return;
            });
            form.find('[data-parsley-pattern]').each(function(i, v) {
                $(this).parsley().validate({
                    focusInvalid: false,
                    invalidHandler: function() {
                        $(this).find(":input.error:first").focus();
                    }
                });

                return;
            });
            form.parsley().validate({
                focusInvalid: false,
                invalidHandler: function() {
                    $(this).find(":input.error:first").focus();
                }
            });

            return;
        }

        // Request parameters
        var url = "{{route('front.home.sell_request.store')}}";
        var formData = new FormData(document.getElementById("sell-from"));

        // Send Sell Request 
        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
        }).done(function(response) {
            $.unblockUI();
            // Notification message
            if (response.message) {
                // Notification type
                if (response.status) {
                    $.alert(response.message, {
                        title: '',
                        type: 'info',
                        position: ['top-right', [0, 20]],
                    });
                    let url = "{{route('front.sellThankYou','name=name')}}";
                    url = url.replace('name=name',response.data.name);
                    window.location = url;
                } else {
                    $.alert(response.message, {
                        title: '',
                        type: 'warning',
                        position: ['top-right', [0, 20]],
                    });
                }
            }
        }).fail(function(xhr, error_text, statusText) {
            // Un Block UI
            $.unblockUI();

            // Display notificaion
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                $.each(xhr.responseJSON.errors, function(index, error) {
                    $.alert(error.message, {
                        title: '',
                        type: 'warning',
                        position: ['top-right', [0, 20]],
                    });
                });
            } else {
                $.alert(statusText, {
                    title: '',
                    type: 'warning',
                    position: ['top-right', [0, 20]],
                });
            }
        });
    });
</script>

@endpush