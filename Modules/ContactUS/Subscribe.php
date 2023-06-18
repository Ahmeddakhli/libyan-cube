<?php

namespace Modules\ContactUS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Facades\Event;

class Subscribe extends Model
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
    protected $table = 'subscribes';
    protected $primaryKey = 'id';
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'email','created_at', 'updated_at'
    ];

    protected $appends = [];
    protected $softCascade = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates = ['deleted_at'];
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = [];
    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $ignoreChangedAttributes = [];
    protected static $logOnlyDirty = true;
    protected static $logName = 'subscribe_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Subscribe #" . $this->id . " has been {$eventName}";
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (Subscribe $subscribe) {
            Event::dispatch('subscribe.created', $subscribe);
        });
        static::updated(function (Subscribe $subscribe) {
            Event::dispatch('subscribe.updated', $subscribe);
        });
        static::saved(function (Subscribe $subscribe) {
            Event::dispatch('subscribe.saved', $subscribe);
        });
        static::deleted(function (Subscribe $subscribe) {
            Event::dispatch('subscribe.deleted', $subscribe);
        });
        static::restored(function (Subscribe $subscribe) {
            Event::dispatch('subscribe.restored', $subscribe);
        });
    }
}
