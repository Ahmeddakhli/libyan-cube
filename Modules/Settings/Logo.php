<?php

namespace Modules\Settings;

use Illuminate\Database\Eloquent\Model;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Facades\Event;

class Logo extends Model
{
    use SoftDeletes, SoftCascadeTrait, LogsActivity, Userstamps;

    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'updated_by';
    const DELETED_BY = 'deleted_by';

    protected $table = 'logos';
    protected $primaryKey = 'id';
    public $timestamps = true;

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
        'id', 'key', 'value', 'type', 'created_at', 'updated_at'
    ];

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
    protected static $logName = 'logo_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Logo ".$this->type." of ID #".$this->id." has been {$eventName}";
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (Logo $logo) {
            Event::dispatch('logo.created', $logo);
        });
        static::updated(function (Logo $logo) {
            Event::dispatch('logo.updated', $logo);
        });
        static::saved(function (Logo $logo) {
            Event::dispatch('logo.saved', $logo);
        });
        static::deleted(function (Logo $logo) {
            Event::dispatch('logo.deleted', $logo);
        });
        static::restored(function (Logo $logo) {
            Event::dispatch('logo.restored', $logo);
        });
    }
}
