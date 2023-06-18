<?php

namespace Modules\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\HasCompositePrimaryKey;
use Illuminate\Support\Facades\Event;
use Cache;
use Wildside\Userstamps\Userstamps;

class ServiceTranslation extends Model
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

    protected $table = 'service_trans';
    protected $primaryKey = ['service_id', 'language_id'];
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'service_id', 'language_id', 'title','description','meta_title', 'meta_description', 'created_at', 'updated_at'
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
    protected static $logName = 'service_translation_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Service translation ".$this->title." has been {$eventName}";
    }

    public function service()
    {
        return $this->belongsTo('Modules\Services\Service', 'service_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo('App\Language', 'language_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (ServiceTranslation $service_translation) {
            Event::dispatch('service_translation.created', $service_translation);
        });
        static::updated(function (ServiceTranslation $service_translation) {
            Event::dispatch('service_translation.updated', $service_translation);
        });
        static::saved(function (ServiceTranslation $service_translation) {
            Event::dispatch('service_translation.saved', $service_translation);
        });
        static::deleted(function (ServiceTranslation $service_translation) {
            Event::dispatch('service_translation.deleted', $service_translation);
        });
    }
}
