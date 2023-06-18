<?php

namespace Modules\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\HasCompositePrimaryKey;
use Illuminate\Support\Facades\Event;
use Cache;
use Wildside\Userstamps\Userstamps;

class HowWorkTranslation extends Model
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

    protected $table = 'how_work_trans';
    protected $primaryKey = ['how_work_id', 'language_id'];
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'how_work_id', 'language_id', 'title','description', 'created_at', 'updated_at'
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
    protected static $logName = 'how_work_translation_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "How work translation " . $this->title . " has been {$eventName}";
    }

    public function mainSlider()
    {
        return $this->belongsTo('Modules\Settings\HowWork', 'how_work_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo('App\Language', 'language_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (HowWorkTranslation $how_work_translation) {
            Event::dispatch('how_work_translation.created', $how_work_translation);
        });
        static::updated(function (HowWorkTranslation $how_work_translation) {
            Event::dispatch('how_work_translation.updated', $how_work_translation);
        });
        static::saved(function (HowWorkTranslation $how_work_translation) {
            Event::dispatch('how_work_translation.saved', $how_work_translation);
        });
        static::deleted(function (HowWorkTranslation $how_work_translation) {
            Event::dispatch('how_work_translation.deleted', $how_work_translation);
        });
        static::restored(function (HowWorkTranslation $how_work_translation) {
            Event::dispatch('how_work_translation.restored', $how_work_translation);
        });
    }
   
}
