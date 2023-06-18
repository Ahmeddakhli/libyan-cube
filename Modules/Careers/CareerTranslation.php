<?php

namespace Modules\Careers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\HasCompositePrimaryKey;
use Illuminate\Support\Facades\Event;
use Cache;
use Wildside\Userstamps\Userstamps;

class CareerTranslation extends Model
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

    protected $table = 'career_trans';
    protected $primaryKey = ['career_id', 'language_id'];
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'career_id', 'language_id', 'title', 'description', 'meta_title', 'meta_description', 'created_at', 'updated_at'
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
    protected static $logName = 'career_translation_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Career Translation ".$this->title." has been {$eventName}";
    }

    public function career()
    {
        return $this->belongsTo('Modules\Careers\Career', 'career_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo('App\Language', 'language_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (CareerTranslation $career_translation) {
            Event::dispatch('career_translation.created', $career_translation);
        });
        static::updated(function (CareerTranslation $career_translation) {
            Event::dispatch('career_translation.updated', $career_translation);
        });
        static::saved(function (CareerTranslation $career_translation) {
            Event::dispatch('career_translation.saved', $career_translation);
        });
        static::deleted(function (CareerTranslation $career_translation) {
            Event::dispatch('career_translation.deleted', $career_translation);
        });
    }
}
