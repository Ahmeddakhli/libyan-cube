<?php

namespace Modules\Meetings;

use Illuminate\Database\Eloquent\Model;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Facades\Event;

class Meeting extends Model
{
    use SoftCascadeTrait, SoftDeletes, LogsActivity, Userstamps;

    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'updated_by';
    const DELETED_BY = 'deleted_by';

    protected $table = 'meetings';
    protected $fillable = ['user_id', 'meeting_type', 'created_at', 'updated_at'];
    protected $softCascade = [];
    public $timestamps = true;

    /**
     * Meeting Types
     * - zoom_meeting
     */

    protected $dates = ['deleted_at'];
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = [];
    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $ignoreChangedAttributes = [];
    protected static $logOnlyDirty = true;
    protected static $logName = 'meeting_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Metting ".$this->meeting_type." has been {$eventName}";
    }

    public function user()
    {
        return $this->belongsTo('\App\User', 'user_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (Meeting $meeting) {
            Event::dispatch('meeting.created', $meeting);
        });
        static::updated(function (Meeting $meeting) {
            Event::dispatch('meeting.updated', $meeting);
        });
        static::saved(function (Meeting $meeting) {
            Event::dispatch('meeting.saved', $meeting);
        });
        static::deleted(function (Meeting $meeting) {
            Event::dispatch('meeting.deleted', $meeting);
        });
        static::restored(function (Meeting $meeting) {
            Event::dispatch('meeting.restored', $meeting);
        });
    }
}
