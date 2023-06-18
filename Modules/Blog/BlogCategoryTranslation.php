<?php

namespace Modules\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\HasCompositePrimaryKey;
use Illuminate\Support\Facades\Event;
use Cache;
use Wildside\Userstamps\Userstamps;

class BlogCategoryTranslation extends Model
{
    use HasCompositePrimaryKey, SoftDeletes, SoftCascadeTrait, LogsActivity, Userstamps;

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

    protected $table = 'blog_category_trans';
    protected $primaryKey = ['blog_category_id', 'language_id'];
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'blog_id', 'language_id', 'title','created_at', 'updated_at'
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
    protected static $logName = 'blog_translation_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Blog Category Translation ".$this->title." has been {$eventName}";
    }

    public function blogCategory()
    {
        return $this->belongsTo('Modules\Blog\BlogCategory', 'blog_category_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo('App\Language', 'language_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (BlogCategoryTranslation $blog_category_translation) {
            Event::dispatch('blog_translation.created', $blog_category_translation);
        });
        static::updated(function (BlogCategoryTranslation $blog_category_translation) {
            Event::dispatch('blog_translation.updated', $blog_category_translation);
        });
        static::saved(function (BlogCategoryTranslation $blog_category_translation) {
            Event::dispatch('blog_translation.saved', $blog_category_translation);
        });
        static::deleted(function (BlogCategoryTranslation $blog_category_translation) {
            Event::dispatch('blog_translation.deleted', $blog_category_translation);
        });
        static::restored(function (BlogCategoryTranslation $blog_category_translation) {
            Event::dispatch('blog_translation.restored', $blog_category_translation);
        });
    }
}
