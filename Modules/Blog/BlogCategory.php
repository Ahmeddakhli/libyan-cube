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

class BlogCategory extends Model implements HasMedia
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

    protected $table = 'blog_categories';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'order','slug', 'created_at', 'updated_at',
    ];

    protected $appends = [
        'value','default_value'
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
        return $this->translations->first() ? "Blog Category " . $this->translations->first()->title . " has been {$eventName}" : "Blog Category #" . $this->id . " has been {$eventName}";
    }

    public function getValueAttribute()
    {
        $blog_category = $this;
        return Cache::rememberForever('blog_category' . $this->id . '_value_' . App::getLocale(), function () use ($blog_category) {
            $blog_category = $blog_category->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $blog_category ? $blog_category->title : null;
        });
    }
    public function getDefaultValueAttribute()
    {
        $blog_category = $this;
        return Cache::rememberForever('blog_category' . $this->id . '_value_' . 'en', function () use ($blog_category) {
            $blog_category = $blog_category->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $blog_category ? $blog_category->title : null;
        });
    }


    public function translations()
    {
        return $this->hasMany('Modules\Blog\BlogCategoryTranslation', 'blog_category_id', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(BlogCategory::class,'blogs_categories','blog_category_id','blog_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public static function boot()
    {
        parent::boot();

        static::created(function (BlogCategory $blog_category) {
            Event::dispatch('blog_category.created', $blog_category);
        });
        static::updated(function (BlogCategory $blog_category) {
            Event::dispatch('blog_category.updated', $blog_category);
        });
        static::saved(function (BlogCategory $blog_category) {
            Event::dispatch('blog_category.saved', $blog_category);
        });
        static::deleted(function (BlogCategory $blog_category) {
            Event::dispatch('blog_category.deleted', $blog_category);
        });
        static::restored(function (BlogCategory $blog_category) {
            Event::dispatch('blog_category.restored', $blog_category);
        });
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order', 'asc');
        });
    }
}
