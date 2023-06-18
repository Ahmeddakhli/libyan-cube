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

class IPhaseTranslation extends Model
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

    protected $table = 'i_phase_trans';
    protected $primaryKey = ['i_phase_id', 'language_id'];
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'i_phase_id', 'language_id', 'name', 'description', 'created_at', 'updated_at'
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
    protected static $logName = 'phase_translation_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Phase Translation ".$this->name." has been {$eventName}";
    }

    public function iPhase()
    {
        return $this->belongsTo('Modules\Inventory\IPhase', 'i_phase_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo('App\Language', 'language_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (IPhaseTranslation $Phase_translation) {
            Event::dispatch('phase_translation.created', $Phase_translation);
        });
        static::updated(function (IPhaseTranslation $Phase_translation) {
            Event::dispatch('phase_translation.updated', $Phase_translation);
        });
        static::saved(function (IPhaseTranslation $Phase_translation) {
            Event::dispatch('phase_translation.saved', $Phase_translation);
        });
        static::deleted(function (IPhaseTranslation $Phase_translation) {
            Event::dispatch('phase_translation.deleted', $Phase_translation);
        });
        static::restored(function (IPhaseTranslation $Phase_translation) {
            Event::dispatch('phase_translation.restored', $Phase_translation);
        });
    }
}
