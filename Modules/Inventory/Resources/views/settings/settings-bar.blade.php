<div class="kt-subheader kt-grid__item kt-hide" id="kt_subheader">
    <div class="kt-subheader__main">
        <h4 class="kt-subheader__title" id="workspaceTitle"><i class="fas fa-cogs fa-sm"></i> {{__('inventory::inventory.settings')}}</h4>
        <span class="kt-subheader__separator kt-subheader__separator--v kt-hidden"></span>
        <span class="kt-subheader__desc kt-hidden">{{trans('leads::leads.quick_filter')}}:</span>
        <form class="kt-form kt-form--label-right kt-hidden" id="quick_filter_form" action="" method="POST">
            <ul class="ks-cboxtags">
            </ul>
        </form>
    </div>
    <div class="kt-subheader__toolbar kt-hidden">
        <div class="kt-subheader__wrapper">
            <a href="javascript:;" data-toggleit="#lccfilter" id="lccaFilterBtn" class="btn kt-subheader__btn-secondary">
                <i class="fas fa-filter"></i> {{trans('leads::leads.filter')}}
            </a>
        </div>
    </div>
</div>