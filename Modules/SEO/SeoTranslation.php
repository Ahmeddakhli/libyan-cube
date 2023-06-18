<?php

namespace Modules\SEO;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\HasCompositePrimaryKey;
use Illuminate\Support\Facades\Event;
use Cache;
use Wildside\Userstamps\Userstamps;

class SeoTranslation extends Model
{
    use HasCompositePrimaryKey, LogsActivity, Userstamps;

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

    protected $table = 'seo_trans';
    protected $primaryKey = ['seo_id', 'language_id'];
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'seo_id', 'language_id', 'title','popup_contact_us_title', 'description', 'key_words', 'short_description', 'created_at', 'updated_at'
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
    protected static $logName = 'seo_translation_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Seo Translation ".$this->title." has been {$eventName}";
    }

    public function seo()
    {
        return $this->belongsTo('Modules\SEO\Seo', 'seo_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo('App\Language', 'language_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (SeoTranslation $seo_translation) {
            Event::dispatch('seo_translation.created', $seo_translation);
        });
        static::updated(function (SeoTranslation $seo_translation) {
            Event::dispatch('seo_translation.updated', $seo_translation);
        });
        static::saved(function (SeoTranslation $seo_translation) {
            Event::dispatch('seo_translation.saved', $seo_translation);
        });
        static::deleted(function (SeoTranslation $seo_translation) {
            Event::dispatch('seo_translation.deleted', $seo_translation);
        });
    }
}
