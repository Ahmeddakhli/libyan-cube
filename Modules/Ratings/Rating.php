<?php

namespace Modules\Ratings;

use Illuminate\Database\Eloquent\Model;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Facades\Event;

class Rating extends Model
{
    use SoftDeletes, SoftCascadeTrait, LogsActivity, Userstamps;

    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'updated_by';
    const DELETED_BY = 'deleted_by';

    /**
     * Get the class being used to provide a User.
     *
     * @return string
     */
    protected function getUserClass()
    {
        return "App\User";
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'rate', 'rateable', 'rateable_type', 'created_at', 'updated_at'
    ];

    protected $dates = ['deleted_at'];
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = [];
    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $ignoreChangedAttributes = [];
    protected static $logOnlyDirty = true;
    protected static $logName = 'rating_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Rating ".$this->id." has been {$eventName}";
    }

    public function rateable()
    {
        return $this->morphTo();
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (Rating $rating) {
            Event::dispatch('rating.created', $rating);
        });
        static::updated(function (Rating $rating) {
            Event::dispatch('rating.updated', $rating);
        });
        static::saved(function (Rating $rating) {
            Event::dispatch('rating.saved', $rating);
        });
        static::deleted(function (Rating $rating) {
            Event::dispatch('rating.deleted', $rating);
        });
        static::restored(function (Rating $rating) {
            Event::dispatch('rating.restored', $rating);
        });
    }
}
