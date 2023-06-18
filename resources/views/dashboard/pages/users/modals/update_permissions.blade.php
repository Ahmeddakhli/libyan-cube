<style>
.data-row{
    overflow: scroll;
}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="p-3">
            <h5 class="m-portlet__head-text"><i class="fas fa-user-shield kt-margin-r-5"></i> {{$user->full_name}}</h5>
            <hr>
            <form action="{{route('users.updateUserPermissions')}}" method="POST" data-async data-callback="updateUserPermissionsV2Callback" data-parsley-validate>
                @csrf
                <input type="hidden" value="{{$user->id}}" name="id" />
                <div class="row" id="manageUserPermissions_{{$user->id}}">
                    <!-- Sections / Parents -->
                    <div class="col-md-5 col-sm-12">
                        <!-- Search -->
                        <div class="clearable" id="parentsSearch_{{$user->id}}">
                            <input class="form-control form-control-sm" id="searchParentsBtn_{{$user->id}}" type="text" placeholder="{{__('main.filter_sections')}}">
                            <i class="clearable__clear fas fa-times-circle"></i>
                        </div>
                        <div class="kt-margin-t-5 kt-padding-r-5 data-row" id="parentsList_{{$user->id}}" data-scroll="true" data-height="340" style="height:340px;">
                            <ul class="list-user list-user-flush">
                                @foreach ($permissions as $permission)
                                <li class="list-user-item list-user-item-action rounded-8 perm-item" data-jump-to="{{$permission->id}}" data-permission-module-id="{{$permission->module_id}}">
                                    <div class="form-check kt-padding-t-5 kt-padding-b-5">
                                        <input class="form-check-input" data-parent-input="{{$permission->id}}" type="checkbox" name="permissions[]" value="{{$permission->id}}" id="{{$permission->id}}" @if($permission->is_hidden) disabled @endif>
                                        <label class="form-check-label kt-padding-l-5 kt-font-dark h6" for="{{$permission->id}}">{{$permission->name}}</label>
                                        <a href="javascript:;" data-jump-to="{{$permission->id}}" class="small kt-padding-l-5 jump-to vishidden">
                                            - <span class="text-muted">{{__('main.jump_to')}}</span>
                                        </a>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Select All -->
                        <div class="p-2">
                            <button type="button" class="btn btn-sm btn-light" onclick="selectAllDisplayedItems('#parentsList_{{$user->id}}');">{{trans('main.select_all')}}</button>
                            <button type="button" class="btn btn-sm btn-light" onclick="deselectAllDisplayedItems('#parentsList_{{$user->id}}');">{{trans('main.deselect_all')}}</button>
                        </div>
                    </div>
                    <!-- Permissions -->
                    <div class="col-md-7 col-sm-12">
                        <!-- Search -->
                        <div class="clearable" id="permissionsSearch_{{$user->id}}">
                            <input class="form-control form-control-sm" id="searchPermissionsBtn_{{$user->id}}" type="text" placeholder="{{__('main.filter_permissions')}}">
                            <i class="clearable__clear fas fa-times-circle"></i>
                        </div>
                        <!-- Permissions -->
                        <div class="kt-padding-t-5 kt-padding-r-10 data-row" id="permissionsList_{{$user->id}}" data-scroll="true" data-height="340" style="height:340px;">
                            <div>
                                @foreach ($permissions as $permission)
                                    <h6 class="kt-padding-t-15 permissions-user" id="parentTitle{{$permission->id}}"><i class="fas fa-shield-alt kt-margin-r-5"></i>{{$permission->name}}</h6>
                                    @if($permission->children->count())
                                        @foreach ($permission->children as $child)
                                            <div class=" list-user-item-action kt-padding-l-10 rounded-8 perm-item" data-section-id="{{$permission->id}}" data-permission-module-id="{{$permission->module_id}}">
                                                <div class="form-check kt-padding-t-5 kt-padding-b-5">
                                                    <input class="form-check-input" data-parent-id="{{$permission->id}}" type="checkbox" name="permissions[]" value="{{$child->id}}" id="{{$child->id}}" @if($user->hasPermission($child->slug)) checked @endif data-slug="{{$child->slug}}" @if($child->is_hidden) disabled @endif>
                                                    <label class="form-check-label h6" for="{{$child->id}}">{{$child->name}}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <!-- Select All -->
                        <div class="p-2">
                            <button type="button" class="btn btn-sm btn-light" onclick="selectAllDisplayedItems('#permissionsList_{{$user->id}}');">{{trans('main.select_all')}}</button>
                            <button type="button" class="btn btn-sm btn-light" onclick="deselectAllDisplayedItems('#permissionsList_{{$user->id}}');">{{trans('main.deselect_all')}}</button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 text-left">
                        <div class="h6 text-muted kt-padding-t-10"><i class="fas fa-times-circle"></i> {{__('main.skip_to_exit')}}</div>
                    </div>
                    <div class="col-md-6 text-right">
                        <button type="submit" class="btn btn-pill btn-success">{{trans('users.update_user_permissions')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    /* Disable clicking outside the modal to close it */
    // $('#vcxl_modal').attr('data-backdrop', 'static');
    // $('#vcxl_modal').attr('data-keyboard', 'false');
    // $('#vcxl_modal').off('click');
    // $('#vcxl_modal').find('[data-dismiss="modal"]').hide();

    /* Parents Search */
    $("#searchParentsBtn_{{$user->id}}").on("keyup", function() {
        /* Scroll to top */
        $("#parentsList_{{$user->id}}").animate({
                scrollTop: $("#parentsList_{{$user->id}}").position().top - 30
        }, 400); 
        /* Start Search */
        var value = $(this).val().toLowerCase();
        $("#parentsList_{{$user->id}} .perm-item").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    /* Permissions Search */
    $("#searchPermissionsBtn_{{$user->id}}").on("keyup", function() {
        /* Scroll to top */
        $("#permissionsList_{{$user->id}}").animate({
                scrollTop: $("#permissionsList_{{$user->id}}").position().top - 30
        }, 400); 
        /* Start Search */
        var value = $(this).val().toLowerCase();
        $("#permissionsList_{{$user->id}} .perm-item").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
        /* Hide Permissions User's Title */
        if(value.length > 0){
            $('.permissions-user').hide();
        }else{
            $('.permissions-user').show();
        }
    });

    /* Parent Permission Input Change */
    $("[data-parent-input]").on("change", function() {
        var parentId = $(this).data('parent-input');
        var selectPermissions = '[data-parent-id~="'+parentId+'"]';
        if($(this).is(':checked')){
            $(selectPermissions).prop('checked', true);
        }else{
            $(selectPermissions).prop('checked', false);
        }
    });

    /* Child Permission Input Change */
    $("[data-parent-id]").on("change", function() {
        var parentId = $(this).data('parent-id');
        var selectParent = '[data-parent-input~="'+parentId+'"]';
        var selectChild = '[data-parent-id~="'+parentId+'"]';
        if ($(selectChild).not(':checked').length == 0) {
            $(selectParent).prop('checked', true);
        }else{
            $(selectParent).prop('checked', false);
        }
    });

    /* Parent Jumpt To */
    $('.list-user').on( 'mouseenter', '.list-user-item', function () {
        $(this).find('.jump-to').css("visibility", "visible");
    });
    $('.list-user').on( 'mouseleave', '.list-user-item', function () {
        $(this).find('.jump-to').css("visibility", "hidden");
    });

    /* Handle Scroll To Child */
    $('[data-parent-input]').each(function () {
        var parentId = $(this).data('parent-input');
        var scrollPos = $('#parentTitle'+parentId).position().top;
        $(this).click(function () {
            $("#permissionsList_{{$user->id}}").animate({
                scrollTop: scrollPos
            }, 400); 
        });
    });

    /* Handle Scroll To Jump To */
    $('[data-jump-to], .list-user-item').each(function () {
        var parentId = $(this).data('jump-to');
        var scrollPos = $('#parentTitle'+parentId).position().top;
        $(this).click(function () {
            $("#permissionsList_{{$user->id}}").animate({
                scrollTop: scrollPos
            }, 400); 
        });
    });

    /* clearable inputs */
    $(".clearable").each(function() {
        const $inp = $(this).find("input:text"),
        $cle = $(this).find(".clearable__clear");
        $inp.on("input", function(){
            $cle.toggle(!!this.value);
        });
        $cle.on("touchstart click", function(e) {
            e.preventDefault();
            $inp.val("").trigger("input");
            $inp.trigger("keyup");
        });
    });
});

/* Select All Displayed Parents */
function selectAllDisplayedItems(listId) {
    $(listId + ' .perm-item:visible').each(function() {
        $(this).find(".form-check-input").prop('checked', true).change();
        /* Handle Checking Child */
        var parentId = $(this).data('parent-input');
        if(parentId){
            var selectPermissions = '[data-parent-id~="'+parentId+'"]';
            $(selectPermissions).prop('checked', true);
        }
    });
    checkUncheckAllParents();
}

/* Deselect All Displayed Parents */
function deselectAllDisplayedItems(listId) {
    $(listId + ' .perm-item:visible').each(function() {
        $(this).find(".form-check-input").prop('checked', false).change();
        /* Handle Checking Child */
        var parentId = $(this).data('parent-input');
        var selectPermissions = '[data-parent-id~="'+parentId+'"]';
        $(selectPermissions).prop('checked', false);
    });
    checkUncheckAllParents();
}

/* Update User Permissions V2 Callback */
function updateUserPermissionsV2Callback() {
    $('#vcxl_modal').removeAttr('data-backdrop');
    $('#vcxl_modal').removeAttr('data-keyboard');
    $('#vcxl_modal').find('[data-dismiss="modal"]').show();
    $('#vcxl_modal .modal-body').html('');
    $('#vcxl_modal .modal-header .modal-title').html('');
    $('#vcxl_modal').modal('toggle');
    // Reload datatable
    users_table.ajax.reload(null, false);
}

/* Check & Uncheck Parent based on checked children */
function checkUncheckAllParents() {
    $('[data-parent-input]').each(function () {
        var parentId = $(this).data('parent-input');
        var selectParent = '[data-parent-id~="'+parentId+'"]';
        if ($(selectParent).not(':checked').length == 0) {
            $(this).prop('checked', true);
        }else{
            $(this).prop('checked', false);
        }
    });
}
</script>