<?php

namespace Modules\Events;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Language;
use App;
use Cache;
use Wildside\Userstamps\Userstamps;
use App\User;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\File;

class Event extends Model implements HasMedia
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

    protected $table = 'events';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'is_featured', 'start_date', 'end_date', 'created_at', 'updated_at'
    ];

    protected $appends = [
        'value', 'description', 'meta_title', 'meta_description'
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
    protected static $logName = 'event_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return $this->translations->first() ? "Event " . $this->translations->first()->title . " has been {$eventName}" : "Event #" . $this->id . " has been {$eventName}";
    }

    public function getValueAttribute()
    {
        $event = $this;
        return Cache::rememberForever('event_' . $this->id . '_value_' . App::getLocale(), function () use ($event) {
            $event = $event->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $event ? $event->title : null;
        });
    }

    public function getDescriptionAttribute()
    {
        $event = $this;
        return Cache::rememberForever('event_' . $this->id . '_description_' . App::getLocale(), function () use ($event) {
            $event = $event->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $event ? $event->description : null;
        });
    }

    public function getMetaDescriptionAttribute()
    {
        $event = $this;
        return Cache::rememberForever('event_' . $this->id . '_meta_description_' . App::getLocale(), function () use ($event) {
            $event = $event->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $event ? $event->meta_description : null;
        });
    }

    public function getMetaTitleAttribute()
    {
        $event = $this;
        return Cache::rememberForever('event_' . $this->id . '_meta_title_' . App::getLocale(), function () use ($event) {
            $event = $event->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $event ? $event->meta_title : null;
        });
    }

    public function translations()
    {
        return $this->hasMany('Modules\Events\EventTranslation', 'event_id', 'id');
    }

    // Laravel Media Library
    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection(request()->getHttpHost() . ',events,' . $this->id . ',' . 'attachments')
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

    public static function boot()
    {
        parent::boot();

        static::created(function (Event $event) {
            \Illuminate\Support\Facades\Event::dispatch('event.created', $event);
        });
        static::updated(function (Event $event) {
            \Illuminate\Support\Facades\Event::dispatch('event.updated', $event);
        });
        static::saved(function (Event $event) {
            \Illuminate\Support\Facades\Event::dispatch('event.saved', $event);
        });
        static::deleted(function (Event $event) {
            \Illuminate\Support\Facades\Event::dispatch('event.deleted', $event);
        });
        static::restored(function (Event $event) {
            \Illuminate\Support\Facades\Event::dispatch('event.restored', $event);
        });
    }
}
