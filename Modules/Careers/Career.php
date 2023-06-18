<?php

namespace Modules\Careers;

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

class Career extends Model implements HasMedia
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

    protected $table = 'careers';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','slug', 'created_at', 'updated_at', 'is_featured', 'number_of_available_vacancies'
    ];

    protected $appends = [
        'value', 'description','default_value', 'default_description', 'meta_title', 'meta_description'
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
    protected static $logName = 'career_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return $this->translations->first() ? "Career " . $this->translations->first()->title . " has been {$eventName}" : "Career #" . $this->id . " has been {$eventName}";
    }

    public function getValueAttribute()
    {
        $career = $this;
        return Cache::rememberForever('careers_'.$this->id.'_value_'.App::getLocale(), function() use ($career) {
            $career = $career->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $career ? $career->title : null;
        });
    }

    public function getDescriptionAttribute()
    {
        $career = $this;
        return Cache::rememberForever('careers_'.$this->id.'_description_'.App::getLocale(), function() use ($career) {
            $career = $career->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $career ? $career->description : null;
        });
    }

    public function getDefaultValueAttribute()
    {
        $career = $this;
        return Cache::rememberForever('careers_'.$this->id.'_value_'.'default', function() use ($career) {
            $career = $career->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $career ? $career->title : null;
        });
    }

    public function getDefaultDescriptionAttribute()
    {
        $career = $this;
        return Cache::rememberForever('careers_'.$this->id.'_description_'.'default', function() use ($career) {
            $career = $career->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $career ? $career->description : null;
        });
    }

    public function getMetaDescriptionAttribute()
    {
        $career = $this;
        return Cache::rememberForever('careers_'.$this->id.'_meta_description_'.App::getLocale(), function() use ($career) {
            $career = $career->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $career ? $career->meta_description : null;
        });
    }
    public function getMetaTitleAttribute()
    {
        $career = $this;
        return Cache::rememberForever('careers_'.$this->id.'_meta_title_'.App::getLocale(), function() use ($career) {
            $career = $career->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $career ? $career->meta_title : null;
        });
    }


    public function translations()
    {
        return $this->hasMany('Modules\Careers\CareerTranslation', 'career_id', 'id');
    }

    // Laravel Media Library
    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection(request()->getHttpHost() . ',career,careers,' . $this->id . ',' . 'attachments')
            ->acceptsFile(function (File $file) {
                return in_array($file->mimeType, array(
                    'pdf', 'application/pdf', 'csv', 'text/csv', 'txt', 'text/plain', // Other Files
                    'doc', 'application/msword', 'docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'pptx', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', // Microsoft Office
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

        static::created(function (Career $career) {
            Event::dispatch('career.created', $career);
        });
        static::updated(function (Career $career) {
            Event::dispatch('career.updated', $career);
        });
        static::saved(function (Career $career) {
            Event::dispatch('career.saved', $career);
        });
        static::deleted(function (Career $career) {
            Event::dispatch('career.deleted', $career);
        });
        static::restored(function (Career $career) {
            Event::dispatch('career.restored', $career);
        });
    }
}
