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

class UnitTypeTranslation extends Model
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

    protected $table = 'i_unit_type_trans';
    protected $primaryKey = ['i_unit_type_id', 'language_id'];
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'i_unit_type_id', 'language_id', 'unit_type','description','created_at', 'updated_at'
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
    protected static $logName = 'i_unit_type_translation_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Unit Type Translation ".$this->unit_type." has been {$eventName}";
    }

    public function unitType()
    {
        return $this->belongsTo('Modules\Inventory\UnitType', 'i_unit_type_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo('App\Language', 'language_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (UnitTypeTranslation $i_unit_type_translation) {
            Event::dispatch('i_unit_type_translation.created', $i_unit_type_translation);
        });
        static::updated(function (UnitTypeTranslation $i_unit_type_translation) {
            Event::dispatch('i_unit_type_translation.updated', $i_unit_type_translation);
        });
        static::saved(function (UnitTypeTranslation $i_unit_type_translation) {
            Event::dispatch('i_unit_type_translation.saved', $i_unit_type_translation);
        });
        static::deleted(function (UnitTypeTranslation $i_unit_type_translation) {
            Event::dispatch('i_unit_type_translation.deleted', $i_unit_type_translation);
        });
    }
}
