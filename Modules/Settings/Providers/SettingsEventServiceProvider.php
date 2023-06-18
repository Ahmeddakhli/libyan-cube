<?php

namespace Modules\Settings\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class SettingsEventServiceProvider extends ServiceProvider
{
    protected $listen = [
        // Logo Events
        'contact.created' => [
            'Modules\Settings\Events\ContactEvents@contactCreated',
        ],
        'contact.updated' => [
            'Modules\Settings\Events\ContactEvents@contactUpdated',
        ],
        'contact.saved' => [
            'Modules\Settings\Events\ContactEvents@contactSaved',
        ],
        'contact.deleted' => [
            'Modules\Settings\Events\ContactEvents@contactDeleted',
        ],
        'contact.restored' => [
            'Modules\Settings\Events\ContactEvents@contactRestored',
        ],

        // Footer Link Events
        'footer_link.created' => [
            'Modules\Settings\Events\FooterLinkEvents@footerlinkCreated',
        ],
        'footer_link.updated' => [
            'Modules\Settings\Events\FooterLinkEvents@footerlinkUpdated',
        ],
        'footer_link.saved' => [
            'Modules\Settings\Events\FooterLinkEvents@footerlinkSaved',
        ],
        'footer_link.deleted' => [
            'Modules\Settings\Events\FooterLinkEvents@footerlinkDeleted',
        ],
        'footer_link.restored' => [
            'Modules\Settings\Events\FooterLinkEvents@footerlinkRestored',
        ],

        // Footer Links Translation Events
        'footer_link_translation.created' => [
            'Modules\Settings\Events\FooterLinksTranslationEvents@footerlinkTranslationCreated',
        ],
        'footer_link_translation.updated' => [
            'Modules\Settings\Events\FooterLinksTranslationEvents@footerlinkTranslationUpdated',
        ],
        'footer_link_translation.saved' => [
            'Modules\Settings\Events\FooterLinksTranslationEvents@footerlinkTranslationSaved',
        ],
        'footer_link_translation.deleted' => [
            'Modules\Settings\Events\FooterLinksTranslationEvents@footerlinkTranslationDeleted',
        ],
        'footer_link_translation.restored' => [
            'Modules\Settings\Events\FooterLinksTranslationEvents@footerlinkTranslationRestored',
        ],

        // Contact Events
        'contact.created' => [
            'Modules\Settings\Events\ContactEvents@contactCreated',
        ],
        'contact.updated' => [
            'Modules\Settings\Events\ContactEvents@contactUpdated',
        ],
        'contact.saved' => [
            'Modules\Settings\Events\ContactEvents@contactSaved',
        ],
        'contact.deleted' => [
            'Modules\Settings\Events\ContactEvents@contactDeleted',
        ],
        'contact.restored' => [
            'Modules\Settings\Events\ContactEvents@contactRestored',
        ],

        // Main Slider Events
        'main_slider.created' => [
            'Modules\Settings\Events\MainSliderEvents@mainsliderCreated',
        ],
        'main_slider.updated' => [
            'Modules\Settings\Events\MainSliderEvents@mainsliderUpdated',
        ],
        'main_slider.saved' => [
            'Modules\Settings\Events\MainSliderEvents@mainsliderSaved',
        ],
        'main_slider.deleted' => [
            'Modules\Settings\Events\MainSliderEvents@mainsliderDeleted',
        ],
        'main_slider.restored' => [
            'Modules\Settings\Events\MainSliderEvents@mainsliderRestored',
        ],

        // Main Slider Translation Events
        'main_slider_translation.created' => [
            'Modules\Settings\Events\MainSliderTranslationEvents@mainsliderTranslationCreated',
        ],
        'main_slider_translation.updated' => [
            'Modules\Settings\Events\MainSliderTranslationEvents@mainsliderTranslationUpdated',
        ],
        'main_slider_translation.saved' => [
            'Modules\Settings\Events\MainSliderTranslationEvents@mainsliderTranslationSaved',
        ],
        'main_slider_translation.deleted' => [
            'Modules\Settings\Events\MainSliderTranslationEvents@mainsliderTranslationDeleted',
        ],
        'main_slider_translation.restored' => [
            'Modules\Settings\Events\MainSliderTranslationEvents@mainsliderTranslationRestored',
        ],

        // Top Agent Events
        'top_agent.created' => [
            'Modules\Settings\Events\TopAgentEvents@topAgentCreated',
        ],
        'top_agent.updated' => [
            'Modules\Settings\Events\TopAgentEvents@topAgentUpdated',
        ],
        'top_agent.saved' => [
            'Modules\Settings\Events\TopAgentEvents@topAgentSaved',
        ],
        'top_agent.deleted' => [
            'Modules\Settings\Events\TopAgentEvents@topAgentDeleted',
        ],
        'top_agent.restored' => [
            'Modules\Settings\Events\TopAgentEvents@topAgentRestored',
        ],

        // How work Events
        'how_work.created' => [
            'Modules\Settings\Events\HowWorkEvents@howWorkCreated',
        ],
        'how_work.updated' => [
            'Modules\Settings\Events\HowWorkEvents@howWorkUpdated',
        ],
        'how_work.saved' => [
            'Modules\Settings\Events\HowWorkEvents@howWorkSaved',
        ],
        'how_work.deleted' => [
            'Modules\Settings\Events\HowWorkEvents@howWorkDeleted',
        ],
        'how_work.restored' => [
            'Modules\Settings\Events\HowWorkEvents@howWorkRestored',
        ],

        // How work Translation Events
        'how_work_translation.created' => [
            'Modules\Settings\Events\HowWorkTranslationEvents@howWorkTranslationCreated',
        ],
        'how_work_translation.updated' => [
            'Modules\Settings\Events\HowWorkTranslationEvents@howWorkTranslationUpdated',
        ],
        'how_work_translation.saved' => [
            'Modules\Settings\Events\HowWorkTranslationEvents@howWorkTranslationSaved',
        ],
        'how_work_translation.deleted' => [
            'Modules\Settings\Events\HowWorkTranslationEvents@howWorkTranslationDeleted',
        ],
        'how_work_translation.restored' => [
            'Modules\Settings\Events\HowWorkTranslationEvents@howWorkTranslationRestored',
        ],
    ];
}
