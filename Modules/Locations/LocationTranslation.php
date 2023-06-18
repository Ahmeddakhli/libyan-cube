<?php

namespace Modules\Locations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\HasCompositePrimaryKey;
use Illuminate\Support\Facades\Event;
use Cache;
use Wildside\Userstamps\Userstamps;

class LocationTranslation extends Model
{
    use HasCompositePrimaryKey, SoftDeletes, SoftCascadeTrait, LogsActivity, Userstamps;

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

    protected $table = 'location_trans';
    protected $primaryKey = ['location_id', 'language_id'];
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'location_id', 'language_id', 'name','description','second_title','meta_title','meta_description', 'created_at', 'updated_at'
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
    protected static $logName = 'location_translation_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Location Translation " . $this->name . " has been {$eventName}";
    }

    public function location()
    {
        return $this->belongsTo('Modules\Locations\Location', 'location_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo('App\Language', 'language_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (LocationTranslation $location_translation) {
            Event::dispatch('location_translation.created', $location_translation);
        });
        static::updated(function (LocationTranslation $location_translation) {
            Event::dispatch('location_translation.updated', $location_translation);
        });
        static::saved(function (LocationTranslation $location_translation) {
            Event::dispatch('location_translation.saved', $location_translation);
        });
        static::deleted(function (LocationTranslation $location_translation) {
            Event::dispatch('location_translation.deleted', $location_translation);
        });
        static::restored(function (LocationTranslation $location_translation) {
            Event::dispatch('location_translation.restored', $location_translation);
        });
    }
}
