<?php

namespace Modules\About;

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

class About extends Model implements HasMedia
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

    protected $table = 'about';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'created_at', 'updated_at', 'is_featured', 'icon','link','image'
    ];

    protected $appends = [
        'value', 'description','default_value','default_description'
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
    protected static $logName = 'about_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return $this->translations->first() ? "About " . $this->translations->first()->title . " has been {$eventName}" : "About #" . $this->id . " has been {$eventName}";
    }

    public function getValueAttribute()
    {
        $about = $this;
        $lang_count = Language::count();
        if($lang_count){
            return Cache::rememberForever('about_'.$this->id.'_value_'.App::getLocale(), function() use ($about) {
                $about = $about->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
                return $about ? $about->title : null;
            });
        }else{
            return '';
        }
    }
    public function getDescriptionAttribute()
    {
        $about = $this;
        $lang_count = Language::count();
        if($lang_count){            
            return Cache::rememberForever('about_'.$this->id.'_description_'.App::getLocale(), function() use ($about) {
                $about = $about->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
                return $about ? $about->description : null;
            });
        }else{
            return '';
        }
    }
    
    public function getDefaultValueAttribute()
    {
        $about = $this;
        $lang_count = Language::count();
        if($lang_count){
            return Cache::rememberForever('about_'.$this->id.'_value_'.'en', function() use ($about) {
                $about = $about->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
                return $about ? $about->title : null;
            });
        }else{
            return '';
        }
    }
    public function getDefaultDescriptionAttribute()
    {
        $about = $this;
        $lang_count = Language::count();
        if($lang_count){            
            return Cache::rememberForever('about_'.$this->id.'_description_'.'en', function() use ($about) {
                $about = $about->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
                return $about ? $about->description : null;
            });
        }else{
            return '';
        }
    }

    public function translations()
    {
        return $this->hasMany('Modules\About\AboutTranslation', 'about_id', 'id');
    }
 
    // Laravel Media Library
    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection(request()->getHttpHost() . ',about,about,' . $this->id . ',' . 'attachments')
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

        static::created(function (About $about) {
            Event::dispatch('about.created', $about);
        });
        static::updated(function (About $about) {
            Event::dispatch('about.updated', $about);
        });
        static::saved(function (About $about) {
            Event::dispatch('about.saved', $about);
        });
        static::deleted(function (About $about) {
            Event::dispatch('about.deleted', $about);
        });
        static::restored(function (About $about) {
            Event::dispatch('about.restored', $about);
        });
    }
}
