<script>
    var global_variables = {
        auth_user_id: "{{auth()->user() ? auth()->user()->id : null}}",
        app_url: "{{url('/')}}",
        app_keepalive_url: "{{route('keepalive')}}",
        app_logout_url: "{{route('logoutGetRequest')}}",
    }

    var datatable_trans = {
        "sEmptyTable":   "{{__('main.sEmptyTable')}}",
        "sLoadingRecords":   "{{__('main.sLoadingRecords')}}",
        "sProcessing":   "{{__('main.sProcessing')}}",
        "sLengthMenu":   "{{__('main.sLengthMenu')}}",
        "sZeroRecords":  "{{__('main.sZeroRecords')}}",
        "sInfo":         "{{__('main.sInfo')}}",
        "sInfoEmpty":    "{{__('main.sInfoEmpty')}}",
        "sInfoFiltered": "{{__('main.sInfoFiltered')}}",
        "sSearch":       "{{__('main.sSearch')}}",
        "sFirst":    "{{__('main.sFirst')}}",
        "sPrevious": "{{__('main.sPrevious')}}",
        "sNext":     "{{__('main.sNext')}}",
        "sLast":     "{{__('main.sLast')}}",
		"sSortAscending":  "{{__('main.sSortAscending')}}",
        "sSortDescending": "{{__('main.sSortDescending')}}",
        "sUrl":          "",
        "sInfoPostFix":  ""
    }

    var datatable_trans_todos = {
        "sEmptyTable":   "{{__('main.sNothingTodo')}}",
        "sLoadingRecords":   "{{__('main.sLoadingRecords')}}",
        "sProcessing":   "{{__('main.sProcessing')}}",
        "sLengthMenu":   "{{__('main.sLengthMenu')}}",
        "sZeroRecords":  "{{__('main.sZeroRecords')}}",
        "sInfo":         "{{__('main.sInfo')}}",
        "sInfoEmpty":    "{{__('main.sInfoEmpty')}}",
        "sInfoFiltered": "{{__('main.sInfoFiltered')}}",
        "sSearch":       "{{__('main.sSearch')}}",
        "sFirst":    "{{__('main.sFirst')}}",
        "sPrevious": "{{__('main.sPrevious')}}",
        "sNext":     "{{__('main.sNext')}}",
        "sLast":     "{{__('main.sLast')}}",
		"sSortAscending":  "{{__('main.sSortAscending')}}",
        "sSortDescending": "{{__('main.sSortDescending')}}",
        "sUrl":          "",
        "sInfoPostFix":  ""
    }
</script>