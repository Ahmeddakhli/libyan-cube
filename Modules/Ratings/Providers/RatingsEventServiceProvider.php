<?php

namespace Modules\Ratings\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class RatingsEventServiceProvider extends ServiceProvider
{
    protected $listen = [
         // Rating Events
        'rating.created' => [
            'Modules\Ratings\Events\RatingEvents@ratingCreated',
        ],
        'rating.updated' => [
            'Modules\Ratings\Events\RatingEvents@ratingUpdated',
        ],
        'rating.saved' => [
            'Modules\Ratings\Events\RatingEvents@ratingSaved',
        ],
        'rating.deleted' => [
            'Modules\Ratings\Events\RatingEvents@ratingDeleted',
        ],
        'rating.restored' => [
            'Modules\Ratings\Events\RatingEvents@ratingRestored',
        ],
    ];
}