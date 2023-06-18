<?php

namespace Modules\SEO;

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

class Seo extends Model implements HasMedia
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

    protected $table = 'seo';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'show_short_description', 'page', 'created_at', 'updated_at',
    ];

    protected $appends = [
        'value', 'description', 'default_value', 'default_description', 'key_words', 'default_key_words', 'short_description', 'default_short_description','popup_contact_us_title','default_popup_contact_us_title'
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
    protected static $logName = 'seo_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return $this->translations->first() ? "seo " . $this->translations->first()->title . " has been {$eventName}" : "seo #" . $this->id . " has been {$eventName}";
    }

    public function getValueAttribute()
    {
        $seo = $this;
        return Cache::rememberForever('seo_' . $this->id . '_value_' . App::getLocale(), function () use ($seo) {
            $seo = $seo->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $seo ? $seo->title : null;
        });
    }

    public function getDescriptionAttribute()
    {
        $seo = $this;
        return Cache::rememberForever('seo_' . $this->id . '_description_' . App::getLocale(), function () use ($seo) {
            $seo = $seo->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $seo ? $seo->description : null;
        });
    }

    public function getDefaultValueAttribute()
    {
        $seo = $this;
        return Cache::rememberForever('seo_' . $this->id . '_value_' . 'default', function () use ($seo) {
            $seo = $seo->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $seo ? $seo->title : null;
        });
    }

    public function getDefaultDescriptionAttribute()
    {
        $seo = $this;
        return Cache::rememberForever('seo_' . $this->id . '_description_' . 'default', function () use ($seo) {
            $seo = $seo->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $seo ? $seo->description : null;
        });
    }

    public function getKeyWordsAttribute()
    {
        $seo = $this;
        return Cache::rememberForever('seo_' . $this->id . '_key_words_' . App::getLocale(), function () use ($seo) {
            $seo = $seo->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $seo ? $seo->key_words : null;
        });
    }

    public function getDefaultKeyWordsAttribute()
    {
        $seo = $this;
        return Cache::rememberForever('seo_' . $this->id . '_key_words_' . 'default', function () use ($seo) {
            $seo = $seo->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $seo ? $seo->key_words : null;
        });
    }

    public function getPopupContactUsTitleAttribute()
    {
        $seo = $this;
        return Cache::rememberForever('seo_' . $this->id . '_popup_contact_us_title_' . App::getLocale(), function () use ($seo) {
            $seo = $seo->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $seo ? $seo->popup_contact_us_title : null;
        });
    }

    public function getDefaultPopupContactUsTitleAttribute()
    {
        $seo = $this;
        return Cache::rememberForever('seo_' . $this->id . '_popup_contact_us_title_' . 'default', function () use ($seo) {
            $seo = $seo->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $seo ? $seo->popup_contact_us_title : null;
        });
    }

    public function getShortDescriptionAttribute()
    {
        $seo = $this;
        return Cache::rememberForever('seo_' . $this->id . '_short_description_' . App::getLocale(), function () use ($seo) {
            $seo = $seo->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $seo ? $seo->short_description : null;
        });
    }

    public function getDefaultShortDescriptionAttribute()
    {
        $seo = $this;
        return Cache::rememberForever('seo_' . $this->id . '_short_description_' . 'default', function () use ($seo) {
            $seo = $seo->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $seo ? $seo->short_description : null;
        });
    }


    public function translations()
    {
        return $this->hasMany('Modules\SEO\SeoTranslation', 'seo_id', 'id');
    }

    // Handle IS Featured 
    public function setIsFeaturedAttribute($value)
    {
        if ($value === "on") {
            $this->attributes['show_short_description'] = 1;
        } else {
            $this->attributes['show_short_description'] = 0;
        }
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (Seo $seo) {
            Event::dispatch('seo.created', $seo);
        });
        static::updated(function (Seo $seo) {
            Event::dispatch('seo.updated', $seo);
        });
        static::saved(function (Seo $seo) {
            Event::dispatch('seo.saved', $seo);
        });
        static::deleted(function (Seo $seo) {
            Event::dispatch('seo.deleted', $seo);
        });
        static::restored(function (Seo $seo) {
            Event::dispatch('seo.restored', $seo);
        });
    }
}
