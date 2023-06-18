<!-- Full Modal -->
<!-- modal -->
<div id="full_modal" class="modal @if(\App::getLocale() == 'ar') direction-rtl right @else direction-ltr left @endif full fade in" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <!-- dialog -->
    <div class="modal-dialog">
        <!-- content -->
        <div class="modal-content">
            <!-- header -->
            <div class="modal-header">
                <h1 id="create_group_modal_label" class="modal-title"></h1>
            </div>
            <!-- header -->
            <!-- body -->
            <div class="modal-body"></div>
            <!-- body -->
            <!-- footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main.close')}}</button>
            </div>
            <!-- footer -->
        </div>
        <!-- content -->
    </div>
    <!-- dialog -->
</div>
<!-- modal -->