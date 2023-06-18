<?php

namespace Modules\Socials;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\HasCompositePrimaryKey;
use Illuminate\Support\Facades\Event;
use Cache;
use Wildside\Userstamps\Userstamps;

class SocialTranslation extends Model
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

    protected $table = 'social_trans';
    protected $primaryKey = ['social_id', 'language_id'];
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'social_id', 'language_id', 'title', 'created_at', 'updated_at'
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
    protected static $logName = 'social_translation_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Socials Translation " . $this->title . " has been {$eventName}";
    }

    public function social()
    {
        return $this->belongsTo('Modules\Socials\Social', 'social_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo('App\Language', 'language_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (SocialTranslation $social_translation) {
            Event::dispatch('social_translation.created', $social_translation);
        });
        static::updated(function (SocialTranslation $social_translation) {
            Event::dispatch('social_translation.updated', $social_translation);
        });
        static::saved(function (SocialTranslation $social_translation) {
            Event::dispatch('social_translation.saved', $social_translation);
        });
        static::deleted(function (SocialTranslation $social_translation) {
            Event::dispatch('social_translation.deleted', $social_translation);
        });
        static::restored(function (SocialTranslation $social_translation) {
            Event::dispatch('social_translation.restored', $social_translation);
        });
    }
}
