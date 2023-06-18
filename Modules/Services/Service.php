<?php

namespace Modules\Services;

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
use App\User;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\File;

class Service extends Model implements HasMedia
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

    protected $table = 'services';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','is_featured','icon', 'created_at', 'updated_at'
    ];

    protected $appends = [
        'value','default_value', 'description','default_description', 'meta_title', 'meta_description'
    ];

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
    protected static $logName = 'service_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return $this->translations->first() ? "service " . $this->translations->first()->title . " has been {$eventName}" : "service #" . $this->id . " has been {$eventName}";
    }

    public function getValueAttribute()
    {
        $service = $this;
        return Cache::rememberForever('service_' . $this->id . '_value_' . App::getLocale(), function () use ($service) {
            $service = $service->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $service ? $service->title : null;
        });
    }

    public function getDefaultValueAttribute()
    {
        $service = $this;
        return Cache::rememberForever('service_' . $this->id . '_value_' . 'default', function () use ($service) {
            $service = $service->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $service ? $service->title : null;
        });
    }
    public function getDescriptionAttribute()
    {
        $service = $this;
        return Cache::rememberForever('service_' . $this->id . '_description_' . App::getLocale(), function () use ($service) {
            $service = $service->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $service ? $service->description : null;
        });
    }

    public function getDefaultDescriptionAttribute()
    {
        $service = $this;
        return Cache::rememberForever('service_' . $this->id . '_description_' . 'default', function () use ($service) {
            $service = $service->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $service ? $service->description : null;
        });
    }
    public function getMetaTitleAttribute()
    {
        $service = $this;
        return Cache::rememberForever('service_' . $this->id . '_meta_title_' . App::getLocale(), function () use ($service) {
            $service = $service->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $service ? $service->meta_title : null;
        });
    }

    public function getMetaDescriptionAttribute()
    {
        $service = $this;
        return Cache::rememberForever('service_' . $this->id . '_meta_description_' . App::getLocale(), function () use ($service) {
            $service = $service->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $service ? $service->meta_description : null;
        });
    }

    public function translations()
    {
        return $this->hasMany('Modules\Services\ServiceTranslation', 'service_id', 'id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    // Laravel Media Library
    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection(request()->getHttpHost() . ',services,' . $this->id . ',' . 'attachments')
            ->acceptsFile(function (File $file) {
                return in_array($file->mimeType, array(
                    'tiff', 'image/tiff', 'jpeg', 'image/jpeg', 'gif', 'image/gif', 'png', 'image/png', // Images
                ));
            })
            ->useDisk('public');
    }

    // Handle IS Featured 
    public function setIsFeaturedAttribute($value)
    {
        if ($value === "on") {
            $this->attributes['is_featured'] = 1;
        } else {
            $this->attributes['is_featured'] = 0;
        }
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', 1);
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (Service $service) {
            Event::dispatch('service.created', $service);
        });
        static::updated(function (Service $service) {
            Event::dispatch('service.updated', $service);
        });
        static::saved(function (Service $service) {
            Event::dispatch('service.saved', $service);
        });
        static::deleted(function (Service $service) {
            Event::dispatch('service.deleted', $service);
        });
        static::restored(function (Service $service) {
            Event::dispatch('service.restored', $service);
        });
    }
}
