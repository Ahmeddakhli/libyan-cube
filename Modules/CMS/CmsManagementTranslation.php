<?php

namespace Modules\CMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\HasCompositePrimaryKey;
use Illuminate\Support\Facades\Event;
use Cache;
use Wildside\Userstamps\Userstamps;

class CmsManagementTranslation extends Model
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

    protected $table = 'cms_management_trans';
    protected $primaryKey = ['cms_management_id', 'language_id'];
    public $incrementing = false;

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cms_management_id', 'language_id', 'title', 'description', 'created_at', 'updated_at'
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
    protected static $logName = 'cms_management_translation_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Cms management Translation " . $this->title . " has been {$eventName}";
    }

    public function cmsManagement()
    {
        return $this->belongsTo('Modules\CMS\CmsManagement', 'cms_management_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo('App\Language', 'language_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (CmsManagementTranslation $cms_management_translation) {
            Event::dispatch('cms_management_translation.created', $cms_management_translation);
        });
        static::updated(function (CmsManagementTranslation $cms_management_translation) {
            Event::dispatch('cms_management_translation.updated', $cms_management_translation);
        });
        static::saved(function (CmsManagementTranslation $cms_management_translation) {
            Event::dispatch('cms_management_translation.saved', $cms_management_translation);
        });
        static::deleted(function (CmsManagementTranslation $cms_management_translation) {
            Event::dispatch('cms_management_translation.deleted', $cms_management_translation);
        });
    }
}
