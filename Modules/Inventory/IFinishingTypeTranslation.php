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

class IFinishingTypeTranslation extends Model
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

    protected $table = 'i_finishing_type_trans';
    protected $primaryKey = ['i_finishing_type_id', 'language_id'];
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'i_finishing_type_id', 'language_id', 'finishing_type', 'created_at', 'updated_at'
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
    protected static $logName = 'i_finishing_type_translation_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Finishing Type Translation ".$this->finishing_type." has been {$eventName}";
    }

    public function iFinishingType()
    {
        return $this->belongsTo('Modules\Inventory\IFinishingType', 'i_finishing_type_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo('App\Language', 'language_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (IFinishingTypeTranslation $i_finishing_type_translation) {
            Event::dispatch('i_finishing_type_translation.created', $i_finishing_type_translation);
        });
        static::updated(function (IFinishingTypeTranslation $i_finishing_type_translation) {
            Event::dispatch('i_finishing_type_translation.updated', $i_finishing_type_translation);
        });
        static::saved(function (IFinishingTypeTranslation $i_finishing_type_translation) {
            Event::dispatch('i_finishing_type_translation.saved', $i_finishing_type_translation);
        });
        static::deleted(function (IFinishingTypeTranslation $i_finishing_type_translation) {
            Event::dispatch('i_finishing_type_translation.deleted', $i_finishing_type_translation);
        });
        static::restored(function (IFinishingTypeTranslation $i_finishing_type_translation) {
            Event::dispatch('i_finishing_type_translation.restored', $i_finishing_type_translation);
        });
    }
}
