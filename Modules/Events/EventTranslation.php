<?php

namespace Modules\Events;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\HasCompositePrimaryKey;
use Illuminate\Support\Facades\Event;
use Cache;
use Wildside\Userstamps\Userstamps;

class EventTranslation extends Model
{
    use HasCompositePrimaryKey, LogsActivity, Userstamps;

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

    protected $table = 'event_trans';
    protected $primaryKey = ['event_id', 'language_id'];
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event_id', 'language_id', 'title', 'description', 'meta_title', 'meta_description', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    protected $softCascade = [];

    protected $dates = ['deleted_at'];
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = [];
    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $ignoreChangedAttributes = [];
    protected static $logOnlyDirty = true;
    protected static $logName = 'event_translation_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Event Translation " . $this->title . " has been {$eventName}";
    }

    public function event()
    {
        return $this->belongsTo('Modules\Events\Event', 'event_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo('App\Language', 'language_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (EventTranslation $event_translation) {
            Event::dispatch('event_translation.created', $event_translation);
        });
        static::updated(function (EventTranslation $event_translation) {
            Event::dispatch('event_translation.updated', $event_translation);
        });
        static::saved(function (EventTranslation $event_translation) {
            Event::dispatch('event_translation.saved', $event_translation);
        });
        static::deleted(function (EventTranslation $event_translation) {
            Event::dispatch('event_translation.deleted', $event_translation);
        });
    }
}
