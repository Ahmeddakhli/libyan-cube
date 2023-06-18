<?php

namespace Modules\CMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\Event;
use App\Language;
use App;
use Cache;
use Wildside\Userstamps\Userstamps;
use App\Media;
use App\User;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\File;

class CmsManagement extends Model implements HasMedia
{
    use SoftDeletes, SoftCascadeTrait, LogsActivity, Userstamps, HasMediaTrait;

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

    protected $table = 'cms_managements';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','type','created_at', 'updated_at'
    ];

    protected $appends = [
        'title', 'default_title', 'description', 'default_description'
    ];

    // protected $softCascade = ['translations'];
    // Deleting translations manually to overcome laravel issue with composite primary key
    protected $softCascade = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates = ['deleted_at'];
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = [];
    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $ignoreChangedAttributes = [];
    protected static $logOnlyDirty = true;
    protected static $logName = 'cms_managements_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return $this->translations->first() ? "CMS Managements " . $this->translations->first()->title . " has been {$eventName}" : "Cms Management #" . $this->id . " has been {$eventName}";
    }

    public function getTitleAttribute()
    {
        $cms_management = $this;
        return Cache::rememberForever('cms_management_' . $this->id . '_title_' . App::getLocale(), function () use ($cms_management) {
            $cms_management = $cms_management->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $cms_management ? $cms_management->title : null;
        });
    }
    public function getDescriptionAttribute()
    {
        $cms_management = $this;
        return Cache::rememberForever('cms_management_' . $this->id . '_description_' . App::getLocale(), function () use ($cms_management) {
            $cms_management = $cms_management->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $cms_management ? $cms_management->description : null;
        });
    }

    public function getDefaultTitleAttribute()
    {
        $cms_management = $this;
        return Cache::rememberForever('cms_management_' . $this->id . '_default_title', function () use ($cms_management) {
            $cms_management = $cms_management->translations->where('language_id', Language::where('code', 'en')->first()->id)->first();
            return $cms_management ? $cms_management->title : null;
        });
    }
    public function getDefaultDescriptionAttribute()
    {
        $cms_management = $this;
        return Cache::rememberForever('cms_management_' . $this->id . '_default_description', function () use ($cms_management) {
            $cms_management = $cms_management->translations->where('language_id', Language::where('code', 'en')->first()->id)->first();
            return $cms_management ? $cms_management->description : null;
        });
    }
    public function translations()
    {
        return $this->hasMany('Modules\CMS\CmsManagementTranslation', 'cms_management_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (CmsManagement $cms_management) {
            Event::dispatch('cms_management.created', $cms_management);
        });
        static::updated(function (CmsManagement $cms_management) {
            Event::dispatch('cms_management.updated', $cms_management);
        });
        static::saved(function (CmsManagement $cms_management) {
            Event::dispatch('cms_management.saved', $cms_management);
        });
        static::deleted(function (CmsManagement $cms_management) {
            Event::dispatch('cms_management.deleted', $cms_management);
        });
        static::restored(function (CmsManagement $cms_management) {
            Event::dispatch('cms_management.restored', $cms_management);
        });
    }
}
