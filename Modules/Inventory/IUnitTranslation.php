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

class IUnitTranslation extends Model
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

    protected $table = 'i_unit_trans';
    protected $primaryKey = ['i_unit_id', 'language_id'];
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'i_unit_id', 'language_id', 'title', 'address','description','meta_title','meta_description', 'created_at', 'updated_at'
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
    protected static $logName = 'i_unit_translation_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Unit Translation ".$this->i_unit_id." has been {$eventName}";
    }

    public function iUnit()
    {
        return $this->belongsTo('Modules\Inventory\IUnit', 'i_unit_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo('App\Language', 'language_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (IUnitTranslation $i_unit_translation) {
            Event::dispatch('i_unit_translation.created', $i_unit_translation);
        });
        static::updated(function (IUnitTranslation $i_unit_translation) {
            Event::dispatch('i_unit_translation.updated', $i_unit_translation);
        });
        static::saved(function (IUnitTranslation $i_unit_translation) {
            Event::dispatch('i_unit_translation.saved', $i_unit_translation);
        });
        static::deleted(function (IUnitTranslation $i_unit_translation) {
            Event::dispatch('i_unit_translation.deleted', $i_unit_translation);
        });
        static::restored(function (IUnitTranslation $i_unit_translation) {
            Event::dispatch('i_unit_translation.restored', $i_unit_translation);
        });
    }
}
