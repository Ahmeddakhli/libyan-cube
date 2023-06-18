<?php

namespace Modules\Inventory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\HasCompositePrimaryKey;
use Illuminate\Support\Facades\Event;
use Cache;
use Wildside\Userstamps\Userstamps;

class IFurnishingStatusTranslation extends Model
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

    protected $table = 'i_furnishing_status_trans';
    protected $primaryKey = ['i_fur_status_id', 'language_id'];
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'i_fur_status_id', 'language_id', 'furnishing_status', 'created_at', 'updated_at'
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
    protected static $logName = 'i_furnishing_status_translation_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Furnishing Status Translation ".$this->furnishing_status." has been {$eventName}";
    }

    public function iFurnishingStatus()
    {
        return $this->belongsTo('Modules\Inventory\IFurnishingStatus', 'i_fur_status_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo('App\Language', 'language_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (IFurnishingStatusTranslation $ifurnishing_status_translation) {
            Event::dispatch('i_furnishing_status_translation.created', $ifurnishing_status_translation);
        });
        static::updated(function (IFurnishingStatusTranslation $ifurnishing_status_translation) {
            Event::dispatch('i_furnishing_status_translation.updated', $ifurnishing_status_translation);
        });
        static::saved(function (IFurnishingStatusTranslation $ifurnishing_status_translation) {
            Event::dispatch('i_furnishing_status_translation.saved', $ifurnishing_status_translation);
        });
        static::deleted(function (IFurnishingStatusTranslation $ifurnishing_status_translation) {
            Event::dispatch('i_furnishing_status_translation.deleted', $ifurnishing_status_translation);
        });
        static::restored(function (IFurnishingStatusTranslation $ifurnishing_status_translation) {
            Event::dispatch('i_furnishing_status_translation.restored', $ifurnishing_status_translation);
        });
    }
}
