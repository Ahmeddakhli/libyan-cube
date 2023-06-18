<?php

namespace Modules\CMS\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class CMSEventServiceProvider extends ServiceProvider
{
    protected $listen = [
         // CmsManagement Events
        'cms_management.created' => [
            'Modules\CMS\Events\CmsManagementEvents@cmsManagementCreated',
        ],
        'cms_management.updated' => [
            'Modules\CMS\Events\CmsManagementEvents@cmsManagementUpdated',
        ],
        'cms_management.saved' => [
            'Modules\CMS\Events\CmsManagementEvents@cmsManagementSaved',
        ],
        'cms_management.deleted' => [
            'Modules\CMS\Events\CmsManagementEvents@cmsManagementDeleted',
        ],
        'cms_management.restored' => [
            'Modules\CMS\Events\CmsManagementEvents@cmsManagementRestored',
        ],

         // CmsManagement Translation Events
        'cms_management_translation.created' => [
            'Modules\CMS\Events\CmsManagementTranslationEvents@cmsManagementTranslationCreated',
        ],
        'cms_management_translation.updated' => [
            'Modules\CMS\Events\CmsManagementTranslationEvents@cmsManagementTranslationUpdated',
        ],
        'cms_management_translation.saved' => [
            'Modules\CMS\Events\CmsManagementTranslationEvents@cmsManagementTranslationSaved',
        ],
        'cms_management_translation.deleted' => [
            'Modules\CMS\Events\CmsManagementTranslationEvents@cmsManagementTranslationDeleted',
        ],
    ];
}