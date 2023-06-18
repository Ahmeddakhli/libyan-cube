<?php

namespace Modules\Testimonials;

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

class Testimonial extends Model implements HasMedia
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

    protected $table = 'testimonials';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'is_featured', 'created_at', 'updated_at'
    ];

    protected $appends = [
        'value', 'description','default_value', 'default_description'
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
    protected static $logName = 'testimonial_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return $this->translations->first() ? "Testimonial " . $this->translations->first()->title . " has been {$eventName}" : "Testimonial #" . $this->id . " has been {$eventName}";
    }

    public function getValueAttribute()
    {
        $testimonial = $this;
        return Cache::rememberForever('testimonials_'.$this->id.'_value_'.App::getLocale(), function() use ($testimonial) {
            $testimonial = $testimonial->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $testimonial ? $testimonial->title : null;
        });
    }

    public function getDescriptionAttribute()
    {
        $testimonial = $this;
        return Cache::rememberForever('testimonials_'.$this->id.'_description_'.App::getLocale(), function() use ($testimonial) {
            $testimonial = $testimonial->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $testimonial ? $testimonial->description : null;
        });
    }

    public function getDefaultValueAttribute()
    {
        $testimonial = $this;
        return Cache::rememberForever('testimonials_'.$this->id.'_value_'.'default', function() use ($testimonial) {
            $testimonial = $testimonial->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $testimonial ? $testimonial->title : null;
        });
    }

    public function getDefaultDescriptionAttribute()
    {
        $testimonial = $this;
        return Cache::rememberForever('testimonials_'.$this->id.'_description_'.'default', function() use ($testimonial) {
            $testimonial = $testimonial->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $testimonial ? $testimonial->description : null;
        });
    }


    public function translations()
    {
        return $this->hasMany('Modules\Testimonials\TestimonialTranslation', 'testimonial_id', 'id');
    }

    // Laravel Media Library
    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection(request()->getHttpHost() . ',testimonials,testimonials,' . $this->id . ',' . 'attachments')
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

        static::created(function (Testimonial $testimonial) {
            Event::dispatch('testimonial.created', $testimonial);
        });
        static::updated(function (Testimonial $testimonial) {
            Event::dispatch('testimonial.updated', $testimonial);
        });
        static::saved(function (Testimonial $testimonial) {
            Event::dispatch('testimonial.saved', $testimonial);
        });
        static::deleted(function (Testimonial $testimonial) {
            Event::dispatch('testimonial.deleted', $testimonial);
        });
        static::restored(function (Testimonial $testimonial) {
            Event::dispatch('testimonial.restored', $testimonial);
        });
    }
}
