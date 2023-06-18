<?php

namespace Modules\Blog;

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

class Blog extends Model implements HasMedia
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

    protected $table = 'blogs';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'category_id','slug','video','published_at','published_by', 'created_at', 'updated_at', 'is_featured'
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
    protected static $logName = 'blog_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return $this->translations->first() ? "Blog " . $this->translations->first()->title . " has been {$eventName}" : "Blog #" . $this->id . " has been {$eventName}";
    }

    public function getValueAttribute()
    {
        $blog = $this;
        return Cache::rememberForever('blog_' . $this->id . '_value_' . App::getLocale(), function () use ($blog) {
            $blog = $blog->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $blog ? $blog->title : null;
        });
    }

    public function getDescriptionAttribute()
    {
        $blog = $this;
        return Cache::rememberForever('blog_' . $this->id . '_description_' . App::getLocale(), function () use ($blog) {
            $blog = $blog->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $blog ? $blog->description : null;
        });
    }

    public function getDefaultValueAttribute()
    {
        $blog = $this;
        return Cache::rememberForever('blog_' . $this->id . '_value_' . 'default', function () use ($blog) {
            $blog = $blog->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $blog ? $blog->title : null;
        });
    }

    public function getDefaultDescriptionAttribute()
    {
        $blog = $this;
        return Cache::rememberForever('blog_' . $this->id . '_description_' . 'default', function () use ($blog) {
            $blog = $blog->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $blog ? $blog->description : null;
        });
    }


    public function getMetaDescriptionAttribute()
    {
        $blog = $this;
        return Cache::rememberForever('blog_' . $this->id . '_meta_description_' . App::getLocale(), function () use ($blog) {
            $blog = $blog->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $blog ? $blog->meta_description : null;
        });
    }

    public function getMetaTitleAttribute()
    {
        $blog = $this;
        return Cache::rememberForever('blog_' . $this->id . '_meta_title_' . App::getLocale(), function () use ($blog) {
            $blog = $blog->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $blog ? $blog->meta_title : null;
        });
    }


    public function translations()
    {
        return $this->hasMany('Modules\Blog\BlogTranslation', 'blog_id', 'id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(BlogCategory::class,'blogs_categories','blog_id', 'blog_category_id');
    }

    // Laravel Media Library
    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection(request()->getHttpHost() . ',blogs,' . $this->id . ',' . 'attachments')
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

        static::created(function (Blog $blog) {
            Event::dispatch('blog.created', $blog);
        });
        static::updated(function (Blog $blog) {
            Event::dispatch('blog.updated', $blog);
        });
        static::saved(function (Blog $blog) {
            Event::dispatch('blog.saved', $blog);
        });
        static::deleted(function (Blog $blog) {
            Event::dispatch('blog.deleted', $blog);
        });
        static::restored(function (Blog $blog) {
            Event::dispatch('blog.restored', $blog);
        });
    }
}
