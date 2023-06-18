<?php

namespace Modules\Inventory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\Event;
use App\Language;
use App;
use Cache;
use Wildside\Userstamps\Userstamps;
use App\User;

class IPublishTime extends Model
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

    protected $table = 'i_publish_times';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'i_unit_id', 'from', 'to', 'created_at', 'updated_at'
    ];

    protected $appends = [
        //
    ];

    // protected $softCascade = ['translations'];
    // Deleting translations manually to overcome laravel issue with composite primary key
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
    protected static $logName = 'i_publish_time_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Publish time ".$this->id." for unit ".($this->unit ? $this->unit->unit_number : '')." has been {$eventName}";
    }

    public function unit()
    {
        return $this->belongsTo('Modules\Inventory\IUnit', 'i_unit_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (IPublishTime $ipublish_time) {
            Event::dispatch('i_publish_time.created', $ipublish_time);
        });
        static::updated(function (IPublishTime $ipublish_time) {
            Event::dispatch('i_publish_time.updated', $ipublish_time);
        });
        static::saved(function (IPublishTime $ipublish_time) {
            Event::dispatch('i_publish_time.saved', $ipublish_time);
        });
        static::deleted(function (IPublishTime $ipublish_time) {
            Event::dispatch('i_publish_time.deleted', $ipublish_time);
        });
        static::restored(function (IPublishTime $ipublish_time) {
            Event::dispatch('i_publish_time.restored', $ipublish_time);
        });
    }
}
